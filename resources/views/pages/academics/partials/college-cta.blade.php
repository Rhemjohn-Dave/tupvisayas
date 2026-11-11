@php
    $collegeSlug = $collegePage->routeSlug();
    $ctaLines = [
        'coac' => 'Ready to lead the future of industry?',
        'coe' => 'Ready to engineer solutions that matter?',
        'coet' => 'Ready to build with technology?',
        'basd' => 'Ready to join TUP Visayas?',
    ];
    $ctaTitle = $ctaLines[$collegeSlug] ?? 'Ready to join TUP Visayas?';
@endphp

<section class="college-cta" aria-labelledby="college-cta-heading">
    <div class="college-cta__inner">
        <h2 id="college-cta-heading" class="college-cta__title">{{ $ctaTitle }}</h2>
        <p class="college-cta__lede">
            Join the next cohort of TUP Visayas engineers and technologists. Freshmen admissions through TUPSTAT are
            open for the coming academic year.
        </p>
        <div class="college-cta__actions">
            <a class="college-btn college-btn--gold" href="{{ route('admissions.enrollment') }}">Start Your Application</a>
            <a class="college-btn college-btn--ghost-light"
                href="{{ route('academics.undergraduate') }}">Browse All Programs</a>
        </div>
    </div>
</section>
