@extends('layouts.app')

@section('title', 'Freshmen Admission (TUPSTAT) - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    <meta name="description" content="Guided freshmen admissions for TUP Visayas (TUPSTAT): choose a program, prepare requirements, take the admission test, enroll, and start orientation.">
@endsection

@section('content')
    <div class="site-page site-page--enrollment">
        <figure class="enrollment-banner">
            <img src="{{ asset('images/admission-banner.jpg') }}"
                alt="TUP Visayas admission test — Be a Haligi ng Bayan, Be a TUPVIAN" loading="eager">
        </figure>

        <div class="enrollment-inner">
            <h1 class="site-page-title site-page-title--center">Freshmen Admission (TUPSTAT)</h1>
            <p class="site-page-intro">TUP Visayas Admission Test — a step-by-step guide from choosing a program to enrollment.</p>

            <div class="enrollment-actions" role="group" aria-label="Primary admission actions">
                <a class="enrollment-actions__cta"
                    href="https://ers.tup.edu.ph/aims/applicants/"
                    target="_blank"
                    rel="noopener noreferrer">Apply on ERS</a>
                <a class="enrollment-actions__link" href="{{ route('academics.undergraduate') }}">Choose a program</a>
                <a class="enrollment-actions__link" href="#admission-test-schedule">Test schedule</a>
            </div>

            <nav class="enrollment-journey" aria-label="Admissions journey">
                <ol class="enrollment-journey__list">
                    <li><a href="#step-program">1. Choose program</a></li>
                    <li><a href="#step-requirements">2. Requirements</a></li>
                    <li><a href="#step-apply">3. Apply online</a></li>
                    <li><a href="#step-exam">4. Entrance exam</a></li>
                    <li><a href="#step-enrollment">5. Enrollment</a></li>
                    <li><a href="#step-orientation">6. Orientation</a></li>
                </ol>
            </nav>

            <section class="enrollment-about" aria-labelledby="enrollment-about-heading">
                <div class="enrollment-about__content">
                    <h2 id="enrollment-about-heading" class="enrollment-about__title">Be Haligi ng Bayan. Build skills, shape the nation.</h2>
                    <p>The Technological University of the Philippines Visayas (TUPV) admits a select number of freshmen each academic year who demonstrate the potential to succeed in rigorous technological and professional programs.</p>
                    <p>Admission to TUP Visayas is a privilege. As a state university committed to excellence, service, and nation-building, TUPV reserves the right to deny admission or require the withdrawal of students whose conduct or presence is deemed inconsistent with the University&rsquo;s mission, objectives, and regulations.</p>
                    <p class="enrollment-notice enrollment-notice--inline"><strong>Tuition note:</strong> Consistent with universal access to quality tertiary education policies for eligible students in SUCs, <strong>no admission testing fee shall be collected</strong>. Official tuition and other fees (if any) are announced by the campus for each academic year—confirm with the Admissions or Registrar&rsquo;s Office when you enroll.</p>
                </div>
                <figure class="enrollment-about__media">
                    <img src="{{ asset('images/admission-student.jpg') }}" alt="TUP Visayas student" loading="lazy">
                </figure>
            </section>

            {{-- Step 1 --}}
            <article id="step-program" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">1</span>
                    <h2 class="enrollment-step__title">Choose a program</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Review undergraduate programs and college pages, then decide which course you will apply for on ERS.</p>
                    <ul>
                        <li><a href="{{ route('academics.undergraduate') }}">Browse undergraduate programs</a></li>
                        <li><a href="{{ route('academics') }}">Academics overview &amp; colleges</a></li>
                    </ul>
                </div>
            </article>

            {{-- Step 2 --}}
            <article id="step-requirements" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">2</span>
                    <h2 class="enrollment-step__title">Prepare your requirements</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Have these ready before you start the online application:</p>
                    <ul class="enrollment-checklist enrollment-checklist--plain">
                        <li>Recent <strong>2&times;2 photo</strong> in <strong>.jpeg</strong> or <strong>.jpg</strong> (low resolution for upload)</li>
                        <li>Personal and family background information</li>
                        <li>Educational attainment details (senior high / ALS / equivalent)</li>
                        <li>Valid email address and contact number</li>
                        <li>Preferred admission test schedule (see Step 4)</li>
                    </ul>
                    <aside class="enrollment-callout">
                        <p class="enrollment-callout__title">Downloadable checklist</p>
                        <p>Use this checklist while preparing your application. You can print this page section for your records.</p>
                        <ul>
                            <li>☐ Chose a preferred program</li>
                            <li>☐ Prepared 2&times;2 photo (.jpg / .jpeg)</li>
                            <li>☐ Family &amp; educational background details ready</li>
                            <li>☐ Noted preferred exam date from the schedule below</li>
                            <li>☐ Saved ERS username &amp; password after applying</li>
                            <li>☐ Printed or screenshot application form for test day</li>
                        </ul>
                    </aside>
                </div>
            </article>

            {{-- Step 3 --}}
            <article id="step-apply" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">3</span>
                    <h2 class="enrollment-step__title">Apply online (ERS)</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Submit your freshman application through the TUP Electronic Registration System (ERS).</p>

                    <h3 class="enrollment-step__subtitle">3.1 Open the applicant portal</h3>
                    <p>Visit <a href="https://ers.tup.edu.ph/aims/applicants/" target="_blank" rel="noopener noreferrer">ers.tup.edu.ph/aims/applicants/</a>, then click <strong>Apply</strong>.</p>

                    <h3 class="enrollment-step__subtitle">3.2 Complete the profile verification form</h3>
                    <ul>
                        <li>Select <strong>Visayas Campus</strong>, then click <strong>Continue</strong>.</li>
                        <li>Fill out all required information.</li>
                    </ul>
                    <aside class="enrollment-callout">
                        <p class="enrollment-callout__title">Important reminders</p>
                        <ul>
                            <li>Complete the <strong>Family Background</strong> and <strong>Educational Attainment</strong> sections.</li>
                            <li>Upload a low-resolution <strong>2&times;2 photo</strong> in <strong>.jpeg</strong> or <strong>.jpg</strong> format.</li>
                            <li>Skip the <strong>Employment Background</strong> section, but ensure the <strong>Data Subject Consent Form</strong> is checked.</li>
                        </ul>
                    </aside>

                    <h3 class="enrollment-step__subtitle">3.3 Select exam schedule</h3>
                    <p>Click the <strong>Exam Schedule</strong> button at the top of the page and select your preferred admission test schedule.</p>

                    <h3 class="enrollment-step__subtitle">3.4 Save your account details</h3>
                    <p>Save a screenshot of your <strong>Account Details (USERNAME and PASSWORD)</strong> or print a copy of your application form.</p>

                    <p>
                        <a class="enrollment-actions__cta" href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                            rel="noopener noreferrer">Go to ERS apply</a>
                    </p>
                </div>
            </article>

            {{-- Step 4 --}}
            <article id="step-exam" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">4</span>
                    <h2 class="enrollment-step__title">Take the entrance examination</h2>
                </header>
                <div class="enrollment-step__body">
                    <section id="admission-test-schedule" class="enrollment-block enrollment-block--nested" aria-labelledby="schedule-heading">
                        <h3 id="schedule-heading" class="enrollment-step__subtitle">Admission test schedule</h3>
                        @if ($schedules->count())
                            <div class="site-table-scroll">
                                <table class="enrollment-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">Time</th>
                                            <th scope="col">Venue</th>
                                            <th scope="col">Address</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($schedules as $schedule)
                                            <tr>
                                                <td>{{ $schedule->exam_date->format('F j') }}</td>
                                                <td>
                                                    @foreach ($schedule->timeLines() as $line)
                                                        {{ $line }}@if (!$loop->last)<br>@endif
                                                    @endforeach
                                                </td>
                                                <td>
                                                    {{ $schedule->venue }}
                                                    @if ($schedule->venue_note)
                                                        <br><span class="enrollment-table__note">{{ $schedule->venue_note }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $schedule->address }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p class="enrollment-note">Admission test dates will be posted here when available. Please check back or contact Admissions.</p>
                        @endif
                        <p class="enrollment-note">Additional test dates may be announced based on the number of applicants.</p>
                    </section>

                    <h3 class="enrollment-step__subtitle">On the day of the admission test</h3>
                    <ul class="enrollment-checklist">
                        <li>Present a screenshot or printed copy of your application form.</li>
                        <li>Memorize your contact number, email address, and Applicant ID number as indicated on your proof of registration.</li>
                        <li>Bring <strong>two (2) sharpened pencils</strong>.</li>
                        <li>Dress appropriately: <strong>no shorts, sleeveless tops, or slippers</strong>.</li>
                        <li><strong>Watches are not allowed</strong>.</li>
                        <li>Ensure that <strong>cellphones and other electronic devices are turned off</strong> upon entering the venue.</li>
                        <li><strong>Arrive at least 30 minutes before</strong> your scheduled test time.</li>
                        <li>Walk-in applicants may be accommodated depending on available slots.</li>
                        <li><strong>Parents, guardians, and companions are not allowed</strong> to enter the testing venue.</li>
                    </ul>
                </div>
            </article>

            {{-- Step 5 --}}
            <article id="step-enrollment" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">5</span>
                    <h2 class="enrollment-step__title">Enrollment</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>After the admission process and release of results, qualified applicants proceed to enrollment as announced by the campus (including documentary requirements and registration windows).</p>
                    <ul>
                        <li>Watch this page, campus announcements, and your ERS account for enrollment advisories.</li>
                        <li>Prepare senior high school credentials and other documents required in the enrollment notice.</li>
                        <li>For general campus inquiries, see <a href="{{ route('contact') }}">Contact us</a>.</li>
                    </ul>
                </div>
            </article>

            {{-- Step 6 --}}
            <article id="step-orientation" class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">6</span>
                    <h2 class="enrollment-step__title">Orientation</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Newly enrolled freshmen attend campus orientation covering academic policies, student services, and campus life. Dates and venues are announced after enrollment.</p>
                    <ul>
                        <li><a href="{{ route('student_services') }}">Student services overview</a></li>
                        <li><a href="{{ route('announcements.index') }}">Campus announcements</a></li>
                    </ul>
                </div>
            </article>

            {{-- Scholarships --}}
            <section id="scholarships" class="enrollment-block" aria-labelledby="scholarships-heading">
                <h2 id="scholarships-heading" class="site-section-title">Scholarships &amp; financial aid</h2>
                <p>Scholarship and assistance options (including government and campus programs) are published with each academic year&rsquo;s advisories. Check program pages for program-specific notes, and contact Admissions or the Office of Student Affairs for current openings.</p>
                <ul>
                    <li><a href="{{ route('academics.undergraduate') }}">Program pages</a> (see scholarships sections when published)</li>
                    <li><a href="{{ route('student_services') }}">Student services / OSA</a></li>
                </ul>
            </section>

            {{-- FAQ --}}
            <section id="admission-faq" class="enrollment-block" aria-labelledby="faq-heading">
                <h2 id="faq-heading" class="site-section-title">Frequently asked questions</h2>
                <div class="enrollment-faq">
                    <details class="enrollment-faq__item">
                        <summary>Who can apply as a freshman?</summary>
                        <p>Incoming first-year undergraduate applicants applying for TUP Visayas through the ERS applicant portal. Select <strong>Visayas Campus</strong> during profile verification.</p>
                    </details>
                    <details class="enrollment-faq__item">
                        <summary>Is there an admission testing fee?</summary>
                        <p><strong>No.</strong> In accordance with the policy on universal access to education, no admission testing fee shall be collected.</p>
                    </details>
                    <details class="enrollment-faq__item">
                        <summary>What photo should I upload?</summary>
                        <p>A low-resolution <strong>2&times;2</strong> photo in <strong>.jpeg</strong> or <strong>.jpg</strong> format.</p>
                    </details>
                    <details class="enrollment-faq__item">
                        <summary>Can parents enter the testing venue?</summary>
                        <p>No. Parents, guardians, and companions are not allowed to enter the testing venue.</p>
                    </details>
                    <details class="enrollment-faq__item">
                        <summary>Where do I see the exam schedule?</summary>
                        <p>See <a href="#admission-test-schedule">Admission test schedule</a> on this page, and also select your preferred schedule inside ERS.</p>
                    </details>
                    <details class="enrollment-faq__item">
                        <summary>I forgot my ERS username or password. What should I do?</summary>
                        <p>Use the recovery options on the ERS portal if available, or contact campus Admissions / UITC support with your full name and applicant details for assistance.</p>
                    </details>
                </div>
            </section>

            {{-- Map & contacts --}}
            <section id="admission-contact" class="enrollment-block" aria-labelledby="contact-heading">
                <h2 id="contact-heading" class="site-section-title">Campus map &amp; contacts</h2>
                <div class="enrollment-contact">
                    <div class="enrollment-contact__info">
                        <dl class="contact-list">
                            <div class="contact-list__item">
                                <dt>Campus</dt>
                                <dd>Technological University of the Philippines Visayas</dd>
                            </div>
                            <div class="contact-list__item">
                                <dt>Address</dt>
                                <dd>Capt. Sabi Street, Brgy. Zone 12, Talisay City, Negros Occidental 6115</dd>
                            </div>
                            <div class="contact-list__item">
                                <dt>Telephone</dt>
                                <dd><a href="tel:+63344953480">(034) 495-3480</a></dd>
                            </div>
                            <div class="contact-list__item">
                                <dt>More contacts</dt>
                                <dd><a href="{{ route('contact') }}">Full contact page</a></dd>
                            </div>
                        </dl>
                    </div>
                    <div class="enrollment-contact__map site-embed">
                        <iframe
                            src="https://maps.google.com/maps?q=Technological+University+of+the+Philippines+Visayas,+Capitan+Sabi+Street,+Talisay+City,+Negros+Occidental&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                            title="TUP Visayas campus map"
                            allowfullscreen
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </section>
        </div>
    </div>
@endsection
