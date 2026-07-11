{{-- First-visit privacy acknowledgment (RA 10173 transparency) --}}
<div class="privacy-consent" id="privacyConsent" hidden role="dialog" aria-labelledby="privacy-consent-title" aria-describedby="privacy-consent-text">
    <div class="privacy-consent__inner">
        <div class="privacy-consent__copy">
            <p id="privacy-consent-title" class="privacy-consent__title">Privacy notice</p>
            <p id="privacy-consent-text" class="privacy-consent__text">
                We process limited personal data as described in our
                <a href="{{ route('privacy.notice') }}">Privacy Notice</a>
                under Republic Act No. 10173 (Data Privacy Act). By continuing, you acknowledge this notice.
            </p>
        </div>
        <div class="privacy-consent__actions">
            <a class="privacy-consent__link" href="{{ route('privacy.notice') }}">Read notice</a>
            <button type="button" class="privacy-consent__btn" id="privacyConsentAccept">Acknowledge</button>
        </div>
    </div>
</div>
