/**
 * Admin rich text: Toast UI Editor for textarea.wysiwyg fields.
 * Syncs HTML back to the hidden textarea on submit.
 * Supports image resize (presets + drag) and preserves heading markup.
 */
(function () {
    'use strict';

    var DEFAULT_TOOLBAR = [
        ['heading', 'bold', 'italic', 'strike'],
        ['hr', 'quote'],
        ['ul', 'ol', 'task', 'indent', 'outdent'],
        ['table', 'image', 'link'],
        ['code', 'codeblock'],
    ];

    function plainTextFromHtml(html) {
        var tmp = document.createElement('div');
        tmp.innerHTML = html || '';
        return (tmp.textContent || tmp.innerText || '')
            .replace(/\u00a0/g, ' ')
            .trim();
    }

    function editorConfig() {
        return window.TUPV_ADMIN_EDITOR || {};
    }

    function csrfToken() {
        var cfg = editorConfig();
        if (cfg.csrfToken) {
            return cfg.csrfToken;
        }
        var meta = document.querySelector('meta[name="csrf-token"]');
        return meta ? meta.getAttribute('content') : '';
    }

    function decodeSrc(src) {
        if (!src) {
            return '';
        }
        try {
            return decodeURIComponent(String(src).replace(/&amp;/g, '&'));
        } catch (e) {
            return String(src).replace(/&amp;/g, '&');
        }
    }

    function normalizeWidthValue(value) {
        if (value === null || value === undefined || value === '') {
            return '';
        }
        var str = String(value).trim();
        if (!str) {
            return '';
        }
        if (/^\d+(\.\d+)?$/.test(str)) {
            return str + 'px';
        }
        return str;
    }

    function getWwRoot(editor) {
        try {
            var els = editor.getEditorElements && editor.getEditorElements();
            if (els && els.wwEditor) {
                return els.wwEditor;
            }
        } catch (e) {
            /* ignore */
        }
        var mount = editor.options && editor.options.el;
        return mount ? mount.querySelector('.toastui-editor-contents') : null;
    }

    function getImageSizeStore(editor) {
        if (!editor._tupvImageSizes) {
            editor._tupvImageSizes = {};
        }
        return editor._tupvImageSizes;
    }

    function rememberImageWidth(editor, img, width) {
        var src = decodeSrc(img.getAttribute('src') || img.src || '');
        var widthCss = normalizeWidthValue(width);
        if (!src || !widthCss) {
            return;
        }
        getImageSizeStore(editor)[src] = widthCss;
        img.dataset.editorWidth = widthCss;
    }

    function collectLiveImageSizes(editor) {
        var sizes = Object.assign({}, getImageSizeStore(editor));
        var root = getWwRoot(editor);
        if (!root) {
            return sizes;
        }
        root.querySelectorAll('img').forEach(function (img) {
            var src = decodeSrc(img.getAttribute('src') || img.src || '');
            if (!src) {
                return;
            }
            var width =
                normalizeWidthValue(img.style.width) ||
                normalizeWidthValue(img.getAttribute('width')) ||
                normalizeWidthValue(img.dataset.editorWidth) ||
                sizes[src];
            if (width) {
                sizes[src] = width;
                getImageSizeStore(editor)[src] = width;
            }
        });
        return sizes;
    }

    function applyWidthToImgTag(tag, width) {
        if (!width) {
            return tag;
        }
        var widthCss = normalizeWidthValue(width);
        var widthAttr = String(widthCss).replace(/px$/i, '');
        var cleaned = tag
            .replace(/\sstyle="[^"]*"/i, '')
            .replace(/\swidth="[^"]*"/i, '')
            .replace(/\sheight="[^"]*"/i, '');
        var style = 'width: ' + widthCss + '; height: auto;';
        if (/\/>$/.test(cleaned)) {
            return cleaned.replace(/\s*\/>$/, ' width="' + widthAttr + '" style="' + style + '" />');
        }
        return cleaned.replace(/>$/, ' width="' + widthAttr + '" style="' + style + '">');
    }

    function mergeImageSizesIntoHtml(html, sizes) {
        if (!html || !sizes || !Object.keys(sizes).length) {
            return html || '';
        }
        return html.replace(/<img\b[^>]*>/gi, function (tag) {
            var match = tag.match(/\ssrc=["']([^"']+)["']/i);
            if (!match) {
                return tag;
            }
            var src = decodeSrc(match[1]);
            var width = sizes[src];
            if (!width) {
                // Try matching by filename tail if full URL differs (asset vs relative)
                var keys = Object.keys(sizes);
                for (var i = 0; i < keys.length; i++) {
                    if (keys[i].indexOf(src) !== -1 || src.indexOf(keys[i]) !== -1) {
                        width = sizes[keys[i]];
                        break;
                    }
                }
            }
            return width ? applyWidthToImgTag(tag, width) : tag;
        });
    }

    function extractImageSizesFromHtml(html) {
        var sizes = {};
        if (!html) {
            return sizes;
        }
        var re = /<img\b[^>]*>/gi;
        var tag;
        while ((tag = re.exec(html))) {
            var el = tag[0];
            var srcMatch = el.match(/\ssrc=["']([^"']+)["']/i);
            if (!srcMatch) {
                continue;
            }
            var src = decodeSrc(srcMatch[1]);
            var widthMatch = el.match(/\swidth=["']([^"']+)["']/i);
            var styleMatch = el.match(/\sstyle=["']([^"']+)["']/i);
            var width = '';
            if (widthMatch) {
                width = normalizeWidthValue(widthMatch[1]);
            }
            if (!width && styleMatch) {
                var w = styleMatch[1].match(/width\s*:\s*([^;]+)/i);
                if (w) {
                    width = normalizeWidthValue(w[1]);
                }
            }
            if (width) {
                sizes[src] = width;
            }
        }
        return sizes;
    }

    function applySizesToLiveImages(editor, sizes) {
        var root = getWwRoot(editor);
        var map = sizes || getImageSizeStore(editor);
        if (!root || !map) {
            return;
        }
        Object.keys(map).forEach(function (key) {
            getImageSizeStore(editor)[key] = map[key];
        });
        root.querySelectorAll('img').forEach(function (img) {
            var src = decodeSrc(img.getAttribute('src') || img.src || '');
            var width = map[src];
            if (!width) {
                Object.keys(map).forEach(function (key) {
                    if (!width && (key.indexOf(src) !== -1 || src.indexOf(key) !== -1)) {
                        width = map[key];
                    }
                });
            }
            if (!width) {
                return;
            }
            img.style.width = width;
            img.style.height = 'auto';
            img.style.maxWidth = '100%';
            img.setAttribute('width', String(width).replace(/px$/i, ''));
            img.dataset.editorWidth = width;
        });
    }

    function getImageCaptionStore(editor) {
        if (!editor._tupvImageCaptions) {
            editor._tupvImageCaptions = {};
        }
        return editor._tupvImageCaptions;
    }

    function escapeHtml(text) {
        return String(text || '')
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function lookupBySrc(map, src) {
        if (!map || !src) {
            return '';
        }
        if (map[src]) {
            return map[src];
        }
        var keys = Object.keys(map);
        for (var i = 0; i < keys.length; i++) {
            if (keys[i].indexOf(src) !== -1 || src.indexOf(keys[i]) !== -1) {
                return map[keys[i]];
            }
        }
        return '';
    }

    function rememberImageCaption(editor, imgOrSrc, caption) {
        var src =
            typeof imgOrSrc === 'string'
                ? decodeSrc(imgOrSrc)
                : decodeSrc(imgOrSrc.getAttribute('src') || imgOrSrc.src || '');
        var text = String(caption || '').replace(/\s+/g, ' ').trim();
        if (!src) {
            return;
        }
        if (text) {
            getImageCaptionStore(editor)[src] = text;
            if (imgOrSrc && imgOrSrc.dataset) {
                imgOrSrc.dataset.editorCaption = text;
            }
        } else {
            delete getImageCaptionStore(editor)[src];
            if (imgOrSrc && imgOrSrc.dataset) {
                delete imgOrSrc.dataset.editorCaption;
            }
        }
    }

    function extractImageCaptionsFromHtml(html) {
        var captions = {};
        if (!html) {
            return captions;
        }

        var figureRe = /<figure\b[^>]*class=["'][^"']*editor-figure[^"']*["'][^>]*>([\s\S]*?)<\/figure>/gi;
        var figureMatch;
        while ((figureMatch = figureRe.exec(html))) {
            var block = figureMatch[1];
            var srcMatch = block.match(/<img\b[^>]*\ssrc=["']([^"']+)["']/i);
            var capMatch = block.match(/<figcaption\b[^>]*>([\s\S]*?)<\/figcaption>/i);
            if (srcMatch && capMatch) {
                var text = capMatch[1].replace(/<[^>]+>/g, '').replace(/\s+/g, ' ').trim();
                if (text) {
                    captions[decodeSrc(srcMatch[1])] = text;
                }
            }
        }

        // Fallback: caption paragraph immediately after an image
        var pairRe = /<img\b([^>]*)>(?:\s*)<p\b[^>]*class=["'][^"']*editor-image-caption[^"']*["'][^>]*>([\s\S]*?)<\/p>/gi;
        var pairMatch;
        while ((pairMatch = pairRe.exec(html))) {
            var srcM = pairMatch[1].match(/\ssrc=["']([^"']+)["']/i);
            if (!srcM) {
                continue;
            }
            var captionText = pairMatch[2].replace(/<[^>]+>/g, '').replace(/\s+/g, ' ').trim();
            if (captionText) {
                captions[decodeSrc(srcM[1])] = captionText;
            }
        }

        return captions;
    }

    function mergeImageCaptionsIntoHtml(html, captions) {
        if (!html) {
            return '';
        }

        // Unwrap previous figure wrappers so we can rebuild cleanly
        html = html.replace(
            /<figure\b[^>]*class=["'][^"']*editor-figure[^"']*["'][^>]*>\s*(<img\b[^>]*>)\s*(?:<figcaption\b[^>]*>[\s\S]*?<\/figcaption>)?\s*<\/figure>/gi,
            '$1'
        );
        html = html.replace(
            /(<img\b[^>]*>)\s*<p\b[^>]*class=["'][^"']*editor-image-caption[^"']*["'][^>]*>[\s\S]*?<\/p>/gi,
            '$1'
        );

        if (!captions || !Object.keys(captions).length) {
            return html;
        }

        return html.replace(/<img\b[^>]*>/gi, function (tag) {
            var match = tag.match(/\ssrc=["']([^"']+)["']/i);
            if (!match) {
                return tag;
            }
            var src = decodeSrc(match[1]);
            var caption = lookupBySrc(captions, src);
            if (!caption) {
                return tag;
            }
            return (
                '<figure class="editor-figure">' +
                tag +
                '<figcaption class="editor-image-caption">' +
                escapeHtml(caption) +
                '</figcaption></figure>'
            );
        });
    }

    function refreshCaptionOverlays(editor, mount) {
        if (!mount) {
            return;
        }
        mount.querySelectorAll('.admin-toast-img-caption').forEach(function (el) {
            el.remove();
        });

        var root = getWwRoot(editor);
        var captions = getImageCaptionStore(editor);
        if (!root) {
            return;
        }

        root.querySelectorAll('img').forEach(function (img) {
            var src = decodeSrc(img.getAttribute('src') || img.src || '');
            var caption = lookupBySrc(captions, src) || img.dataset.editorCaption || '';
            if (!caption) {
                return;
            }
            var overlay = document.createElement('div');
            overlay.className = 'admin-toast-img-caption';
            overlay.textContent = caption;

            var mountRect = mount.getBoundingClientRect();
            var imgRect = img.getBoundingClientRect();
            var top = imgRect.bottom - mountRect.top + mount.scrollTop + 4;
            var left = imgRect.left - mountRect.left + mount.scrollLeft;
            overlay.style.top = top + 'px';
            overlay.style.left = left + 'px';
            overlay.style.width = Math.max(80, imgRect.width) + 'px';
            mount.appendChild(overlay);
        });
    }

    function syncEditorToTextarea(textarea) {
        if (!textarea || !textarea._toastEditor) {
            return;
        }
        var editor = textarea._toastEditor;
        var html = editor.getHTML();
        var sizes = collectLiveImageSizes(editor);
        var captions = getImageCaptionStore(editor);
        html = mergeImageSizesIntoHtml(html, sizes);
        html = mergeImageCaptionsIntoHtml(html, captions);
        textarea.value = html;
    }

    function uploadImageBlob(blob, callback) {
        var cfg = editorConfig();
        var uploadUrl = cfg.uploadUrl;

        if (!uploadUrl) {
            var reader = new FileReader();
            reader.onload = function () {
                callback(reader.result, blob.name || 'image');
            };
            reader.onerror = function () {
                callback('', 'image');
            };
            reader.readAsDataURL(blob);
            return;
        }

        var formData = new FormData();
        formData.append('image', blob, blob.name || 'image.png');

        fetch(uploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': csrfToken(),
                Accept: 'application/json',
                'X-Requested-With': 'XMLHttpRequest',
            },
            body: formData,
            credentials: 'same-origin',
        })
            .then(function (response) {
                if (!response.ok) {
                    throw new Error('Upload failed (' + response.status + ')');
                }
                return response.json();
            })
            .then(function (data) {
                if (!data || !data.url) {
                    throw new Error('Upload response missing url');
                }
                callback(data.url, blob.name || 'image');
            })
            .catch(function () {
                var reader = new FileReader();
                reader.onload = function () {
                    callback(reader.result, blob.name || 'image');
                };
                reader.onerror = function () {
                    window.alert('Image upload failed. Try a smaller JPEG/PNG (max 4MB).');
                    callback('', 'image');
                };
                reader.readAsDataURL(blob);
            });
    }

    function prepareField(textarea) {
        var field =
            textarea.closest('.admin-form__group') ||
            textarea.closest('.input-field') ||
            textarea.parentElement;

        if (field) {
            field.classList.add('admin-field--richtext');
        }

        var label = null;
        if (textarea.id) {
            label = document.querySelector('label[for="' + textarea.id + '"]');
        }
        if (!label && field) {
            label = field.querySelector(':scope > label');
        }
        if (label) {
            label.classList.add('admin-richtext-label');
            label.classList.remove('active');
            if (field && label.parentElement === field && textarea.compareDocumentPosition(label) & Node.DOCUMENT_POSITION_FOLLOWING) {
                field.insertBefore(label, textarea);
            }
        }

        return field;
    }

    function setImageWidth(editor, img, widthCss) {
        var width = normalizeWidthValue(widthCss);
        if (!width || !img) {
            return;
        }
        img.style.width = width;
        img.style.height = 'auto';
        img.style.maxWidth = '100%';
        img.setAttribute('width', String(width).replace(/px$/i, ''));
        rememberImageWidth(editor, img, width);
        img.dispatchEvent(new Event('editor-image-resized', { bubbles: true }));
    }

    function enableImageResize(editor, mount) {
        var tools = null;
        var handle = null;
        var activeImg = null;
        var dragState = null;

        function ensureUi() {
            if (tools) {
                return;
            }

            tools = document.createElement('div');
            tools.className = 'admin-toast-img-tools';
            tools.innerHTML =
                '<span class="admin-toast-img-tools__label">Image size</span>' +
                '<button type="button" data-pct="25">25%</button>' +
                '<button type="button" data-pct="50">50%</button>' +
                '<button type="button" data-pct="75">75%</button>' +
                '<button type="button" data-pct="100">100%</button>' +
                '<label class="admin-toast-img-tools__range">' +
                '<span>Custom</span>' +
                '<input type="range" min="15" max="100" value="100" aria-label="Image width percent">' +
                '</label>' +
                '<label class="admin-toast-img-tools__caption">' +
                '<span>Caption</span>' +
                '<input type="text" maxlength="200" placeholder="Short description under image" aria-label="Image caption">' +
                '</label>' +
                '<span class="admin-toast-img-tools__hint">Or drag the blue handle</span>';

            handle = document.createElement('div');
            handle.className = 'admin-toast-img-handle';
            handle.title = 'Drag to resize';
            handle.setAttribute('role', 'slider');
            handle.setAttribute('aria-label', 'Resize image');

            mount.appendChild(tools);
            mount.appendChild(handle);

            tools.addEventListener('mousedown', function (e) {
                e.stopPropagation();
            });
            tools.addEventListener('click', function (e) {
                e.stopPropagation();
                var btn = e.target.closest('button[data-pct]');
                if (!btn || !activeImg) {
                    return;
                }
                var pct = parseInt(btn.getAttribute('data-pct'), 10);
                applyPercent(pct);
                var range = tools.querySelector('input[type="range"]');
                if (range) {
                    range.value = String(pct);
                }
            });

            var range = tools.querySelector('input[type="range"]');
            if (range) {
                range.addEventListener('input', function () {
                    if (!activeImg) {
                        return;
                    }
                    applyPercent(parseInt(range.value, 10));
                });
            }

            var captionInput = tools.querySelector('.admin-toast-img-tools__caption input');
            if (captionInput) {
                captionInput.addEventListener('input', function () {
                    if (!activeImg) {
                        return;
                    }
                    rememberImageCaption(editor, activeImg, captionInput.value);
                    // Keep alt in sync for accessibility
                    if (captionInput.value.trim()) {
                        activeImg.setAttribute('alt', captionInput.value.trim());
                    }
                    refreshCaptionOverlays(editor, mount);
                    positionUi();
                });
            }

            handle.addEventListener('mousedown', function (e) {
                if (!activeImg) {
                    return;
                }
                e.preventDefault();
                e.stopPropagation();
                var parent = activeImg.closest('.toastui-editor-contents') || mount;
                var parentWidth = parent.clientWidth || activeImg.naturalWidth || 1;
                dragState = {
                    startX: e.clientX,
                    startWidth: activeImg.getBoundingClientRect().width,
                    parentWidth: parentWidth,
                };
                document.addEventListener('mousemove', onDragMove);
                document.addEventListener('mouseup', onDragEnd);
            });
        }

        function applyPercent(pct) {
            if (!activeImg) {
                return;
            }
            var parent = activeImg.closest('.toastui-editor-contents') || mount;
            var parentWidth = parent.clientWidth || activeImg.naturalWidth || 1;
            var px = Math.max(40, Math.round((parentWidth * pct) / 100));
            setImageWidth(editor, activeImg, px + 'px');
            positionUi();
        }

        function onDragMove(e) {
            if (!dragState || !activeImg) {
                return;
            }
            var delta = e.clientX - dragState.startX;
            var next = Math.max(40, Math.min(dragState.parentWidth, dragState.startWidth + delta));
            setImageWidth(editor, activeImg, Math.round(next) + 'px');
            positionUi();
            if (tools) {
                var range = tools.querySelector('input[type="range"]');
                if (range) {
                    range.value = String(Math.round((next / dragState.parentWidth) * 100));
                }
            }
        }

        function onDragEnd() {
            dragState = null;
            document.removeEventListener('mousemove', onDragMove);
            document.removeEventListener('mouseup', onDragEnd);
        }

        function positionUi() {
            if (!activeImg || !tools || !handle) {
                return;
            }
            var mountRect = mount.getBoundingClientRect();
            var imgRect = activeImg.getBoundingClientRect();
            var top = imgRect.top - mountRect.top + mount.scrollTop;
            var left = imgRect.left - mountRect.left + mount.scrollLeft;

            tools.style.display = 'flex';
            tools.style.top = Math.max(0, top - 72) + 'px';
            tools.style.left = Math.max(0, left) + 'px';

            handle.style.display = 'block';
            handle.style.top = top + imgRect.height - 8 + 'px';
            handle.style.left = left + imgRect.width - 8 + 'px';
        }

        function hideUi() {
            activeImg = null;
            if (tools) {
                tools.style.display = 'none';
            }
            if (handle) {
                handle.style.display = 'none';
            }
        }

        function activate(img) {
            ensureUi();
            activeImg = img;
            img.style.maxWidth = '100%';
            img.style.height = 'auto';
            if (!img.style.width && img.getAttribute('width')) {
                setImageWidth(editor, img, img.getAttribute('width'));
            }
            var parent = img.closest('.toastui-editor-contents') || mount;
            var parentWidth = parent.clientWidth || img.naturalWidth || 1;
            var current = img.getBoundingClientRect().width;
            var pct = Math.round((current / parentWidth) * 100);
            var range = tools.querySelector('input[type="range"]');
            if (range) {
                range.value = String(Math.min(100, Math.max(15, pct || 100)));
            }
            var captionInput = tools.querySelector('.admin-toast-img-tools__caption input');
            if (captionInput) {
                var src = decodeSrc(img.getAttribute('src') || img.src || '');
                captionInput.value =
                    lookupBySrc(getImageCaptionStore(editor), src) ||
                    img.dataset.editorCaption ||
                    img.getAttribute('alt') ||
                    '';
            }
            refreshCaptionOverlays(editor, mount);
            positionUi();
        }

        mount.addEventListener('click', function (e) {
            if (e.target.closest('.admin-toast-img-caption')) {
                var nearImg = null;
                var root = getWwRoot(editor);
                if (root) {
                    // Re-select the image under this caption overlay by proximity
                    var capRect = e.target.getBoundingClientRect();
                    root.querySelectorAll('img').forEach(function (img) {
                        var r = img.getBoundingClientRect();
                        if (Math.abs(r.left - capRect.left) < 8 && Math.abs(r.bottom - capRect.top) < 24) {
                            nearImg = img;
                        }
                    });
                }
                if (nearImg) {
                    activate(nearImg);
                }
                return;
            }
            var img = e.target.closest('img');
            if (img && getWwRoot(editor) && getWwRoot(editor).contains(img)) {
                activate(img);
                return;
            }
            if (tools && tools.contains(e.target)) {
                return;
            }
            if (handle && handle.contains(e.target)) {
                return;
            }
            hideUi();
        });

        mount.addEventListener('editor-image-resized', function () {
            refreshCaptionOverlays(editor, mount);
            if (activeImg) {
                positionUi();
            }
        });

        window.addEventListener('resize', function () {
            refreshCaptionOverlays(editor, mount);
            if (activeImg) {
                positionUi();
            }
        });

        // Initial caption overlays for loaded content
        window.setTimeout(function () {
            refreshCaptionOverlays(editor, mount);
        }, 50);
    }

    function initToastEditors() {
        if (typeof toastui === 'undefined' || !toastui.Editor) {
            return;
        }

        document.querySelectorAll('textarea.wysiwyg').forEach(function (textarea) {
            if (textarea.dataset.toastReady === '1') {
                return;
            }
            textarea.dataset.toastReady = '1';

            if (textarea.hasAttribute('required')) {
                textarea.removeAttribute('required');
                textarea.setAttribute('data-wysiwyg-required', 'true');
            }

            prepareField(textarea);

            var mount = document.createElement('div');
            mount.className = 'admin-toast-editor';
            textarea.insertAdjacentElement('afterend', mount);
            textarea.classList.add('admin-toast-editor__source');
            textarea.setAttribute('aria-hidden', 'true');
            textarea.tabIndex = -1;

            var height = textarea.getAttribute('data-editor-height') || '350px';
            var initialHtml = textarea.value || '';
            var savedSizes = extractImageSizesFromHtml(initialHtml);
            var savedCaptions = extractImageCaptionsFromHtml(initialHtml);

            var editor = new toastui.Editor({
                el: mount,
                height: height,
                minHeight: '250px',
                initialEditType: 'wysiwyg',
                previewStyle: 'vertical',
                usageStatistics: false,
                autofocus: false,
                hideModeSwitch: true,
                toolbarItems: DEFAULT_TOOLBAR,
                hooks: {
                    addImageBlobHook: uploadImageBlob,
                },
            });

            editor._tupvImageSizes = savedSizes;
            editor._tupvImageCaptions = savedCaptions;

            if (initialHtml.trim() !== '') {
                try {
                    editor.setHTML(initialHtml);
                } catch (e) {
                    editor.setMarkdown(initialHtml);
                }
                window.setTimeout(function () {
                    applySizesToLiveImages(editor, savedSizes);
                    refreshCaptionOverlays(editor, mount);
                }, 0);
            }

            // ProseMirror may redraw images without width — restore from our map
            editor.on('change', function () {
                window.setTimeout(function () {
                    applySizesToLiveImages(editor, getImageSizeStore(editor));
                    refreshCaptionOverlays(editor, mount);
                }, 0);
            });

            enableImageResize(editor, mount);
            textarea._toastEditor = editor;
        });

        document.addEventListener(
            'submit',
            function (event) {
                var form = event.target;
                if (!(form instanceof HTMLFormElement)) {
                    return;
                }
                if (!form.querySelector('textarea.wysiwyg')) {
                    return;
                }

                form.querySelectorAll('textarea.wysiwyg').forEach(syncEditorToTextarea);

                var requiredFields = form.querySelectorAll('textarea.wysiwyg[data-wysiwyg-required]');
                for (var i = 0; i < requiredFields.length; i++) {
                    var field = requiredFields[i];
                    if (!plainTextFromHtml(field.value)) {
                        event.preventDefault();
                        if (field._toastEditor) {
                            field._toastEditor.focus();
                        } else {
                            field.focus();
                        }
                        return;
                    }
                }
            },
            true
        );

        document.addEventListener('click', function (event) {
            var tabBtn = event.target.closest('[data-uitc-tab]');
            if (!tabBtn) {
                return;
            }
            window.setTimeout(function () {
                document.querySelectorAll('textarea.wysiwyg').forEach(function (textarea) {
                    if (!textarea._toastEditor) {
                        return;
                    }
                    var panel = textarea.closest('.uitc-tabs__panel');
                    if (panel && panel.hidden) {
                        return;
                    }
                    var h = textarea.getAttribute('data-editor-height') || '350px';
                    try {
                        textarea._toastEditor.setHeight(h);
                    } catch (e) {
                        /* ignore */
                    }
                });
            }, 50);
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initToastEditors);
    } else {
        initToastEditors();
    }
})();
