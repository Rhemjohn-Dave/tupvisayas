(function () {
    'use strict';

    function ready(fn) {
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', fn);
        } else {
            fn();
        }
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

        var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
        var centerLat = Number(root.getAttribute('data-campus-center-lat')) || 10.73932;
        var centerLng = Number(root.getAttribute('data-campus-center-lng')) || 122.96961;

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
            if (stop.photos && stop.photos.length) return stop.photos;
            if (stop.photo) return [stop.photo];
            return [];
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

        function showPhoto(url, alt) {
            if (!photo || !url) return;
            photo.src = url;
            photo.alt = alt || '';
            if (!thumbs) return;
            thumbs.querySelectorAll('.ctour-panel__thumb').forEach(function (btn) {
                var active = btn.getAttribute('data-campus-thumb') === url;
                btn.classList.toggle('is-active', active);
                btn.setAttribute('aria-pressed', active ? 'true' : 'false');
            });
        }

        function renderThumbs(stop) {
            if (!thumbs) return;
            var photos = stopPhotos(stop);
            thumbs.innerHTML = '';
            thumbs.hidden = photos.length < 2;

            photos.forEach(function (url, index) {
                var btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'ctour-panel__thumb' + (index === 0 ? ' is-active' : '');
                btn.setAttribute('data-campus-thumb', url);
                btn.setAttribute('aria-pressed', index === 0 ? 'true' : 'false');
                btn.setAttribute('aria-label', 'Show photo ' + (index + 1) + ' of ' + photos.length);

                var img = document.createElement('img');
                img.src = url;
                img.alt = '';
                img.loading = 'lazy';
                btn.appendChild(img);

                btn.addEventListener('click', function () {
                    showPhoto(url, stop.name);
                });

                thumbs.appendChild(btn);
            });
        }

        function setActive(id, options) {
            options = options || {};
            var stop = byId[id];
            if (!stop) return;

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

            var photos = stopPhotos(stop);
            renderThumbs(stop);
            showPhoto(photos[0] || '', stop.name);

            if (tagline) tagline.textContent = stop.tagline || '';
            if (nameEl) nameEl.textContent = stop.name || '';
            if (description) description.textContent = stop.description || '';

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

            if (options.focusMap !== false && stop.lat && stop.lng) {
                map.flyTo([stop.lat, stop.lng], Math.max(map.getZoom(), 18), {
                    animate: !reduceMotion,
                    duration: reduceMotion ? 0 : 0.75,
                });
            }
        }

        stops.forEach(function (stop, index) {
            if (!stop.lat || !stop.lng) return;

            var marker = L.marker([stop.lat, stop.lng], {
                icon: pinIcon(index, index === 0),
                title: stop.name,
                keyboard: true,
                riseOnHover: true,
            });

            marker.bindPopup(
                '<strong>' + stop.name + '</strong><br><span>' + (stop.tagline || '') + '</span>',
                { closeButton: true, autoPan: true }
            );

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
