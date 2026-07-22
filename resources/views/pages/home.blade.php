@extends('layouts.app')

@section('main_class', 'site-main--full')

@section('content')
    <div class="site-page site-page--home">
        {{-- Carousel --}}
        <section class="home-carousel" data-home-hero aria-label="Campus photos">
            @if ($carouselImages->count())
                <div class="home-carousel__slides">
                    @foreach ($carouselImages as $idx => $img)
                        <div class="home-carousel__slide {{ $idx === 0 ? 'is-active' : '' }}" data-home-hero-slide>
                            <img src="{{ asset('storage/' . $img->image_path) }}"
                                alt="{{ $img->caption ?: 'TUP Visayas' }}"
                                @if ($idx > 0) loading="lazy" @endif>
                        </div>
                    @endforeach
                </div>
                @if ($carouselImages->count() > 1)
                    <button type="button" class="home-carousel__arrow home-carousel__arrow--prev" data-home-hero-prev
                        aria-label="Previous slide">&lsaquo;</button>
                    <button type="button" class="home-carousel__arrow home-carousel__arrow--next" data-home-hero-next
                        aria-label="Next slide">&rsaquo;</button>
                    <div class="home-carousel__dots" role="tablist" aria-label="Slide indicators">
                        @foreach ($carouselImages as $idx => $img)
                            <button type="button" class="home-carousel__dot" data-home-hero-dot
                                aria-label="Slide {{ $idx + 1 }}"
                                aria-current="{{ $idx === 0 ? 'true' : 'false' }}"></button>
                        @endforeach
                    </div>
                @endif
            @else
                <div class="home-carousel__empty" aria-hidden="true"></div>
            @endif
        </section>

        {{-- About --}}
        <section class="home-section home-section--about" aria-labelledby="mission-heading">
            <h2 id="mission-heading" class="home-section__title">About TUP Visayas</h2>
            <div class="home-about">
                <div class="home-about__content">
                    <p class="home-about__text">The Technological University of the Philippines Visayas campus carries out the University&rsquo;s mandate to provide higher and advanced vocational, technical, industrial, technological, and professional education.</p>
                    <p class="home-about__text">We prepare graduates in engineering and allied fields through instruction, research, and extension services aligned with national development goals.</p>
                    <ul class="home-about__links">
                        <li><a href="{{ route('about') }}">About the campus</a></li>
                        <li><a href="{{ route('about.mission') }}">Mission &amp; vision</a></li>
                        <li><a href="{{ route('about.history') }}">TUP history</a></li>
                    </ul>
                </div>
                <figure class="home-about__media">
                    <img src="{{ asset('images/tupvisayas.jpg') }}" alt="TUP Visayas campus" loading="lazy">
                </figure>
            </div>
        </section>

        {{-- Campus highlights (max 3) --}}
        <section class="home-section" aria-labelledby="updates-heading">
            <h2 id="updates-heading" class="home-section__title">Campus highlights</h2>
            <div class="home-updates">
                @forelse ($latestUpdates as $item)
                    @php
                        $href =
                            $item->type === 'News'
                                ? route('news.show', $item->slug)
                                : ($item->type === 'Event'
                                    ? route('events.show', $item->slug)
                                    : route('announcements.show', $item->slug));
                    @endphp
                    <a class="home-card" href="{{ $href }}">
                        <div class="home-card__media">
                            @if ($item->picture)
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            @endif
                            <span class="home-card__badge">{{ $item->type }}</span>
                        </div>
                        <div class="home-card__body">
                            <h3 class="home-card__title">{{ $item->title }}</h3>
                            <div class="home-card__meta">{{ $item->created_at->format('M j, Y') }}</div>
                            <p class="home-card__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                            </p>
                        </div>
                    </a>
                @empty
                    <p class="home-empty">No campus highlights posted yet.</p>
                @endforelse
            </div>
            <a class="home-link-all" href="{{ route('news_events') }}">View all news &amp; events</a>
        </section>

        {{-- Bid opportunities snippet --}}
        <section class="home-section" aria-labelledby="bids-heading">
            <h2 id="bids-heading" class="home-section__title">Bid opportunities</h2>
            <p class="home-section__lede">Recent public bidding notices from TUP Visayas procurement.</p>

            <div class="home-bids" role="list">
                @forelse ($bidOpportunities as $bid)
                    <article class="home-bid" role="listitem">
                        <div class="home-bid__main">
                            <p class="home-bid__ref">{{ $bid->reference_no }}</p>
                            <h3 class="home-bid__title">{{ $bid->title }}</h3>
                            <p class="home-bid__meta">
                                <span>{{ $bid->category }}</span>
                                <span aria-hidden="true">·</span>
                                <span>
                                    @if ($bid->closing_date)
                                        Closes {{ \Carbon\Carbon::parse($bid->closing_date)->format('M j, Y') }}
                                    @else
                                        Posted {{ \Carbon\Carbon::parse($bid->posting_date)->format('M j, Y') }}
                                    @endif
                                </span>
                            </p>
                        </div>
                        <div class="home-bid__aside">
                            @if ($bid->status === 'awarded')
                                <span class="home-bid__status home-bid__status--awarded">Awarded</span>
                            @else
                                <span class="home-bid__status home-bid__status--pending">Pending</span>
                            @endif
                        </div>
                    </article>
                @empty
                    <p class="home-empty">No bid opportunities posted yet.</p>
                @endforelse
            </div>
            <a class="home-link-all" href="{{ route('procurement.bid') }}">View all bid opportunities</a>
        </section>

        {{-- Jobs --}}
        <section class="home-section" aria-labelledby="jobs-heading">
            <h2 id="jobs-heading" class="home-section__title">Career opportunities</h2>
            <div class="home-jobs">
                @forelse ($jobs as $item)
                    <article class="home-job-card">
                        @if ($item->picture)
                            <div class="home-job-card__img">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            </div>
                        @endif
                        <div class="home-job-card__body">
                            <h3 class="home-job-card__title">{{ $item->title }}</h3>
                            <p class="home-job-card__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 100) }}
                            </p>
                        </div>
                        <div class="home-job-card__action">
                            <a href="{{ route('jobs.show', $item->slug) }}">Read more</a>
                        </div>
                    </article>
                @empty
                    <p class="home-empty">No job postings at this time.</p>
                @endforelse
            </div>
            <a class="home-link-all" href="{{ route('jobs') }}">View all job postings</a>
        </section>

        {{-- Officials --}}
        <section class="home-section" aria-labelledby="officials-heading">
            <h2 id="officials-heading" class="home-section__title">Campus officials</h2>
            <div class="home-officials">
                @foreach ($officials_preview as $official)
                    @php
                        $parts = collect(preg_split('/\s+/', trim($official->name)))->filter();
                        $initials = $parts->take(2)->map(fn($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                    @endphp
                    <article class="home-official">
                        @if ($official->photo)
                            <img class="home-official__photo" src="{{ asset('storage/' . $official->photo) }}"
                                alt="{{ $official->name }}">
                        @else
                            <div class="home-official__avatar" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                        @endif
                        <span class="home-official__name">{{ $official->name }}</span>
                        <span class="home-official__role">{{ $official->position }}</span>
                    </article>
                @endforeach
            </div>
            <div class="home-officials__footer">
                <a class="site-cta" href="{{ route('officials') }}">View all officials</a>
            </div>
        </section>

        {{-- TUP campuses --}}
        <section class="home-section" aria-labelledby="campuses-heading">
            <h2 id="campuses-heading" class="home-section__title">TUP campuses</h2>
            <div class="home-campuses">
                <article class="home-campus">
                    <img src="{{ asset('images/tup-manila.png') }}" alt="TUP Manila campus building">
                    <div class="home-campus__body">
                        <h3>TUP Manila</h3>
                        <p>Main campus</p>
                    </div>
                </article>
                <article class="home-campus">
                    <img src="{{ asset('images/tup-cavite.png') }}" alt="TUP Cavite campus">
                    <div class="home-campus__body">
                        <h3>TUP Cavite</h3>
                        <p>Cavite campus</p>
                    </div>
                </article>
                <article class="home-campus">
                    <img src="{{ asset('images/tup-taguig.png') }}" alt="TUP Taguig campus">
                    <div class="home-campus__body">
                        <h3>TUP Taguig</h3>
                        <p>Taguig campus</p>
                    </div>
                </article>
                <article class="home-campus">
                    <img src="{{ asset('images/tup-visayas.png') }}" alt="TUP Visayas campus">
                    <div class="home-campus__body">
                        <h3>TUP Visayas</h3>
                        <p>Visayas campus</p>
                    </div>
                </article>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('js/site-home.js?v=' . time()) }}" defer></script>
@endsection
