(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
    }

    function escapeHtml(value) {
        return String(value || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;');
    }

    ready(function () {
        var root = document.querySelector('[data-campus-tour]');
        if (!root || typeof L === 'undefined') return;

        var jsonEl = root.querySelector('[data-campus-stops]');
        var mapEl = root.querySelector('[data-campus-map]');
        if (!jsonEl || !mapEl) return;

        var stops;
        try {
            stops = JSON.parse(jsonEl.textContent);
        } catch (e) {
            return;
        }

        if (!Array.isArray(stops) || !stops.length) return;

        var byId = {};
        stops.forEach(function (stop) {
            byId[stop.id] = stop;
        });

        var panel = root.querySelector('[data-campus-panel]');
        var photo = root.querySelector('[data-campus-photo]');
        var thumbs = root.querySelector('[data-campus-thumbs]');
        var tagline = root.querySelector('[data-campus-tagline]');
        var nameEl = root.querySelector('[data-campus-name]');
        var description = root.querySelector('[data-campus-description]');
        var links = root.querySelector('[data-campus-links]');
        var listButtons = root.querySelectorAll('.ctour-stop-list [data-campus-stop]');
        var openTheaterBtns = root.querySelectorAll('[data-campus-open-theater]');
        var theater = root.querySelector('[data-campus-theater]');
        var theaterPhoto = root.querySelector('[data-campus-theater-photo]');
        var theaterThumbs = root.querySelector('[data-campus-theater-thumbs]');
        var theaterTagline = root.querySelector('[data-campus-theater-tagline]');
        var theaterName = root.querySelector('[data-campus-theater-name]');
        var theaterCount = root.querySelector('[data-campus-theater-count]');
        var theaterPhotoPrev = root.querySelector('[data-campus-theater-photo-prev]');
        var theaterPhotoNext = root.querySelector('[data-campus-theater-photo-next]');
        var theaterPano = root.querySelector('[data-campus-theater-pano]');
        var panoToggle = root.querySelector('[data-campus-theater-pano-toggle]');
        var panelPanoBtn = root.querySelector('[data-campus-open-pano]');
        var playButtons = root.querySelectorAll('[data-campus-tour-play]');
        var playLabels = root.querySelectorAll('[data-campus-tour-play-label]');
        var tourPrevBtn = root.querySelector('[data-campus-tour-prev]');
        var tourNextBtn = root.querySelector('[data-campus-tour-next]');
        var tourEndBtn = root.querySelector('[data-campus-tour-end]');
        var tourStatus = root.querySelector('[data-campus-tour-status]');

        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var centerLat = Number(root.getAttribute('data-campus-center-lat')) || 10.73932;
        var centerLng = Number(root.getAttribute('data-campus-center-lng')) || 122.96961;
        var TOUR_INTERVAL = 5000;

        var activeId = null;
        var photoIndex = 0;
        var theaterOpen = false;
        var theaterReturnFocus = null;
        var panoMode = false;
        var panoViewer = null;
        var tourPlaying = false;
        var tourStarted = false;
        var tourTimer = null;
        var touchStartX = 0;

        var streets = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        });

        var satellite = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}',
            {
                maxZoom: 19,
                attribution: 'Tiles &copy; Esri — Source: Esri, Maxar, Earthstar Geographics, and GIS User Community',
            }
        );

        var labels = L.tileLayer(
            'https://server.arcgisonline.com/ArcGIS/rest/services/Reference/World_Boundaries_and_Places/MapServer/tile/{z}/{y}/{x}',
            {
                maxZoom: 19,
                opacity: 0.85,
                attribution: 'Labels &copy; Esri',
            }
        );

        var hybrid = L.layerGroup([satellite, labels]);

        var map = L.map(mapEl, {
            center: [centerLat, centerLng],
            zoom: 18,
            minZoom: 15,
            maxZoom: 19,
            zoomControl: true,
            scrollWheelZoom: true,
            layers: [hybrid],
        });

        L.control.layers(
            {
                Satellite: hybrid,
                Streets: streets,
            },
            null,
            { position: 'topright', collapsed: false }
        ).addTo(map);

        L.control.scale({ imperial: false, metric: true }).addTo(map);

        var markersById = {};
        var markerGroup = L.featureGroup().addTo(map);

        function stopPhotos(stop) {
            if (!stop) return [];
            if (stop.photos && stop.photos.length) return stop.photos;
            if (stop.photo) return [stop.photo];
            return [];
        }

        function stopHasPano(stop) {
            return !!(stop && stop.pano);
        }

        function destroyPano() {
            if (panoViewer && typeof panoViewer.destroy === 'function') {
                try {
                    panoViewer.destroy();
                } catch (e) {
                    // Viewer may already be torn down.
                }
            }
            panoViewer = null;
            if (theaterPano) theaterPano.innerHTML = '';
        }

        function syncPanoToggle(stop) {
            if (!panoToggle) return;
            if (!stopHasPano(stop)) {
                panoToggle.hidden = true;
                return;
            }
            panoToggle.hidden = false;
            panoToggle.textContent = panoMode ? 'View photos' : '360° look around';
        }

        function showPhotoMode() {
            panoMode = false;
            destroyPano();
            if (theater) theater.classList.remove('is-pano');
            if (theaterPhoto) theaterPhoto.hidden = false;
            if (theaterPano) theaterPano.hidden = true;
            syncPanoToggle(currentStop());
            updateTheaterPhotos();
        }

        function showPanoMode() {
            var stop = currentStop();
            if (!stopHasPano(stop) || typeof pannellum === 'undefined' || !theaterPano) {
                showPhotoMode();
                return;
            }

            panoMode = true;
            if (theater) theater.classList.add('is-pano');
            if (theaterPhoto) theaterPhoto.hidden = true;
            theaterPano.hidden = false;
            if (theaterPhotoPrev) theaterPhotoPrev.hidden = true;
            if (theaterPhotoNext) theaterPhotoNext.hidden = true;
            if (theaterThumbs) theaterThumbs.hidden = true;
            if (theaterCount) theaterCount.textContent = 'Drag to look around';
            if (theaterTagline) theaterTagline.textContent = stop.tagline || '';
            if (theaterName) theaterName.textContent = stop.name || '';
            syncPanoToggle(stop);
            destroyPano();

            window.requestAnimationFrame(function () {
                if (!panoMode || !theaterOpen || !stopHasPano(currentStop())) return;
                panoViewer = pannellum.viewer(theaterPano, {
                    type: 'equirectangular',
                    panorama: currentStop().pano,
                    autoLoad: true,
                    autoRotate: reduceMotion ? 0 : -2,
                    compass: false,
                    showFullscreenCtrl: false,
                    showZoomCtrl: true,
                    mouseZoom: true,
                    hfov: 100,
                    minHfov: 50,
                    maxHfov: 120,
                });
            });
        }

        function currentStop() {
            return byId[activeId] || null;
        }

        function currentPhotos() {
            return stopPhotos(currentStop());
        }

        function stopIndex(id) {
            for (var i = 0; i < stops.length; i += 1) {
                if (stops[i].id === id) return i;
            }
            return -1;
        }

        function pinIcon(index, active) {
            return L.divIcon({
                className: 'ctour-leaflet-marker' + (active ? ' is-active' : ''),
                html:
                    '<span class="ctour-leaflet-marker__pulse" aria-hidden="true"></span>' +
                    '<span class="ctour-leaflet-marker__dot">' + (index + 1) + '</span>',
                iconSize: [36, 36],
                iconAnchor: [18, 18],
                popupAnchor: [0, -18],
            });
        }

        function popupHtml(stop) {
            var photos = stopPhotos(stop);
            var thumb = photos[0]
                ? '<img class="ctour-popup__thumb" src="' + escapeHtml(photos[0]) + '" alt="">'
                : '';

            return (
                '<div class="ctour-popup">' +
                thumb +
                '<div class="ctour-popup__copy">' +
                '<strong>' + escapeHtml(stop.name) + '</strong>' +
                '<span>' + escapeHtml(stop.tagline || '') + '</span>' +
                '</div></div>'
            );
        }

        function fadeSwap(imgEl, url, alt) {
            if (!imgEl || !url) return;

            if (reduceMotion || imgEl.getAttribute('src') === url) {
                imgEl.src = url;
                imgEl.alt = alt || '';
                return;
            }

            imgEl.style.opacity = '0';
            window.setTimeout(function () {
                imgEl.src = url;
                imgEl.alt = alt || '';
                imgEl.style.opacity = '1';
            }, 140);
        }

        function syncThumbState(container, url, thumbClass) {
            if (!container) return;
            container.querySelectorAll(thumbClass).forEach(function (btn) {
                var active = btn.getAttribute('data-campus-thumb') === url;
                btn.classList.toggle('is-active', active);
                btn.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
        }

        function updateTheaterPhotos() {
            if (!theater || panoMode) return;

            var stop = currentStop();
            var photos = currentPhotos();
            var url = photos[photoIndex] || photos[0] || '';
            var many = photos.length > 1;

            if (theaterTagline) theaterTagline.textContent = stop ? stop.tagline || '' : '';
            if (theaterName) theaterName.textContent = stop ? stop.name || '' : '';
            if (theaterCount) {
                theaterCount.textContent = photos.length
                    ? photoIndex + 1 + ' / ' + photos.length
                    : '';
            }

            fadeSwap(theaterPhoto, url, stop ? stop.name : '');

            if (theaterPhotoPrev) theaterPhotoPrev.hidden = !many;
            if (theaterPhotoNext) theaterPhotoNext.hidden = !many;

            syncPanoToggle(stop);

            if (!theaterThumbs) return;
            theaterThumbs.innerHTML = '';
            theaterThumbs.hidden = !many;

            photos.forEach(function (photoUrl, index) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'ctour-theater__thumb' + (index === photoIndex ? ' is-active' : '');
                btn.setAttribute('data-campus-thumb', photoUrl);
                btn.setAttribute('aria-pressed', index === photoIndex ? 'true' : 'false');
                btn.setAttribute('aria-label', 'Show photo ' + (index + 1) + ' of ' + photos.length);

                var img = document.createElement('img');
                img.src = photoUrl;
                img.alt = '';
                img.loading = 'lazy';
                btn.appendChild(img);

                btn.addEventListener('click', function () {
                    showPhotoAt(index);
                });

                theaterThumbs.appendChild(btn);
            });
        }

        function updateTheater() {
            if (!theater) return;
            if (panoMode) {
                if (stopHasPano(currentStop())) {
                    showPanoMode();
                } else {
                    showPhotoMode();
                }
                return;
            }
            updateTheaterPhotos();
        }

        function showPhotoAt(index) {
            var photos = currentPhotos();
            if (!photos.length) return;

            photoIndex = ((index % photos.length) + photos.length) % photos.length;
            var url = photos[photoIndex];
            var stop = currentStop();
            var alt = stop ? stop.name : '';

            fadeSwap(photo, url, alt);
            syncThumbState(thumbs, url, '.ctour-panel__thumb');

            if (theaterOpen && !panoMode) {
                updateTheaterPhotos();
            }
        }

        function renderThumbs(stop) {
            if (!thumbs) return;
            var photos = stopPhotos(stop);
            thumbs.innerHTML = '';
            thumbs.hidden = photos.length < 2;

            photos.forEach(function (url, index) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'ctour-panel__thumb' + (index === photoIndex ? ' is-active' : '');
                btn.setAttribute('data-campus-thumb', url);
                btn.setAttribute('aria-pressed', index === photoIndex ? 'true' : 'false');
                btn.setAttribute('aria-label', 'Show photo ' + (index + 1) + ' of ' + photos.length);

                var img = document.createElement('img');
                img.src = url;
                img.alt = '';
                img.loading = 'lazy';
                btn.appendChild(img);

                btn.addEventListener('click', function () {
                    showPhotoAt(index);
                });

                thumbs.appendChild(btn);
            });
        }

        function updatePlaybackUi() {
            var stop = currentStop();
            var index = stopIndex(activeId);
            var label = 'Start tour';
            var icon = 'play_arrow';

            if (tourPlaying) {
                label = 'Pause';
                icon = 'pause';
            } else if (tourStarted) {
                label = 'Resume';
                icon = 'play_arrow';
            }

            playButtons.forEach(function (btn) {
                var iconEl = btn.querySelector('.material-icons');
                if (iconEl) iconEl.textContent = icon;
                btn.setAttribute('aria-pressed', tourPlaying ? 'true' : 'false');
            });

            playLabels.forEach(function (el) {
                el.textContent = label;
            });

            if (tourPrevBtn) tourPrevBtn.hidden = !tourStarted;
            if (tourNextBtn) tourNextBtn.hidden = !tourStarted;
            if (tourEndBtn) tourEndBtn.hidden = !tourStarted;

            if (tourStatus) {
                tourStatus.hidden = !stop;
                if (stop) {
                    tourStatus.textContent =
                        'Stop ' + (index + 1) + ' of ' + stops.length + ' — ' + (stop.name || '');
                }
            }
        }

        function clearTourTimer() {
            if (tourTimer) {
                window.clearTimeout(tourTimer);
                tourTimer = null;
            }
        }

        function scheduleTourAdvance() {
            clearTourTimer();
            if (!tourPlaying || reduceMotion) return;

            tourTimer = window.setTimeout(function () {
                var index = stopIndex(activeId);
                if (index < 0 || index >= stops.length - 1) {
                    pauseTour(true);
                    return;
                }
                setActive(stops[index + 1].id, { focusMap: true, openPopup: true, fromTour: true });
                scheduleTourAdvance();
            }, TOUR_INTERVAL);
        }

        function pauseTour(completed) {
            tourPlaying = false;
            clearTourTimer();
            if (completed) {
                tourStarted = false;
            }
            updatePlaybackUi();
        }

        function startTour(fromBeginning) {
            tourStarted = true;
            if (fromBeginning || !activeId) {
                setActive(stops[0].id, { focusMap: true, openPopup: true, fromTour: true });
            } else {
                setActive(activeId, { focusMap: true, openPopup: true, fromTour: true });
            }

            if (reduceMotion) {
                tourPlaying = false;
                updatePlaybackUi();
                return;
            }

            tourPlaying = true;
            updatePlaybackUi();
            scheduleTourAdvance();
        }

        function endTour() {
            tourPlaying = false;
            tourStarted = false;
            clearTourTimer();
            updatePlaybackUi();
        }

        function goStop(offset, options) {
            var index = stopIndex(activeId);
            if (index < 0) index = 0;
            var next = stops[(index + offset + stops.length) % stops.length];
            setActive(next.id, options || { focusMap: true, openPopup: true });
        }

        function setActive(id, options) {
            options = options || {};
            var stop = byId[id];
            if (!stop) return;

            activeId = id;
            photoIndex = typeof options.photoIndex === 'number' ? options.photoIndex : 0;

            if (!options.fromTour && tourPlaying) {
                pauseTour();
            }

            Object.keys(markersById).forEach(function (key) {
                var entry = markersById[key];
                var active = key === id;
                entry.marker.setIcon(pinIcon(entry.index, active));
                if (active && options.openPopup !== false) {
                    entry.marker.openPopup();
                }
            });

            listButtons.forEach(function (btn) {
                var active = btn.getAttribute('data-campus-stop') === id;
                btn.classList.toggle('is-active', active);
                btn.setAttribute('aria-pressed', active ? 'true' : 'false');
            });

            if (panel && !reduceMotion) {
                panel.classList.remove('is-updating');
                void panel.offsetWidth;
                panel.classList.add('is-updating');
            }

            renderThumbs(stop);
            showPhotoAt(photoIndex);

            if (tagline) tagline.textContent = stop.tagline || '';
            if (nameEl) nameEl.textContent = stop.name || '';
            if (description) description.textContent = stop.description || '';

            openTheaterBtns.forEach(function (btn) {
                if (btn.hasAttribute('data-campus-open-theater')) {
                    btn.setAttribute('aria-label', 'Open photo gallery for ' + (stop.name || 'this stop'));
                }
            });

            if (panelPanoBtn) {
                panelPanoBtn.hidden = !stopHasPano(stop);
            }

            if (links) {
                links.innerHTML = '';
                (stop.links || []).forEach(function (link, index) {
                    var a = document.createElement('a');
                    a.className = 'acad-btn ' + (index === 0 ? 'acad-btn--primary' : 'acad-btn--ghost');
                    a.href = link.url;
                    a.textContent = link.label;
                    if (link.external) {
                        a.target = '_blank';
                        a.rel = 'noopener noreferrer';
                    }
                    links.appendChild(a);
                });
            }

            if (theaterOpen) {
                updateTheater();
            }

            if (options.focusMap !== false && stop.lat && stop.lng) {
                map.flyTo([stop.lat, stop.lng], Math.max(map.getZoom(), 18), {
                    animate: !reduceMotion,
                    duration: reduceMotion ? 0 : 0.75,
                });
            }

            updatePlaybackUi();
        }

        function openTheater(options) {
            options = options || {};
            if (!theater) return;
            theaterOpen = true;
            theaterReturnFocus = document.activeElement;
            theater.hidden = false;
            document.body.classList.add('ctour-theater-open');
            pauseTour();

            if (options.pano) {
                showPanoMode();
            } else {
                showPhotoMode();
            }

            var closeBtn = theater.querySelector('.ctour-theater__close');
            if (closeBtn) closeBtn.focus();
        }

        function closeTheater() {
            if (!theater || !theaterOpen) return;
            theaterOpen = false;
            panoMode = false;
            destroyPano();
            if (theater) theater.classList.remove('is-pano');
            theater.hidden = true;
            document.body.classList.remove('ctour-theater-open');
            if (theaterReturnFocus && typeof theaterReturnFocus.focus === 'function') {
                theaterReturnFocus.focus();
            }
        }

        function theaterFocusables() {
            if (!theater) return [];
            return Array.prototype.filter.call(
                theater.querySelectorAll('button:not([hidden]):not([disabled])'),
                function (el) {
                    return el.getAttribute('tabindex') !== '-1';
                }
            );
        }

        stops.forEach(function (stop, index) {
            if (!stop.lat || !stop.lng) return;

            var marker = L.marker([stop.lat, stop.lng], {
                icon: pinIcon(index, index === 0),
                title: stop.name,
                keyboard: true,
                riseOnHover: true,
            });

            marker.bindPopup(popupHtml(stop), {
                closeButton: true,
                autoPan: true,
                maxWidth: 240,
                minWidth: 170,
                className: 'ctour-leaflet-popup',
            });

            marker.on('click', function () {
                setActive(stop.id, { focusMap: true, openPopup: true });
            });

            marker.addTo(markerGroup);
            markersById[stop.id] = { marker: marker, index: index };
        });

        listButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                setActive(btn.getAttribute('data-campus-stop'), { focusMap: true });
            });
        });

        openTheaterBtns.forEach(function (btn) {
            btn.addEventListener('click', function () {
                openTheater();
            });
        });

        if (panelPanoBtn) {
            panelPanoBtn.addEventListener('click', function () {
                openTheater({ pano: true });
            });
        }

        if (theater) {
            theater.querySelectorAll('[data-campus-theater-close]').forEach(function (btn) {
                btn.addEventListener('click', closeTheater);
            });

            if (theaterPhotoPrev) {
                theaterPhotoPrev.addEventListener('click', function () {
                    showPhotoAt(photoIndex - 1);
                });
            }

            if (theaterPhotoNext) {
                theaterPhotoNext.addEventListener('click', function () {
                    showPhotoAt(photoIndex + 1);
                });
            }

            var theaterStopPrev = theater.querySelector('[data-campus-theater-stop-prev]');
            var theaterStopNext = theater.querySelector('[data-campus-theater-stop-next]');

            if (theaterStopPrev) {
                theaterStopPrev.addEventListener('click', function () {
                    goStop(-1, { focusMap: true, openPopup: false });
                });
            }

            if (theaterStopNext) {
                theaterStopNext.addEventListener('click', function () {
                    goStop(1, { focusMap: true, openPopup: false });
                });
            }

            if (panoToggle) {
                panoToggle.addEventListener('click', function () {
                    if (panoMode) showPhotoMode();
                    else showPanoMode();
                });
            }

            theater.addEventListener('touchstart', function (event) {
                if (!event.changedTouches || !event.changedTouches.length) return;
                touchStartX = event.changedTouches[0].screenX;
            }, { passive: true });

            theater.addEventListener('touchend', function (event) {
                if (!theaterOpen || panoMode || !event.changedTouches || !event.changedTouches.length) return;
                var dx = event.changedTouches[0].screenX - touchStartX;
                if (Math.abs(dx) < 50) return;
                if (dx < 0) showPhotoAt(photoIndex + 1);
                else showPhotoAt(photoIndex - 1);
            }, { passive: true });
        }

        playButtons.forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (btn.hasAttribute('data-campus-tour-scroll')) {
                    var mapSection = document.getElementById('campus-tour-map');
                    if (mapSection) {
                        mapSection.scrollIntoView({ behavior: reduceMotion ? 'auto' : 'smooth', block: 'start' });
                        window.setTimeout(function () {
                            map.invalidateSize();
                        }, 400);
                    }
                }

                if (tourPlaying) {
                    pauseTour();
                    return;
                }

                startTour(!tourStarted);
            });
        });

        if (tourPrevBtn) {
            tourPrevBtn.addEventListener('click', function () {
                goStop(-1, { focusMap: true, openPopup: true, fromTour: tourPlaying });
                if (tourPlaying) scheduleTourAdvance();
            });
        }

        if (tourNextBtn) {
            tourNextBtn.addEventListener('click', function () {
                var index = stopIndex(activeId);
                if (index >= stops.length - 1) {
                    pauseTour(true);
                    return;
                }
                goStop(1, { focusMap: true, openPopup: true, fromTour: tourPlaying });
                if (tourPlaying) scheduleTourAdvance();
            });
        }

        if (tourEndBtn) {
            tourEndBtn.addEventListener('click', endTour);
        }

        document.addEventListener('keydown', function (event) {
            if (!theaterOpen) return;

            if (event.key === 'Escape') {
                event.preventDefault();
                closeTheater();
                return;
            }

            if (event.key === 'ArrowLeft') {
                if (panoMode) return;
                event.preventDefault();
                showPhotoAt(photoIndex - 1);
                return;
            }

            if (event.key === 'ArrowRight') {
                if (panoMode) return;
                event.preventDefault();
                showPhotoAt(photoIndex + 1);
                return;
            }

            if (event.key !== 'Tab' || !theater) return;

            var focusable = theaterFocusables();
            if (!focusable.length) return;

            var first = focusable[0];
            var last = focusable[focusable.length - 1];

            if (event.shiftKey && document.activeElement === first) {
                event.preventDefault();
                last.focus();
            } else if (!event.shiftKey && document.activeElement === last) {
                event.preventDefault();
                first.focus();
            }
        });

        window.setTimeout(function () {
            map.invalidateSize();
            if (markerGroup.getLayers().length) {
                map.fitBounds(markerGroup.getBounds().pad(0.35), { maxZoom: 18 });
            }
            setActive(stops[0].id, { focusMap: false, openPopup: true });
        }, 80);

        window.addEventListener('resize', function () {
            map.invalidateSize();
        });
    });
})();
