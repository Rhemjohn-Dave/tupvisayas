@extends('layouts.app')

@section('title', 'University Information Technology Center - TUP Visayas')

@section('content')
    <div class="section site-page site-page--technology">
        <h1 class="site-page-title site-page-title--center">University Information Technology Center</h1>
        <p class="site-page-intro">Information technology services and support for students, faculty, and staff at TUP Visayas.</p>

        <div class="uitc-tabs" data-uitc-tabs>
            <div class="uitc-tabs__nav" role="tablist" aria-label="UITC sections">
                <button type="button" class="uitc-tabs__btn is-active" role="tab" aria-selected="true"
                    aria-controls="uitc-panel-services" id="uitc-tab-services" data-uitc-tab="uitc-panel-services">Core
                    services</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="uitc-panel-support" id="uitc-tab-support" data-uitc-tab="uitc-panel-support">Support</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="uitc-panel-security" id="uitc-tab-security"
                    data-uitc-tab="uitc-panel-security">Security</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="uitc-panel-students" id="uitc-tab-students"
                    data-uitc-tab="uitc-panel-students">Students</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="uitc-panel-faculty" id="uitc-tab-faculty"
                    data-uitc-tab="uitc-panel-faculty">Faculty</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="uitc-panel-team" id="uitc-tab-team" data-uitc-tab="uitc-panel-team">UITC team</button>
            </div>

            <div id="uitc-panel-services" class="uitc-tabs__panel is-active" role="tabpanel"
                aria-labelledby="uitc-tab-services">
                <section class="uitc-block" aria-labelledby="uitc-services-heading">
                    <h2 id="uitc-services-heading" class="site-section-title">Core technology services</h2>
                    <p class="uitc-block__intro">Technology services that support academic and administrative operations on campus.</p>
                    <div class="uitc-grid">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">manage_accounts</i></span>
                            <h3 class="mission-card__title">Accounts &amp; access</h3>
                            <p class="mission-card__text">Student and staff accounts, password management, and access control.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">wifi</i></span>
                            <h3 class="mission-card__title">Network &amp; Wi‑Fi</h3>
                            <p class="mission-card__text">Campus network connectivity, Wi‑Fi access, and related infrastructure.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">school</i></span>
                            <h3 class="mission-card__title">Learning management system</h3>
                            <p class="mission-card__text">Online course delivery, materials, and student engagement tools.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">apps</i></span>
                            <h3 class="mission-card__title">Software &amp; tools</h3>
                            <p class="mission-card__text">Licensed software and productivity applications for campus users.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">computer</i></span>
                            <h3 class="mission-card__title">Hardware &amp; devices</h3>
                            <p class="mission-card__text">Computer laboratories, device support, and printing services.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">forum</i></span>
                            <h3 class="mission-card__title">Communication tools</h3>
                            <p class="mission-card__text">Email, conferencing, and collaboration platforms for the university community.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="uitc-panel-support" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="uitc-tab-support" hidden>
                <section class="uitc-block" aria-labelledby="uitc-support-heading">
                    <h2 id="uitc-support-heading" class="site-section-title">Support &amp; helpdesk</h2>
                    <div class="uitc-support-grid">
                        <div class="uitc-info">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">headset_mic</i></span>
                            <h3 class="uitc-info__title">Contact</h3>
                            <dl class="contact-list">
                                <div class="contact-list__item">
                                    <dt>Email</dt>
                                    <dd><a href="mailto:visayas.uitc@tup.edu.ph">visayas.uitc@tup.edu.ph</a></dd>
                                </div>
                                <div class="contact-list__item">
                                    <dt>Telephone</dt>
                                    <dd><a href="tel:+63344953480">(034) 495-3480</a></dd>
                                </div>
                                <div class="contact-list__item">
                                    <dt>Office</dt>
                                    <dd>University Information Technology Center, TUP Visayas</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="uitc-info">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">schedule</i></span>
                            <h3 class="uitc-info__title">Service hours</h3>
                            <ul class="mission-list">
                                <li>Monday to Friday — 8:00 AM to 5:00 PM</li>
                                <li>Saturday — closed</li>
                                <li>Sunday — closed</li>
                            </ul>
                        </div>
                        <div class="uitc-info">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">help_outline</i></span>
                            <h3 class="uitc-info__title">Common requests</h3>
                            <ul class="mission-list">
                                <li>Password reset procedures</li>
                                <li>Campus Wi‑Fi connection</li>
                                <li>LMS access from off campus</li>
                                <li>Email and account issues</li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <div id="uitc-panel-security" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="uitc-tab-security" hidden>
                <section class="uitc-block" aria-labelledby="uitc-security-heading">
                    <h2 id="uitc-security-heading" class="site-section-title">Security &amp; policies</h2>
                    <div class="uitc-grid uitc-grid--three">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">security</i></span>
                            <h3 class="mission-card__title">Cybersecurity awareness</h3>
                            <p class="mission-card__text">Guidance on protecting accounts, devices, and university data.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">policy</i></span>
                            <h3 class="mission-card__title">IT policies</h3>
                            <p class="mission-card__text">Acceptable use and technology policies for the TUP community.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">lock</i></span>
                            <h3 class="mission-card__title">Account security</h3>
                            <p class="mission-card__text">Strong passwords and multi-factor authentication where applicable.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="uitc-panel-students" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="uitc-tab-students" hidden>
                <section class="uitc-block" aria-labelledby="uitc-students-heading">
                    <h2 id="uitc-students-heading" class="site-section-title">Student digital resources</h2>
                    <div class="uitc-grid uitc-grid--two">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">how_to_reg</i></span>
                            <h3 class="mission-card__title">Enrollment &amp; records (ERS)</h3>
                            <p class="mission-card__text">Online enrollment, grades, and student records through the TUP ERS portal.</p>
                            <p class="uitc-card-link">
                                <a href="https://ers.tup.edu.ph/aims/students/" target="_blank" rel="noopener noreferrer">Open student ERS</a>
                            </p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">email</i></span>
                            <h3 class="mission-card__title">Student email</h3>
                            <p class="mission-card__text">Official university email for students. Contact UITC for account assistance.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">local_library</i></span>
                            <h3 class="mission-card__title">E-library &amp; research</h3>
                            <p class="mission-card__text">Digital library and research resources available through campus services.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">menu_book</i></span>
                            <h3 class="mission-card__title">Learning management system</h3>
                            <p class="mission-card__text">Course materials and online activities provided by faculty through the LMS.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="uitc-panel-faculty" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="uitc-tab-faculty" hidden>
                <section class="uitc-block" aria-labelledby="uitc-faculty-heading">
                    <h2 id="uitc-faculty-heading" class="site-section-title">Faculty technology resources</h2>
                    <div class="uitc-grid uitc-grid--two">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">badge</i></span>
                            <h3 class="mission-card__title">Faculty ERS</h3>
                            <p class="mission-card__text">Faculty access to enrollment, grading, and related academic systems.</p>
                            <p class="uitc-card-link">
                                <a href="https://ers.tup.edu.ph/aims/faculty/" target="_blank" rel="noopener noreferrer">Open faculty ERS</a>
                            </p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">cast_for_education</i></span>
                            <h3 class="mission-card__title">LMS management</h3>
                            <p class="mission-card__text">Course setup, content delivery, and student engagement through the LMS.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">groups</i></span>
                            <h3 class="mission-card__title">Collaboration tools</h3>
                            <p class="mission-card__text">Email, conferencing, and shared workspaces for teaching and administration.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">cloud_upload</i></span>
                            <h3 class="mission-card__title">Research &amp; file storage</h3>
                            <p class="mission-card__text">Secure storage and backup options for academic and research materials.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="uitc-panel-team" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="uitc-tab-team" hidden>
                <section class="uitc-block" aria-labelledby="uitc-team-heading">
                    <h2 id="uitc-team-heading" class="site-section-title">UITC team</h2>
                    <p class="uitc-block__intro uitc-block__intro--center">Organizational structure of the University Information Technology Center at TUP Visayas.</p>

                    <div class="uitc-org" role="group" aria-label="UITC organizational chart">
                        <div class="uitc-org__level">
                            <article class="uitc-org__card uitc-org__card--lead">
                                <img src="{{ asset('images/Malo-oy, Eric A-2154.jpg') }}" alt="Dr. Eric A. Malo-oy" loading="lazy">
                                <p class="uitc-org__level-label">Campus head</p>
                                <strong>Dr. Eric A. Malo-oy</strong>
                                <span>Campus Director</span>
                            </article>
                        </div>

                        <div class="uitc-org__line" aria-hidden="true"></div>

                        <div class="uitc-org__level">
                            <article class="uitc-org__card">
                                <img src="{{ asset('images/tupan,jofred.jpg') }}" alt="Jofred S. Tupan" loading="lazy">
                                <p class="uitc-org__level-label">UITC administration</p>
                                <strong>Jofred S. Tupan</strong>
                                <span>UITC Administrator</span>
                            </article>
                        </div>

                        <div class="uitc-org__line" aria-hidden="true"></div>

                        <div class="uitc-org__staff-tree">
                            <p class="uitc-org__staff-label">UITC staff</p>
                            <div class="uitc-org__staff-row">
                                <div class="uitc-org__staff-item">
                                    <article class="uitc-org__card">
                                        <img src="{{ asset('images/faciolan-chris.jpg') }}" alt="Engr. Christopher Faciolan, PECE" loading="lazy">
                                        <strong>Engr. Christopher Faciolan, PECE</strong>
                                        <span>Network Administrator</span>
                                    </article>
                                </div>
                                <div class="uitc-org__staff-item">
                                    <article class="uitc-org__card">
                                        <img src="{{ asset('images/Suela, Ricardo F Jr-2211.jpg') }}" alt="Ricardo Suela" loading="lazy">
                                        <strong>Ricardo Suela</strong>
                                        <span>UITC Staff</span>
                                    </article>
                                </div>
                                <div class="uitc-org__staff-item">
                                    <article class="uitc-org__card">
                                        <img src="{{ asset('images/Pitong, Rhemjohn Dave N-2902-copy.jpg') }}"
                                            alt="Engr. Rhemjohn Dave N. Pitong" loading="lazy">
                                        <strong>Engr. Rhemjohn Dave N. Pitong</strong>
                                        <span>Web Administrator</span>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <section class="uitc-quick" aria-labelledby="uitc-quick-heading">
            <h2 id="uitc-quick-heading" class="site-section-title">Quick links</h2>
            <ul class="home-quick">
                <li>
                    <a href="https://ers.tup.edu.ph/aims/students/" target="_blank" rel="noopener noreferrer">Student ERS</a>
                </li>
                <li>
                    <a href="https://ers.tup.edu.ph/aims/faculty/" target="_blank" rel="noopener noreferrer">Faculty ERS</a>
                </li>
                <li>
                    <a href="mailto:visayas.uitc@tup.edu.ph">IT helpdesk email</a>
                </li>
                <li>
                    <a href="{{ route('contact') }}">Campus contact</a>
                </li>
            </ul>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var root = document.querySelector('[data-uitc-tabs]');
            if (!root) return;

            var buttons = root.querySelectorAll('[data-uitc-tab]');
            var panels = root.querySelectorAll('.uitc-tabs__panel');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var targetId = button.getAttribute('data-uitc-tab');

                    buttons.forEach(function(btn) {
                        btn.classList.remove('is-active');
                        btn.setAttribute('aria-selected', 'false');
                    });

                    panels.forEach(function(panel) {
                        panel.classList.remove('is-active');
                        panel.hidden = true;
                    });

                    button.classList.add('is-active');
                    button.setAttribute('aria-selected', 'true');

                    var panel = document.getElementById(targetId);
                    if (panel) {
                        panel.classList.add('is-active');
                        panel.hidden = false;
                    }
                });
            });
        });
    </script>
@endsection
