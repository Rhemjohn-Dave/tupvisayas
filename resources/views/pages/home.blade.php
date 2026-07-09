@extends('layouts.app')

<<<<<<< HEAD
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



        {{-- Latest updates --}}
        <section class="home-section" aria-labelledby="updates-heading">
            <h2 id="updates-heading" class="home-section__title">Latest updates</h2>
            <div class="home-updates">
                @foreach ($latestUpdates as $item)
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
                @endforeach
            </div>
            <a class="home-link-all" href="{{ route('news_events') }}">View all news &amp; events</a>
        </section>

        {{-- Jobs --}}
        <section class="home-section" aria-labelledby="jobs-heading">
            <h2 id="jobs-heading" class="home-section__title">Career opportunities</h2>
            <div class="home-jobs">
                @foreach ($jobs as $item)
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
                @endforeach
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
=======
@section('content')
    <!-- Materialize Carousel -->
    <div class="section" style="padding-top:2rem;">
        @if($carouselImages->count())
            <div class="carousel carousel-slider" id="homepageCarousel">
                @foreach($carouselImages as $img)
                    <a class="carousel-item" href="#carousel-{{ $img->id }}">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Carousel Image"
                            style="max-height:1080px;width:100%;object-fit:cover;">
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Latest Updates Carousel -->
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h4 style="font-weight:600; color:#C41E3A; text-align:center;">Latest Updates</h4>
        <div style="position:relative;">
            <a class="btn-floating btn-large red white-text" id="updates-prev"
                style="position:absolute;left:-30px;top:40%;z-index:2;"><i class="material-icons">chevron_left</i></a>
            <div class="carousel" id="updatesCarousel">
                @foreach($latestUpdates as $item)
                        <a class="carousel-item"
                            href="{{
                    $item->type === 'News' ? route('news.show', $item->slug) :
                    ($item->type === 'Event' ? route('events.show', $item->slug) :
                        route('announcements.show', $item->slug))
                                                                                                                                                                                                                                                                                }}"
                            style="width:350px;">
                            <div class="card hoverable" style="overflow:hidden;position:relative;">
                                <!-- Category Label -->
                                <span
                                    style="position:absolute;top:12px;left:12px;background:#f5f5f5;color:#C41E3A;font-weight:600;font-size:0.95rem;padding:3px 12px;border-radius:12px;z-index:2;box-shadow:0 1px 4px rgba(0,0,0,0.04);letter-spacing:0.5px;">
                                    {{ $item->type }}
                                </span>
                                @if($item->picture)
                                    <div class="card-image">
                                        <img src="{{ asset('storage/' . $item->picture) }}" alt="{{ $item->type }} Image"
                                            style="height:160px;object-fit:cover;">
                                    </div>
                                @endif
                                <div class="card-content" style="min-height:120px;">
                                    <span style="font-weight:600;font-size:1.1rem;">{{ $item->title }}</span>
                                    <div style="font-size:0.95rem;color:#888;margin-bottom:4px;">
                                        {{ $item->created_at->format('M d, Y') }}
                                    </div>
                                    <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 80) }}</p>
                                </div>
                                <div class="card-action">
                                    <span class="red-text">Read More</span>
                                </div>
                            </div>
                        </a>
                @endforeach
            </div>
            <a class="btn-floating btn-large red white-text" id="updates-next"
                style="position:absolute;right:-30px;top:40%;z-index:2;"><i class="material-icons">chevron_right</i></a>
        </div>
    </div>

    <!-- Job Postings Preview -->
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h5 style="font-weight:600; color:#C41E3A;">Job Postings</h5>
        <div class="row">
            @foreach($jobs as $item)
                <div class="col s12 m4">
                    <div class="card small hoverable">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Job Image"
                                    style="height:120px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="font-size:1.1rem;">{{ $item->title }}</span>
                            <p>{{ \Illuminate\Support\Str::limit($item->content, 80) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="red-text">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <a href="{{ route('jobs') }}" class="btn-flat red-text">View All Job Postings</a>
    </div>

    <!-- Executive Officials Section (Retained) -->
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h5 style="color:#C41E3A; font-weight:600;">TUP - Visayas Campus Executive Officials</h5>
        <div style="border-top:3px solid #C41E3A; width:60px; margin-bottom:1.2rem;"></div>
        <div class="row">
            @foreach($officials_preview as $official)
                <div class="col s12 m4">
                    <div class="official-card" style="margin-bottom:2rem; text-align:center;">
                        <img src="{{ $official->photo ? asset('storage/' . $official->photo) : 'https://via.placeholder.com/200x200' }}"
                            alt="{{ $official->name }}" class="responsive-img"
                            style="width:300px; height:300px; object-fit:cover; display:block; margin:0 auto 0.5rem auto; border-radius:8px;">
                        <span style="font-weight:700;">{{ $official->name }}</span><br>
                        <span style="font-size:0.95rem;">{{ $official->position }}</span><br>
                        <a href="{{ route('officials.show', $official->id) }}" class="red-text text-darken-2"
                            style="font-size:0.95rem;">View Full Profile</a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="center-align">
            <a href="{{ route('officials') }}" class="btn red white-text">View All Officials</a>
        </div>
    </div>

    <!-- TUP Campuses in the Philippines (Retained) -->
    <div class="section">
        <h4 style="color:#C41E3A;">TUP Campuses in the Philippines</h4>
        <div class="row center-align">
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-manila.png') }}" alt="TUP Manila"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Manila</h6>
                        <p style="margin:0; font-size:0.95rem;">Manila Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-cavite.png') }}" alt="TUP Cavite"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Cavite</h6>
                        <p style="margin:0; font-size:0.95rem;">Cavite Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-taguig.png') }}" alt="TUP Taguig"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Taguig</h6>
                        <p style="margin:0; font-size:0.95rem;">Taguig Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-visayas.png') }}" alt="TUP Visayas"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Visayas</h6>
                        <p style="margin:0; font-size:0.95rem;">Visayas Campus</p>
                    </div>
                </div>
            </div>
        </div>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    </div>
@endsection

@section('scripts')
<<<<<<< HEAD
    <script src="{{ asset('js/site-home.js?v=' . time()) }}" defer></script>
@endsection
=======
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.carousel.carousel-slider');
            var instances = M.Carousel.init(elems, { fullWidth: true, indicators: true });
            // Auto-scroll every 4 seconds
            if (instances.length > 0) {
                setInterval(function () {
                    instances[0].next();
                }, 4000);
            }

            // Latest Updates carousel (not fullWidth)
            var updatesElem = document.getElementById('updatesCarousel');
            var updatesInstance = M.Carousel.init(updatesElem, { dist: 0, shift: 0, padding: 20, indicators: true });
            document.getElementById('updates-prev').onclick = function () {
                updatesInstance.prev();
            };
            document.getElementById('updates-next').onclick = function () {
                updatesInstance.next();
            };
        });
    </script>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
