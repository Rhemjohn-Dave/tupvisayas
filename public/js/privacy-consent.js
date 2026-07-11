(function () {
    var KEY = 'tupv_privacy_ack_v1';
    var banner = document.getElementById('privacyConsent');
    var accept = document.getElementById('privacyConsentAccept');

    if (!banner || !accept) return;

    try {
        if (window.localStorage.getItem(KEY) === '1') {
            return;
        }
    } catch (e) {
        // If storage is blocked, still show the banner once per session via sessionStorage
        try {
            if (window.sessionStorage.getItem(KEY) === '1') {
                return;
            }
        } catch (e2) {}
    }

    banner.hidden = false;

    accept.addEventListener('click', function () {
        try {
            window.localStorage.setItem(KEY, '1');
        } catch (e) {
            try {
                window.sessionStorage.setItem(KEY, '1');
            } catch (e2) {}
        }
        banner.hidden = true;
    });
})();
