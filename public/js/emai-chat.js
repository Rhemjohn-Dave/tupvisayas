(function () {
    'use strict';

    var root = document.getElementById('emaiChat');
    if (!root) return;

    var fab = document.getElementById('emaiFab');
    var panel = document.getElementById('emaiPanel');
    var closeBtn = document.getElementById('emaiClose');
    var form = document.getElementById('emaiForm');
    var input = document.getElementById('emaiInput');
    var sendBtn = document.getElementById('emaiSend');
    var messages = document.getElementById('emaiMessages');
    var suggestions = document.getElementById('emaiSuggestions');
    var askUrl = root.getAttribute('data-ask-url');
    var csrf = root.getAttribute('data-csrf');
    var logo = root.getAttribute('data-logo');
    var busy = false;

    root.hidden = false;

    function openPanel() {
        panel.hidden = false;
        fab.setAttribute('aria-expanded', 'true');
        root.classList.add('is-open');
        document.body.classList.add('emai-chat-open');
        window.setTimeout(function () {
            input.focus();
        }, 50);
    }

    function closePanel() {
        panel.hidden = true;
        fab.setAttribute('aria-expanded', 'false');
        root.classList.remove('is-open');
        document.body.classList.remove('emai-chat-open');
        fab.focus();
    }

    function togglePanel() {
        if (panel.hidden) openPanel();
        else closePanel();
    }

    function scrollToBottom() {
        messages.scrollTop = messages.scrollHeight;
    }

    function escapeHtml(text) {
        return String(text)
            .replace(/&/g, '&amp;')
            .replace(/</g, '&lt;')
            .replace(/>/g, '&gt;')
            .replace(/"/g, '&quot;')
            .replace(/'/g, '&#39;');
    }

    function appendUser(text) {
        var row = document.createElement('div');
        row.className = 'emai__row emai__row--user';
        row.innerHTML = '<div class="emai__bubble emai__bubble--user"><p>' + escapeHtml(text) + '</p></div>';
        messages.appendChild(row);
        scrollToBottom();
    }

    function appendBot(text, links) {
        var row = document.createElement('div');
        row.className = 'emai__row emai__row--bot';

        var linksHtml = '';
        if (links && links.length) {
            linksHtml = '<div class="emai__links">' + links.map(function (link) {
                return '<a class="emai__link" href="' + escapeHtml(link.url) + '">' + escapeHtml(link.label) + '</a>';
            }).join('') + '</div>';
        }

        row.innerHTML =
            '<img class="emai__bubble-avatar" src="' + escapeHtml(logo) + '" alt="" width="28" height="28">' +
            '<div class="emai__bubble emai__bubble--bot"><p>' + escapeHtml(text) + '</p>' + linksHtml + '</div>';

        messages.appendChild(row);
        scrollToBottom();
    }

    function appendTyping() {
        var row = document.createElement('div');
        row.className = 'emai__row emai__row--bot emai__row--typing';
        row.id = 'emaiTyping';
        row.innerHTML =
            '<img class="emai__bubble-avatar" src="' + escapeHtml(logo) + '" alt="" width="28" height="28">' +
            '<div class="emai__bubble emai__bubble--bot emai__bubble--typing" aria-label="E-Mai is typing">' +
            '<span></span><span></span><span></span></div>';
        messages.appendChild(row);
        scrollToBottom();
    }

    function removeTyping() {
        var typing = document.getElementById('emaiTyping');
        if (typing) typing.remove();
    }

    function setBusy(state) {
        busy = state;
        sendBtn.disabled = state;
        input.disabled = state;
    }

    function ask(message) {
        if (!message || busy) return;
        appendUser(message);
        if (suggestions) suggestions.hidden = true;
        setBusy(true);
        appendTyping();

        fetch(askUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': csrf,
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ message: message })
        })
            .then(function (res) {
                return res.json().then(function (data) {
                    if (!res.ok) throw data;
                    return data;
                });
            })
            .then(function (data) {
                removeTyping();
                appendBot(data.message || 'Sorry, I could not answer that.', data.links || []);
            })
            .catch(function () {
                removeTyping();
                appendBot('Something went wrong. Please try again in a moment, or use the Contact page for help.');
            })
            .finally(function () {
                setBusy(false);
                input.focus();
            });
    }

    fab.addEventListener('click', togglePanel);
    closeBtn.addEventListener('click', closePanel);

    document.addEventListener('keydown', function (event) {
        if (event.key === 'Escape' && !panel.hidden) {
            closePanel();
        }
    });

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var value = (input.value || '').trim();
        if (!value) return;
        input.value = '';
        ask(value);
    });

    if (suggestions) {
        suggestions.addEventListener('click', function (event) {
            var chip = event.target.closest('[data-emai-suggest]');
            if (!chip) return;
            ask(chip.getAttribute('data-emai-suggest'));
        });
    }
})();
