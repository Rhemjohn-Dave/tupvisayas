@extends('layouts.app')

@section('main_class', 'site-main--full')

@section('content')
    @php
        $featuredUpdate = $latestUpdates->first();
        $featuredJob = $jobs->first();
    @endphp

    <div class="site-page site-page--home">
        {{-- Hero carousel; TUPSTAT promo controlled in Admin → Admission schedules --}}
        <section class="home-hero {{ $showTupstatHero ? '' : 'home-hero--cta-only' }}" data-home-hero
            aria-label="{{ $showTupstatHero ? 'TUP Visayas admissions' : 'TUP Visayas campus' }}">
            @unless ($showTupstatHero)
                <h1 class="visually-hidden">TUP Visayas — Technological University of the Philippines Visayas</h1>
            @endunless
            <div class="home-hero__media">
                @if ($carouselImages->count())
                    <div class="home-hero__slides">
                        @foreach ($carouselImages as $idx => $img)
                            <div class="home-hero__slide {{ $idx === 0 ? 'is-active' : '' }}" data-home-hero-slide>
                                <img src="{{ asset('storage/' . $img->image_path) }}"
                                    alt="{{ $img->caption ?: 'TUP Visayas campus' }}"
                                    @if ($idx > 0) loading="lazy" @endif>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="home-hero__fallback" aria-hidden="true"></div>
                @endif
                <div class="home-hero__shade" aria-hidden="true"></div>
            </div>

            @if ($showTupstatHero)
                <div class="home-hero__content">
                    <p class="home-hero__badge">Admissions S.Y. {{ date('Y') }}–{{ date('Y') + 1 }}</p>
                    <h1 class="home-hero__title">TUPSTAT Admission Test</h1>
                    <p class="home-hero__lede">
                        Online application is now open. Join the premier technological university in the region and build
                        your future in engineering and technology.
                    </p>
                    <div class="home-hero__actions">
                        <a class="home-hero__cta home-hero__cta--primary"
                            href="{{ route('admissions.enrollment') }}">Apply Now</a>
                        <a class="home-hero__cta home-hero__cta--ghost" href="{{ route('campus.tour') }}">Campus Tour</a>
                    </div>
                </div>
            @else
                <div class="home-hero__actions">
                    <a class="home-hero__cta home-hero__cta--primary"
                        href="{{ route('admissions.enrollment') }}">Apply Now</a>
                    <a class="home-hero__cta home-hero__cta--ghost" href="{{ route('campus.tour') }}">Campus Tour</a>
                </div>
            @endif

            @if ($carouselImages->count() > 1)
                <button type="button" class="home-hero__arrow home-hero__arrow--prev" data-home-hero-prev
                    aria-label="Previous slide">&lsaquo;</button>
                <button type="button" class="home-hero__arrow home-hero__arrow--next" data-home-hero-next
                    aria-label="Next slide">&rsaquo;</button>
                <div class="home-hero__dots" role="tablist" aria-label="Slide indicators">
                    @foreach ($carouselImages as $idx => $img)
                        <button type="button" class="home-hero__dot" data-home-hero-dot
                            aria-label="Slide {{ $idx + 1 }}"
                            aria-current="{{ $idx === 0 ? 'true' : 'false' }}"></button>
                    @endforeach
                </div>
            @endif
        </section>

        {{-- About --}}
        <section class="home-section home-section--about" aria-labelledby="about-heading">
            <div class="home-about">
                <div class="home-about__content">
                    <p class="home-eyebrow">Our campus</p>
                    <h2 id="about-heading" class="home-about__title">About TUP Visayas</h2>
                    <p class="home-about__text">
                        The Technological University of the Philippines Visayas campus carries out the University&rsquo;s
                        mandate to provide higher and advanced vocational, technical, industrial, technological, and
                        professional education. We prepare graduates in engineering and allied fields through instruction,
                        research, and extension services aligned with national and regional development goals.
                    </p>
                    <ul class="home-about__links">
                        <li>
                            <a href="{{ route('about.history') }}">
                                <span class="home-about__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M4 19V5h11v14M15 8h5v11H9" />
                                        <path d="M8 9h4M8 12h4M8 15h3" />
                                    </svg>
                                </span>
                                History
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about.mission') }}">
                                <span class="home-about__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <circle cx="12" cy="12" r="8" />
                                        <circle cx="12" cy="12" r="3" />
                                        <path d="M12 4v2M12 18v2M4 12h2M18 12h2" />
                                    </svg>
                                </span>
                                Mission
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('about.values') }}">
                                <span class="home-about__icon" aria-hidden="true">
                                    <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M12 3l2.2 6.6H21l-5.4 4 2.1 6.4L12 16.8 6.3 20l2.1-6.4L3 9.6h6.8L12 3z" />
                                    </svg>
                                </span>
                                Values
                            </a>
                        </li>
                    </ul>
                </div>
                <figure class="home-about__media">
                    <img src="{{ asset('images/tupvisayas.jpg') }}" alt="TUP Visayas administration building"
                        loading="lazy">
                </figure>
            </div>
        </section>

        {{-- Campus highlights: featured news + bids/careers sidebar --}}
        <section class="home-section" aria-labelledby="updates-heading">
            <div class="home-section__head">
                <div>
                    <p class="home-eyebrow">Updates</p>
                    <h2 id="updates-heading" class="home-section__title">Campus Highlights</h2>
                </div>
                <a class="home-link-all" href="{{ route('news_events') }}">View all news</a>
            </div>

            <div class="home-highlights">
                @if ($featuredUpdate)
                    @php
                        $featuredHref =
                            $featuredUpdate->type === 'News'
                                ? route('news.show', $featuredUpdate->slug)
                                : ($featuredUpdate->type === 'Event'
                                    ? route('events.show', $featuredUpdate->slug)
                                    : route('announcements.show', $featuredUpdate->slug));
                    @endphp
                    <a class="home-highlight-feature" href="{{ $featuredHref }}">
                        <div class="home-highlight-feature__media">
                            @if ($featuredUpdate->picture)
                                <img src="{{ asset('storage/' . $featuredUpdate->picture) }}" alt="" loading="lazy">
                            @endif
                            <div class="home-highlight-feature__shade"></div>
                            <div class="home-highlight-feature__copy">
                                <span class="home-highlight-feature__badge">{{ $featuredUpdate->type }}</span>
                                <h3 class="home-highlight-feature__title">{{ $featuredUpdate->title }}</h3>
                                <p class="home-highlight-feature__meta">
                                    {{ $featuredUpdate->created_at->format('F j, Y') }}
                                </p>
                            </div>
                        </div>
                    </a>
                @else
                    <div class="home-highlight-feature home-highlight-feature--empty">
                        <p class="home-empty">No campus highlights posted yet.</p>
                    </div>
                @endif

                <aside class="home-highlight-aside" aria-label="Opportunities">
                    <div class="home-aside-panel">
                        <div class="home-aside-panel__head">
                            <h3 class="home-aside-panel__title">Bid Opportunities</h3>
                            <a class="home-link-all" href="{{ route('procurement.bid') }}">View all</a>
                        </div>
                        <div class="home-bids" role="list">
                            @forelse ($bidOpportunities as $bid)
                                <article class="home-bid" role="listitem">
                                    <h4 class="home-bid__title">{{ $bid->title }}</h4>
                                    <p class="home-bid__meta">
                                        @if ($bid->closing_date)
                                            Closes {{ \Carbon\Carbon::parse($bid->closing_date)->format('M j, Y') }}
                                        @else
                                            Posted {{ \Carbon\Carbon::parse($bid->posting_date)->format('M j, Y') }}
                                        @endif
                                    </p>
                                </article>
                            @empty
                                <p class="home-empty">No bid opportunities posted yet.</p>
                            @endforelse
                        </div>
                    </div>

                    <div class="home-aside-career">
                        @if ($featuredJob)
                            <a class="home-career-feature" href="{{ route('jobs.show', $featuredJob->slug) }}">
                                <span class="home-career-feature__label">Human Resources</span>
                                <h3 class="home-career-feature__title">{{ $featuredJob->title }}</h3>
                                <p class="home-career-feature__excerpt">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($featuredJob->content), 90) }}
                                </p>
                                <span class="home-career-feature__cta">Apply for position</span>
                            </a>
                        @else
                            <a class="home-career-feature" href="{{ route('human-resources') }}">
                                <span class="home-career-feature__label">Human Resources</span>
                                <h3 class="home-career-feature__title">Join the TUP Visayas team</h3>
                                <p class="home-career-feature__excerpt">
                                    View open faculty and staff positions on campus.
                                </p>
                                <span class="home-career-feature__cta">View openings</span>
                            </a>
                        @endif
                    </div>
                </aside>
            </div>
        </section>

        {{-- Officials --}}
        <section class="home-section home-section--officials" aria-labelledby="officials-heading">
            <p class="home-eyebrow home-eyebrow--center">Leadership</p>
            <h2 id="officials-heading" class="home-section__title home-section__title--center">Campus Officials</h2>
            <div class="home-officials">
                @foreach ($officials_preview as $official)
                    @php
                        $parts = collect(preg_split('/\s+/', trim($official->name)))->filter();
                        $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                    @endphp
                    <article class="home-official">
                        <div class="home-official__photo-wrap">
                            @if ($official->photo)
                                <img class="home-official__photo" src="{{ asset('storage/' . $official->photo) }}"
                                    alt="{{ $official->name }}" loading="lazy">
                            @else
                                <div class="home-official__avatar" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                            @endif
                        </div>
                        <span class="home-official__name">{{ $official->name }}</span>
                        <span class="home-official__role">{{ $official->position }}</span>
                    </article>
                @endforeach
            </div>
            <div class="home-officials__footer">
                <a class="home-btn" href="{{ route('officials') }}">View all Officials</a>
            </div>
        </section>

        {{-- Campuses --}}
        <section class="home-section" aria-labelledby="campuses-heading">
            <p class="home-eyebrow home-eyebrow--center">System</p>
            <h2 id="campuses-heading" class="home-section__title home-section__title--center">TUP Campuses</h2>
            <div class="home-campuses">
                <article class="home-campus">
                    <img src="{{ asset('images/tup-manila.png') }}" alt="TUP Manila campus building" loading="lazy">
                    <div class="home-campus__body">
                        <h3>TUP Manila</h3>
                        <p>Main campus</p>
                    </div>
                </article>
                <article class="home-campus">
                    <img src="{{ asset('images/tup-cavite.png') }}" alt="TUP Cavite campus" loading="lazy">
                    <div class="home-campus__body">
                        <h3>TUP Cavite</h3>
                        <p>Cavite campus</p>
                    </div>
                </article>
                <article class="home-campus home-campus--current">
                    <span class="home-campus__badge">Current campus</span>
                    <img src="{{ asset('images/tup-visayas.png') }}" alt="TUP Visayas campus" loading="lazy">
                    <div class="home-campus__body">
                        <h3>TUP Visayas</h3>
                        <p>Visayas campus</p>
                    </div>
                </article>
                <article class="home-campus">
                    <img src="{{ asset('images/tup-taguig.png') }}" alt="TUP Taguig campus" loading="lazy">
                    <div class="home-campus__body">
                        <h3>TUP Taguig</h3>
                        <p>Taguig campus</p>
                    </div>
                </article>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/site-home.js?v=' . time()) }}" defer></script>
@endsection
