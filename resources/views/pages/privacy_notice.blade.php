@extends('layouts.app')

@section('title', 'Privacy Notice - TUP Visayas')

@section('content')
    @php
        $org = config('privacy.organization');
        $dpoName = config('privacy.dpo_name');
        $dpoEmail = config('privacy.dpo_email');
        $dpoPhone = config('privacy.dpo_phone');
        $dpoOffice = config('privacy.dpo_office');
        $effective = \Carbon\Carbon::parse(config('privacy.effective_date'))->format('F j, Y');
    @endphp

    <div class="section site-page site-page--privacy">
        <h1 class="site-page-title site-page-title--center">Privacy Notice</h1>
        <p class="site-page-intro">
            This notice explains how {{ $org }} processes personal data under Republic Act No. 10173
            (Data Privacy Act of 2012) and related National Privacy Commission issuances.
        </p>
        <p class="privacy-meta">Effective date: {{ $effective }}</p>

        <article class="privacy-doc site-prose">
            <section aria-labelledby="privacy-who">
                <h2 id="privacy-who">1. Who we are</h2>
                <p>
                    {{ $org }} (“we,” “us,” “our”) operates this institutional website to publish
                    public information, academic and administrative notices, and related campus services.
                </p>
            </section>

            <section aria-labelledby="privacy-collect">
                <h2 id="privacy-collect">2. Personal data we may collect</h2>
                <p>Depending on how you use the site, we may process:</p>
                <ul>
                    <li>Identity and contact details you voluntarily provide (e.g., name, email, phone) when corresponding with campus offices</li>
                    <li>Account details for authorized staff users (name, email, role/admin flag, login timestamps)</li>
                    <li>Technical logs reasonably necessary for security and operations (IP address, browser/user agent, pages requested, timestamps)</li>
                    <li>Content submitted by authorized administrators for publication (news, announcements, documents, photos of officials/faculty where provided)</li>
                </ul>
                <p>We do not require the public to create an account to browse general information pages.</p>
            </section>

            <section aria-labelledby="privacy-purpose">
                <h2 id="privacy-purpose">3. Purpose and lawful basis</h2>
                <p>We process personal data for purposes including:</p>
                <ul>
                    <li>Publishing official university information and transparency materials</li>
                    <li>Responding to inquiries and providing campus services</li>
                    <li>Administering authorized staff access to the content management system</li>
                    <li>Maintaining security, audit trails, and integrity of university systems</li>
                    <li>Complying with legal and regulatory obligations applicable to SUCs</li>
                </ul>
                <p>
                    Processing is based on applicable lawful criteria under the Data Privacy Act, including
                    compliance with legal obligations, exercise of public authority / mandate of the University,
                    and, where appropriate, your consent for voluntary submissions.
                </p>
            </section>

            <section aria-labelledby="privacy-share">
                <h2 id="privacy-share">4. Sharing and disclosure</h2>
                <p>
                    We do not sell personal data. Information may be shared only when necessary with authorized
                    university personnel, service providers acting on our instructions (e.g., hosting), or when
                    required by law, court order, or competent authority. Public pages may display information
                    that the University intentionally publishes for institutional transparency.
                </p>
            </section>

            <section aria-labelledby="privacy-retention">
                <h2 id="privacy-retention">5. Retention</h2>
                <p>
                    Personal data is retained only as long as necessary for the purposes stated above, or as
                    required by university records policies and applicable law. Security and activity logs are
                    kept for accountability and incident investigation for a reasonable period, then disposed of
                    securely.
                </p>
            </section>

            <section aria-labelledby="privacy-security">
                <h2 id="privacy-security">6. Security measures</h2>
                <p>
                    We implement organizational, physical, and technical measures appropriate to the risks,
                    including access controls for administrative systems, encrypted transport (HTTPS) where
                    configured, input validation, and audit logging of significant administrative actions.
                </p>
            </section>

            <section aria-labelledby="privacy-rights">
                <h2 id="privacy-rights">7. Your rights</h2>
                <p>Under the Data Privacy Act, you may have the right to:</p>
                <ul>
                    <li>Be informed about the processing of your personal data</li>
                    <li>Object to processing, where applicable</li>
                    <li>Access and correct your personal data</li>
                    <li>Erase or block data under lawful grounds</li>
                    <li>Data portability, where applicable</li>
                    <li>File a complaint with the National Privacy Commission</li>
                    <li>Be indemnified for damages arising from inaccurate, incomplete, or unauthorized processing, as provided by law</li>
                </ul>
                <p>
                    To exercise these rights, contact our Data Protection Officer using the details below.
                    We may need to verify your identity before acting on a request.
                </p>
            </section>

            <section aria-labelledby="privacy-cookies">
                <h2 id="privacy-cookies">8. Cookies and similar technologies</h2>
                <p>
                    This site uses cookies or local storage that are necessary for session management
                    (including login for authorized users) and to remember that you acknowledged this privacy notice.
                    We do not use advertising trackers on this institutional site by default.
                </p>
            </section>

            <section aria-labelledby="privacy-children">
                <h2 id="privacy-children">9. Children</h2>
                <p>
                    The site is intended for general public and campus community information. If you believe we
                    have collected personal data of a minor without appropriate authority, please contact the DPO.
                </p>
            </section>

            <section aria-labelledby="privacy-changes">
                <h2 id="privacy-changes">10. Changes to this notice</h2>
                <p>
                    We may update this Privacy Notice to reflect changes in our practices or legal requirements.
                    The effective date above will be revised when material changes are published.
                </p>
            </section>

            <section aria-labelledby="privacy-dpo" class="privacy-dpo">
                <h2 id="privacy-dpo">11. Data Protection Officer</h2>
                <dl class="privacy-dpo__list">
                    <div>
                        <dt>Name / designation</dt>
                        <dd>{{ $dpoName }}</dd>
                    </div>
                    <div>
                        <dt>Email</dt>
                        <dd><a href="mailto:{{ $dpoEmail }}">{{ $dpoEmail }}</a></dd>
                    </div>
                    <div>
                        <dt>Phone</dt>
                        <dd>{{ $dpoPhone }}</dd>
                    </div>
                    <div>
                        <dt>Office</dt>
                        <dd>{{ $dpoOffice }}</dd>
                    </div>
                </dl>
                <p>
                    You may also contact the
                    <a href="https://privacy.gov.ph/" target="_blank" rel="noopener noreferrer">National Privacy Commission</a>
                    for guidance or complaints.
                </p>
            </section>
        </article>
    </div>
@endsection
