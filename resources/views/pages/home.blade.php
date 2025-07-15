@extends('layouts.app')

@section('content')
    <!-- Materialize Carousel -->
    <div class="section" style="padding-top:2rem;">
        @if($carouselImages->count())
            <div class="carousel carousel-slider" id="homepageCarousel">
                @foreach($carouselImages as $img)
                    <a class="carousel-item" href="#carousel-{{ $img->id }}">
                        <img src="{{ asset('storage/' . $img->image_path) }}" alt="Carousel Image"
                            style="max-height:420px;width:100%;object-fit:cover;">
                    </a>
                @endforeach
            </div>
        @endif
    </div>

    <!-- Previews: News, Events, Announcements -->
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <div class="row">
            <div class="col s12 m4">
                <h5 style="font-weight:600; color:#C41E3A;">Latest News</h5>
                @foreach($news as $item)
                    <div class="card small hoverable">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="News Image"
                                    style="height:120px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="font-size:1.1rem;">{{ $item->title }}</span>
                            <p>{{ \Illuminate\Support\Str::limit($item->content, 80) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('news.show', $item->id) }}" class="red-text">Read More</a>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('news_events') }}" class="btn-flat red-text">View All News & Events</a>
            </div>
            <div class="col s12 m4">
                <h5 style="font-weight:600; color:#C41E3A;">Events</h5>
                @foreach($events as $item)
                    <div class="card small hoverable">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Event Image"
                                    style="height:120px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="font-size:1.1rem;">{{ $item->title }}</span>
                            <p>{{ \Illuminate\Support\Str::limit($item->content, 80) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('events.show', $item->id) }}" class="red-text">Read More</a>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('news_events') }}" class="btn-flat red-text">View All Events</a>
            </div>
            <div class="col s12 m4">
                <h5 style="font-weight:600; color:#C41E3A;">Announcements</h5>
                @foreach($announcements as $item)
                    <div class="card small hoverable">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Announcement Image"
                                    style="height:120px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="font-size:1.1rem;">{{ $item->title }}</span>
                            <p>{{ \Illuminate\Support\Str::limit($item->content, 80) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('announcements.show', $item->id) }}" class="red-text">Read More</a>
                        </div>
                    </div>
                @endforeach
                <a href="{{ route('announcements') }}" class="btn-flat red-text">View All Announcements</a>
            </div>
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
                            <a href="{{ route('jobs.show', $item->id) }}" class="red-text">Read More</a>
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
                            style="width:140px; height:140px; object-fit:cover; display:block; margin:0 auto 0.5rem auto;">
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
    </div>
@endsection

@section('scripts')
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
        });
    </script>
@endsection