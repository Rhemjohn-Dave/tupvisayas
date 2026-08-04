@extends('layouts.app')

@section('title', 'Supervised Industrial Training (SIT) - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Supervised Industrial Training (SIT) at TUP Visayas — industry immersion for engineering and technology students. Deployment schedules, partners, and office contacts.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Supervised Industrial Training (SIT) - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        $schedules = [
            [
                'title' => 'College of Engineering (COE)',
                'note' => 'Except BS Computer Engineering (see schedule below).',
                'rows' => [
                    ['year' => '1st Year', 'course' => 'SIT 1', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '2nd Year', 'course' => 'SIT 2', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '3rd Year', 'course' => 'SIT 3', 'term' => 'Summer', 'duration' => '6 weeks'],
                ],
            ],
            [
                'title' => 'BS Computer Engineering',
                'note' => 'Under the College of Engineering.',
                'rows' => [
                    ['year' => '1st Year', 'course' => 'SIT 1', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '2nd Year', 'course' => 'SIT 2', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '3rd Year', 'course' => 'SIT 3', 'term' => 'Summer', 'duration' => '10 weeks'],
                ],
            ],
            [
                'title' => 'College of Engineering Technology (COET)',
                'note' => null,
                'rows' => [
                    ['year' => '3rd Year', 'course' => 'SIT 1', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '4th Year', 'course' => 'SIT 2', 'term' => '2nd Term', 'duration' => '20 weeks'],
                ],
            ],
            [
                'title' => 'College of Automation and Control (COAC)',
                'note' => null,
                'rows' => [
                    ['year' => '3rd Year', 'course' => 'SIT 1', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '4th Year', 'course' => 'SIT 2', 'term' => '2nd Term', 'duration' => '20 weeks'],
                ],
            ],
            [
                'title' => 'BS Chemistry',
                'note' => null,
                'rows' => [
                    ['year' => '2nd Year', 'course' => 'SIT 1', 'term' => 'Summer', 'duration' => '6 weeks'],
                    ['year' => '3rd Year', 'course' => 'SIT 2', 'term' => '3rd Term', 'duration' => '15 weeks'],
                ],
            ],
        ];
    @endphp

    <div class="site-page site-page--sit">
        {{-- Hero --}}
        <section class="acad-hero" aria-labelledby="sit-hero-heading">
            <p class="acad-hero__badge">External Affairs · Linkages &amp; Consortia</p>
            <p class="sit-hero__motto">Changing lives since 1977..</p>
            <h1 id="sit-hero-heading" class="acad-hero__title">Supervised Industrial Training</h1>
            <p class="acad-hero__lede">
                Also known as <strong>SIT</strong> or <strong>OJT</strong> — structured industry immersion that
                prepares TUP Visayas students for real workplace practice.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#sit-schedules">Deployment schedules</a>
                <a class="acad-btn acad-btn--ghost" href="#sit-partners">Industry partners</a>
                <a class="acad-btn acad-btn--ghost" href="#sit-contact">Contact SIT Office</a>
            </div>
        </section>

        {{-- What is SIT --}}
        <section class="sit-section" aria-labelledby="sit-about-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">About the program</p>
                    <h2 id="sit-about-heading" class="sit-section__title">What is SIT?</h2>
                </header>
                <p class="sit-prose">
                    The Supervised Industrial Training is intended to provide industrial experience to the students
                    so that they will be able to gain necessary knowledge, skills and work attitudes consistent with
                    the requirements of the industry, thereby becoming more effective, efficient and productive
                    citizens of the society.
                </p>
                <ul class="sit-check-list" aria-label="SIT outcomes">
                    <li>Apply classroom theory in actual industrial settings</li>
                    <li>Build professional work habits, safety awareness, and teamwork</li>
                    <li>Strengthen career readiness before graduation</li>
                    <li>Connect students with possible employers and mentors</li>
                </ul>
            </div>
        </section>

        {{-- Deployment schedules --}}
        <section class="sit-section sit-section--muted" id="sit-schedules" aria-labelledby="sit-schedules-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Academic calendar</p>
                    <h2 id="sit-schedules-heading" class="sit-section__title">Deployment schedules</h2>
                    <p class="sit-section__lede">
                        Required SIT placements by college and program. Always confirm exact reporting dates with your
                        program adviser and the SIT Office before deployment.
                    </p>
                </header>

                <div class="sit-schedule-grid">
                    @foreach ($schedules as $block)
                        <article class="sit-schedule-card">
                            <h3 class="sit-schedule-card__title">{{ $block['title'] }}</h3>
                            @if ($block['note'])
                                <p class="sit-schedule-card__note">{{ $block['note'] }}</p>
                            @endif
                            <div class="sit-table-wrap">
                                <table class="sit-table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Year level</th>
                                            <th scope="col">Course</th>
                                            <th scope="col">Term</th>
                                            <th scope="col">Duration</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($block['rows'] as $row)
                                            <tr>
                                                <td>{{ $row['year'] }}</td>
                                                <td>{{ $row['course'] }}</td>
                                                <td>{{ $row['term'] }}</td>
                                                <td>{{ $row['duration'] }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Process for students --}}
        <section class="sit-section" aria-labelledby="sit-students-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">For students</p>
                    <h2 id="sit-students-heading" class="sit-section__title">How deployment typically works</h2>
                    <p class="sit-section__lede">
                        Process aligned with common Philippine SUC / technology-campus practice. Your college may issue
                        additional forms and deadlines.
                    </p>
                </header>

                <ol class="sit-steps">
                    <li>
                        <strong>Orientation &amp; briefing</strong>
                        <span>Attend the campus SIT orientation covering requirements, safety, and grading.</span>
                    </li>
                    <li>
                        <strong>Clearance &amp; requirements</strong>
                        <span>Complete prerequisites (academic standing, medical/fitness forms as required, insurance,
                            parental consent if applicable).</span>
                    </li>
                    <li>
                        <strong>Host company endorsement</strong>
                        <span>Secure a training slot through the SIT Office / program coordinator, or nominate a company
                            for evaluation and MOA / endorsement.</span>
                    </li>
                    <li>
                        <strong>Deployment</strong>
                        <span>Report to the host industry with endorsed documents and training plan.</span>
                    </li>
                    <li>
                        <strong>Monitoring &amp; evaluation</strong>
                        <span>Submit journals/reports as required; industry supervisor and faculty evaluate performance.</span>
                    </li>
                    <li>
                        <strong>Completion</strong>
                        <span>Submit completion papers, evaluations, and required documentation for grade encoding.</span>
                    </li>
                </ol>

                <div class="sit-callout">
                    <h3 class="sit-callout__title">Documents students commonly prepare</h3>
                    <ul>
                        <li>Application / biodata and endorsement request</li>
                        <li>Training plan / learning agreement with host supervisor</li>
                        <li>Daily or weekly accomplishment journal</li>
                        <li>Attendance / time record signed by the host</li>
                        <li>Industry evaluation and faculty evaluation forms</li>
                        <li>Certificate of completion from the host company</li>
                    </ul>
                </div>
            </div>
        </section>

        {{-- For partners --}}
        <section class="sit-section sit-section--muted" aria-labelledby="sit-host-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">For industry</p>
                    <h2 id="sit-host-heading" class="sit-section__title">Partner with TUP Visayas</h2>
                </header>
                <p class="sit-prose">
                    Host companies help train the next generation of Filipino technologists while identifying future
                    talent. Partners typically provide a workplace supervisor, a safe training environment, and an
                    evaluation of the trainee’s performance.
                </p>
                <ul class="sit-check-list">
                    <li>Align training tasks with the student’s program outcomes</li>
                    <li>Designate a plant / office mentor for day-to-day guidance</li>
                    <li>Observe campus and company safety / HR requirements</li>
                    <li>Coordinate schedule changes with the SIT Officer</li>
                </ul>
                <p class="sit-prose sit-prose--tight">
                    To become a host training establishment, email
                    <a href="mailto:tupv.sit@tup.edu.ph">tupv.sit@tup.edu.ph</a>
                    or call <a href="tel:+63344452177">(34) 445-2177</a>.
                </p>
            </div>
        </section>

        {{-- Industry partners --}}
        <section class="sit-section" id="sit-partners" aria-labelledby="sit-partners-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Linkages</p>
                    <h2 id="sit-partners-heading" class="sit-section__title">Industry partners</h2>
                    <p class="sit-section__lede">
                        Host training establishments and industry linkages that support Supervised Industrial Training
                        at TUP Visayas.
                    </p>
                </header>

                @if ($partners->isNotEmpty())
                    <ul class="sit-partner-grid">
                        @foreach ($partners as $partner)
                            <li class="sit-partner-card">
                                @if ($partner->website_url)
                                    <a class="sit-partner-card__link" href="{{ $partner->website_url }}" target="_blank"
                                        rel="noopener noreferrer">
                                        @include('pages.partials.sit-partner-mark', ['partner' => $partner])
                                        <span class="sit-partner-card__name">{{ $partner->name }}</span>
                                    </a>
                                @else
                                    @include('pages.partials.sit-partner-mark', ['partner' => $partner])
                                    <span class="sit-partner-card__name">{{ $partner->name }}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p class="sit-empty">
                        Industry partners will appear here once published by the External Affairs / SIT Office.
                    </p>
                @endif
            </div>
        </section>

        {{-- Student experiences gallery --}}
        <section class="sit-section sit-section--muted" id="sit-gallery" aria-labelledby="sit-gallery-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Campus life</p>
                    <h2 id="sit-gallery-heading" class="sit-section__title">Student experiences</h2>
                    <p class="sit-section__lede">
                        Moments from plant immersion, mentor coaching, and training activities across partner
                        industries.
                    </p>
                </header>

                @if ($galleryImages->isNotEmpty())
                    <div class="sit-gallery">
                        @foreach ($galleryImages as $image)
                            <figure class="sit-gallery__item">
                                <div class="sit-gallery__frame sit-gallery__frame--photo">
                                    <img src="{{ asset('storage/' . $image->image_path) }}"
                                        alt="{{ $image->caption ?: 'SIT student experience' }}" loading="lazy">
                                </div>
                                @if ($image->caption)
                                    <figcaption>{{ $image->caption }}</figcaption>
                                @endif
                            </figure>
                        @endforeach
                    </div>
                @else
                    <p class="sit-empty">
                        Student experience photos will appear here after they are approved and uploaded by the SIT
                        Office.
                    </p>
                @endif
            </div>
        </section>

        {{-- Contact --}}
        <section class="sit-section" id="sit-contact" aria-labelledby="sit-contact-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Office</p>
                    <h2 id="sit-contact-heading" class="sit-section__title">SIT Officer</h2>
                </header>

                <article class="sit-contact-card">
                    @if ($sitOfficer?->photo)
                        <figure class="sit-contact-card__photo">
                            <img src="{{ asset('storage/' . $sitOfficer->photo) }}"
                                alt="{{ $sitOfficer->name }}" loading="lazy">
                        </figure>
                    @endif
                    <div class="sit-contact-card__body">
                        <p class="sit-contact-card__role">Administrative Officer V</p>
                        <h3 class="sit-contact-card__name">
                            {{ $sitOfficer?->name ?: 'Rutchel E. Pabalinas, MM' }}
                        </h3>
                        <p class="sit-contact-card__title">
                            {{ $sitOfficer?->position ?: 'Head, External Affairs, Linkages and Consortia / SIT Officer' }}
                        </p>
                        <dl class="sit-contact-card__meta">
                            <div>
                                <dt>Phone</dt>
                                <dd><a href="tel:+63344452177">(34) 445-2177</a></dd>
                            </div>
                            <div>
                                <dt>Email</dt>
                                <dd><a href="mailto:tupv.sit@tup.edu.ph">tupv.sit@tup.edu.ph</a></dd>
                            </div>
                        </dl>
                    </div>
                    <div class="sit-contact-card__actions">
                        <a class="acad-btn acad-btn--primary" href="mailto:tupv.sit@tup.edu.ph">Email the SIT Office</a>
                        <a class="acad-btn acad-btn--ghost" href="{{ route('contact') }}">Campus contact page</a>
                    </div>
                </article>
            </div>
        </section>

        {{-- CTA --}}
        <section class="acad-cta" aria-labelledby="sit-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="sit-cta-heading" class="acad-cta__title">Ready for industry immersion?</h2>
                <p class="acad-cta__lede">
                    Review your program’s SIT schedule, prepare your documents early, and coordinate with the SIT
                    Office before the summer or term deployment window.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="#sit-schedules">View schedules</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('academics') }}">Browse Academics</a>
                </div>
            </div>
        </section>
    </div>
@endsection
