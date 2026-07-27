@extends('layouts.app')

@section('title', 'Freshmen Admission (TUPSTAT) - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    <meta name="description"
        content="Apply to TUP Visayas through TUPSTAT: admission journey, required documents, important dates, and FAQs.">
@endsection

@section('content')
    @php
        $syStart = now()->month >= 6 ? now()->year : now()->year - 1;
        $syEnd = $syStart + 1;
        $syLabel = $syStart . '–' . $syEnd;
        $firstExam = $schedules->first();
        $lastExam = $schedules->last();
        $examRange = null;
        if ($firstExam && $lastExam) {
            $examRange =
                $firstExam->id === $lastExam->id
                    ? $firstExam->exam_date->format('M j, Y')
                    : $firstExam->exam_date->format('M j') . ' – ' . $lastExam->exam_date->format('M j, Y');
        }
    @endphp

    <div class="site-page site-page--admission">
        {{-- Hero --}}
        <section class="adm-hero" aria-labelledby="adm-hero-heading">
            <div class="adm-hero__inner">
                <div class="adm-hero__copy">
                    <p class="adm-hero__badge">{{ $syLabel }} Admission Open</p>
                    <h1 id="adm-hero-heading" class="adm-hero__title">
                        Shape Your Future at
                        <span class="adm-hero__accent">TUPSTAT Admission Test</span>
                    </h1>
                    <p class="adm-hero__lede">
                        The TUP Scholastic and Technical Aptitude Test (TUPSTAT) is your gateway to engineering and
                        technology programs at TUP Visayas. Apply online, prepare your documents, and take the next step
                        toward becoming a Haligi ng Bayan.
                    </p>
                    <div class="adm-hero__actions">
                        <a class="adm-btn adm-btn--primary"
                            href="https://ers.tup.edu.ph/aims/applicants/"
                            target="_blank"
                            rel="noopener noreferrer">
                            Apply Online Now
                            <span aria-hidden="true">→</span>
                        </a>
                        <a class="adm-btn adm-btn--ghost" href="#required-documents">
                            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                stroke-width="1.8" aria-hidden="true">
                                <path d="M12 4v10M8 10l4 4 4-4M5 18h14" />
                            </svg>
                            View Guidelines
                        </a>
                    </div>
                    <p class="adm-hero__note">
                        <strong>No admission testing fee</strong> is collected, consistent with universal access policies
                        for eligible students in SUCs.
                    </p>
                </div>
                <figure class="adm-hero__media">
                    <img src="{{ asset('images/admission-student.jpg') }}?v={{ @filemtime(public_path('images/admission-student.jpg')) ?: time() }}"
                        alt="Students at TUP Visayas campus" loading="eager">
                </figure>
            </div>
        </section>

        {{-- Journey --}}
        <section class="adm-section" aria-labelledby="journey-heading">
            <header class="adm-section__head adm-section__head--center">
                <h2 id="journey-heading" class="adm-section__title">The Admission Journey</h2>
                <p class="adm-section__lede">Follow these six steps from online application to enrollment at TUP Visayas.</p>
            </header>

            <ol class="adm-journey">
                <li class="adm-journey__card" id="step-apply">
                    <span class="adm-journey__num" aria-hidden="true">01</span>
                    <h3 class="adm-journey__title">Online Registration</h3>
                    <p class="adm-journey__text">Create your applicant account on the TUP ERS portal and select
                        <strong>Visayas Campus</strong>.</p>
                </li>
                <li class="adm-journey__card" id="step-requirements">
                    <span class="adm-journey__num" aria-hidden="true">02</span>
                    <h3 class="adm-journey__title">Document Upload</h3>
                    <p class="adm-journey__text">Upload a low-resolution 2&times;2 photo (.jpg / .jpeg) and complete family
                        and educational background details.</p>
                </li>
                <li class="adm-journey__card">
                    <span class="adm-journey__num" aria-hidden="true">03</span>
                    <h3 class="adm-journey__title">Select Schedule</h3>
                    <p class="adm-journey__text">Choose your preferred admission test date and time in ERS. No testing fee
                        is collected.</p>
                </li>
                <li class="adm-journey__card" id="step-exam">
                    <span class="adm-journey__num" aria-hidden="true">04</span>
                    <h3 class="adm-journey__title">The TUPSTAT Exam</h3>
                    <p class="adm-journey__text">Take the entrance examination on your scheduled date. Arrive early with
                        your application proof and required materials.</p>
                </li>
                <li class="adm-journey__card">
                    <span class="adm-journey__num" aria-hidden="true">05</span>
                    <h3 class="adm-journey__title">Results &amp; Advisories</h3>
                    <p class="adm-journey__text">Check ERS and campus announcements for results and any follow-up
                        instructions from Admissions.</p>
                </li>
                <li class="adm-journey__card" id="step-enrollment">
                    <span class="adm-journey__num" aria-hidden="true">06</span>
                    <h3 class="adm-journey__title">Final Enrollment</h3>
                    <p class="adm-journey__text">Qualified applicants complete enrollment and orientation as announced by
                        the campus for the academic year.</p>
                </li>
            </ol>
        </section>

        {{-- Documents --}}
        <section class="adm-section adm-section--docs" id="required-documents" aria-labelledby="docs-heading">
            <header class="adm-section__head">
                <h2 id="docs-heading" class="adm-section__title">Required Documents</h2>
                <p class="adm-section__lede">Prepare these credentials for application and enrollment verification.</p>
            </header>

            <div class="adm-docs">
                <aside class="adm-docs__note">
                    <p class="adm-docs__note-label">Note</p>
                    <p>Digital uploads on ERS support your application. Original documents may still be required for
                        physical verification during enrollment. Always follow the latest campus advisory.</p>
                </aside>

                <div class="adm-docs__col">
                    <h3 class="adm-docs__col-title">Incoming Freshmen</h3>
                    <ul class="adm-docs__list">
                        <li>Recent 2&times;2 photo (.jpg / .jpeg) for ERS upload</li>
                        <li>Form 138 / Senior High School report card (upon enrollment)</li>
                        <li>PSA Birth Certificate</li>
                        <li>Certificate of Good Moral Character</li>
                        <li>Personal, family, and educational background details</li>
                    </ul>
                </div>

                <div class="adm-docs__col">
                    <h3 class="adm-docs__col-title">Transferees</h3>
                    <ul class="adm-docs__list">
                        <li>Official Transcript of Records</li>
                        <li>Transfer credentials / Honorable Dismissal</li>
                        <li>Course descriptions (for crediting evaluation)</li>
                        <li>Certificate of Good Moral Character</li>
                        <li>Other documents as required in the campus transfer advisory</li>
                    </ul>
                </div>
            </div>

            <p class="adm-docs__program">
                Still choosing a course?
                <a href="{{ route('academics.undergraduate') }}">Browse undergraduate programs</a>
            </p>
        </section>

        {{-- Important dates --}}
        <section class="adm-dates" id="admission-test-schedule" aria-labelledby="dates-heading">
            <div class="adm-dates__inner">
                <header class="adm-dates__head">
                    <div>
                        <p class="adm-dates__eyebrow">Admission calendar</p>
                        <h2 id="dates-heading" class="adm-dates__title">Important Dates for {{ $syStart }}–{{ $syEnd }}</h2>
                    </div>
                    <p class="adm-dates__lede">Stay updated with the official timeline. Additional test dates may be
                        announced based on applicant volume.</p>
                </header>

                <div class="adm-dates__grid">
                    <div class="adm-dates__item">
                        <p class="adm-dates__when">Open now</p>
                        <p class="adm-dates__what">Application starts</p>
                        <p class="adm-dates__detail">Apply via ERS applicant portal</p>
                    </div>
                    <div class="adm-dates__item">
                        <p class="adm-dates__when">As announced</p>
                        <p class="adm-dates__what">Deadline</p>
                        <p class="adm-dates__detail">Follow ERS and campus advisories</p>
                    </div>
                    <div class="adm-dates__item">
                        <p class="adm-dates__when">{{ $examRange ?: 'To be posted' }}</p>
                        <p class="adm-dates__what">TUPSTAT dates</p>
                        <p class="adm-dates__detail">Published exam schedules below</p>
                    </div>
                    <div class="adm-dates__item">
                        <p class="adm-dates__when">As announced</p>
                        <p class="adm-dates__what">Release of results</p>
                        <p class="adm-dates__detail">Check ERS and announcements</p>
                    </div>
                </div>

                @if ($schedules->count())
                    <div class="adm-dates__table-wrap">
                        <h3 class="adm-dates__table-title">Published test schedules</h3>
                        <div class="site-table-scroll">
                            <table class="adm-table">
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
                                            <td>{{ $schedule->exam_date->format('F j, Y') }}</td>
                                            <td>
                                                @foreach ($schedule->timeLines() as $line)
                                                    {{ $line }}@if (!$loop->last)<br>@endif
                                                @endforeach
                                            </td>
                                            <td>
                                                {{ $schedule->venue }}
                                                @if ($schedule->venue_note)
                                                    <br><span class="adm-table__note">{{ $schedule->venue_note }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $schedule->address }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @else
                    <p class="adm-dates__empty">Admission test dates will appear here when published. Please check back or
                        contact Admissions.</p>
                @endif
            </div>
        </section>

        {{-- Exam day tips --}}
        <section class="adm-section" aria-labelledby="examday-heading">
            <header class="adm-section__head adm-section__head--center">
                <h2 id="examday-heading" class="adm-section__title">On the day of the admission test</h2>
                <p class="adm-section__lede">Bring what you need and follow venue rules so your exam day runs smoothly.</p>
            </header>
            <ul class="adm-checklist">
                <li>Present a screenshot or printed copy of your application form.</li>
                <li>Know your contact number, email, and Applicant ID from your registration proof.</li>
                <li>Bring <strong>two (2) sharpened pencils</strong>.</li>
                <li>Dress appropriately: <strong>no shorts, sleeveless tops, or slippers</strong>.</li>
                <li><strong>Watches are not allowed.</strong> Turn off cellphones and other electronics at the venue.</li>
                <li><strong>Arrive at least 30 minutes before</strong> your scheduled time.</li>
                <li><strong>Parents, guardians, and companions are not allowed</strong> inside the testing venue.</li>
            </ul>
        </section>

        {{-- FAQ --}}
        <section class="adm-section" id="admission-faq" aria-labelledby="faq-heading">
            <header class="adm-section__head adm-section__head--center">
                <h2 id="faq-heading" class="adm-section__title">Frequently Asked Questions</h2>
            </header>
            <div class="adm-faq">
                <details class="adm-faq__item">
                    <summary>Can I apply if I haven&rsquo;t graduated yet?</summary>
                    <p>Yes—incoming senior high completers may apply as freshmen through ERS. Bring final credentials when
                        enrollment requirements are announced.</p>
                </details>
                <details class="adm-faq__item">
                    <summary>Is there a quota for each course?</summary>
                    <p>Programs admit a limited number of freshmen each year. Choosing a program early and completing your
                        ERS application on time improves your chances of securing a preferred schedule and slot.</p>
                </details>
                <details class="adm-faq__item">
                    <summary>How much is the TUPSTAT application fee?</summary>
                    <p><strong>None.</strong> No admission testing fee shall be collected, consistent with universal access
                        to quality tertiary education policies for eligible students in SUCs.</p>
                </details>
                <details class="adm-faq__item">
                    <summary>What if I miss my scheduled exam date?</summary>
                    <p>Contact Admissions as soon as possible. Makeup or alternate schedules depend on available slots and
                        campus announcements—do not assume a walk-in seat without confirmation.</p>
                </details>
                <details class="adm-faq__item">
                    <summary>What photo should I upload on ERS?</summary>
                    <p>A low-resolution <strong>2&times;2</strong> photo in <strong>.jpeg</strong> or <strong>.jpg</strong>
                        format.</p>
                </details>
                <details class="adm-faq__item">
                    <summary>I forgot my ERS username or password. What should I do?</summary>
                    <p>Use recovery options on the ERS portal if available, or contact campus Admissions / UITC with your
                        full name and applicant details for assistance.</p>
                </details>
            </div>
        </section>

        {{-- CTA --}}
        <section class="adm-cta" aria-labelledby="adm-cta-heading">
            <div class="adm-cta__inner">
                <h2 id="adm-cta-heading" class="adm-cta__title">
                    Ready to join the <span class="adm-hero__accent">Technological Elite?</span>
                </h2>
                <p class="adm-cta__lede">Start your application on the official TUP ERS portal, or reach the Admissions
                    Office if you need help.</p>
                <div class="adm-cta__actions">
                    <a class="adm-btn adm-btn--primary"
                        href="https://ers.tup.edu.ph/aims/applicants/"
                        target="_blank"
                        rel="noopener noreferrer">Apply Online</a>
                    <a class="adm-btn adm-btn--muted" href="{{ route('contact') }}">Contact Admission Office</a>
                </div>
            </div>
        </section>
    </div>
@endsection
