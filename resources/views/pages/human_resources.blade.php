@extends('layouts.app')

@section('title', 'Human Resources - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Human Resources at TUP Visayas — job openings, HR announcements, and seminars, conferences, trainings, and oath-taking programs.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Human Resources - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--hr">
        <section class="acad-hero" aria-labelledby="hr-hero-heading">
            <p class="acad-hero__badge">Administration</p>
            <h1 id="hr-hero-heading" class="acad-hero__title">Human Resources</h1>
            <p class="acad-hero__lede">
                Faculty and staff employment at TUP Visayas — job openings, HR announcements, and seminars,
                conferences, trainings, and oath-taking programs conducted by campus departments.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#hr-openings">Job openings</a>
                <a class="acad-btn acad-btn--ghost" href="#hr-announcements">Announcements</a>
                <a class="acad-btn acad-btn--ghost" href="#hr-programs">Programs</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('contact') }}">Contact campus</a>
            </div>
        </section>

        <section class="sit-section" aria-labelledby="hr-about-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Office</p>
                    <h2 id="hr-about-heading" class="sit-section__title">Campus Human Resources</h2>
                </header>
                <p class="sit-prose">
                    Human Resources coordinates faculty and staff hiring, appointments, personnel notices, and
                    related campus development activities for TUP Visayas.
                </p>
                <ul class="sit-check-list" aria-label="HR services">
                    <li>Publish faculty and staff job openings</li>
                    <li>Share HR announcements for campus personnel</li>
                    <li>Publish department seminars, conferences, trainings, and oath-taking reports</li>
                    <li>Support appointment and personnel transactions</li>
                </ul>
                <p class="sit-prose sit-prose--tight">
                    Student internships, OJT, and industry placements are handled separately by the
                    <a href="{{ route('sit') }}#sit-recruitment">SIT Office</a>.
                </p>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="hr-announcements" aria-labelledby="hr-announcements-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Notices</p>
                    <h2 id="hr-announcements-heading" class="sit-section__title">HR announcements</h2>
                    <p class="sit-section__lede">
                        Official notices from Human Resources for faculty and staff.
                    </p>
                </header>

                @if ($announcements->isEmpty())
                    <p class="sit-prose">No HR announcements posted yet. Check back soon.</p>
                @else
                    <div class="office-job-grid">
                        @foreach ($announcements as $item)
                            <article class="office-job-card">
                                @if ($item->featured_image)
                                    <figure class="office-job-card__media">
                                        <img src="{{ asset('storage/' . $item->featured_image) }}" alt=""
                                            loading="lazy">
                                    </figure>
                                @endif
                                <div class="office-job-card__body">
                                    <p class="office-job-card__badge">Announcement</p>
                                    <h3 class="office-job-card__title">{{ $item->title }}</h3>
                                    <p class="office-job-card__excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->excerpt ?: $item->content), 140) }}
                                    </p>
                                    <p class="hr-post-card__meta">
                                        <time datetime="{{ ($item->published_at ?? $item->created_at)->toDateString() }}">
                                            {{ ($item->published_at ?? $item->created_at)->format('M j, Y') }}
                                        </time>
                                    </p>
                                    <a class="acad-btn acad-btn--ghost"
                                        href="{{ route('human-resources.post.show', $item->slug) }}">Read more</a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="sit-section" id="hr-programs" aria-labelledby="hr-programs-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">COA Sec. 13</p>
                    <h2 id="hr-programs-heading" class="sit-section__title">
                        Seminars, conferences, trainings &amp; oath-taking
                    </h2>
                    <p class="sit-section__lede">
                        Programs conducted by campus departments, with posted reports where available.
                    </p>
                </header>

                @if ($programs->isEmpty())
                    <p class="sit-prose">No programs posted yet. Check back soon.</p>
                @else
                    <div class="office-job-grid">
                        @foreach ($programs as $item)
                            <article class="office-job-card">
                                @if ($item->featured_image)
                                    <figure class="office-job-card__media">
                                        <img src="{{ asset('storage/' . $item->featured_image) }}" alt=""
                                            loading="lazy">
                                    </figure>
                                @endif
                                <div class="office-job-card__body">
                                    <p class="office-job-card__badge">{{ $item->type_label }}</p>
                                    <h3 class="office-job-card__title">{{ $item->title }}</h3>
                                    <p class="office-job-card__excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($item->excerpt ?: $item->content), 140) }}
                                    </p>
                                    <p class="hr-post-card__meta">
                                        @if ($item->department)
                                            <span>{{ $item->department->name }}</span>
                                            @if ($item->event_date)
                                                <span aria-hidden="true"> · </span>
                                            @endif
                                        @endif
                                        @if ($item->event_date)
                                            <time datetime="{{ $item->event_date->toDateString() }}">
                                                {{ $item->event_date->format('M j, Y') }}
                                            </time>
                                        @endif
                                    </p>
                                    <div class="hr-post-card__actions">
                                        @if ($item->report_file)
                                            <a class="acad-btn acad-btn--primary"
                                                href="{{ asset('storage/' . $item->report_file) }}"
                                                target="_blank" rel="noopener noreferrer">Download report</a>
                                        @endif
                                        <a class="acad-btn acad-btn--ghost"
                                            href="{{ route('human-resources.post.show', $item->slug) }}">Read more</a>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="hr-openings" aria-labelledby="hr-openings-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Vacancies</p>
                    <h2 id="hr-openings-heading" class="sit-section__title">Job openings</h2>
                    <p class="sit-section__lede">
                        Current faculty and staff vacancies. Read the full posting for qualifications and how to apply.
                    </p>
                </header>

                @include('pages.partials.job_cards', [
                    'jobs' => $jobs,
                    'empty' => 'No HR job openings posted yet. Check back soon or contact the campus through the contact page.',
                ])
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="hr-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="hr-cta-heading" class="acad-cta__title">Apply to join TUP Visayas</h2>
                <p class="acad-cta__lede">
                    Submit requirements indicated in the posting, or reach the campus for Human Resources inquiries.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('contact') }}">Contact us</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('sit') }}">SIT / student placements</a>
                </div>
            </div>
        </section>
    </div>
@endsection
