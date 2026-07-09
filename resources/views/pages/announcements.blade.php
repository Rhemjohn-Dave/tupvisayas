<<<<<<< HEAD
@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--news">
        <h1 class="site-page-title site-page-title--center">
            {{ $category ? $category->name : 'University announcements' }}
        </h1>
        <p class="site-page-intro">
            @if ($category)
                Announcements in the {{ $category->name }} category.
            @else
                Official announcements from TUP Visayas.
            @endif
        </p>

        <div class="news-layout">
            <main class="news-main">
                @forelse ($announcements as $item)
                    <a class="news-item{{ $item->picture ? '' : ' news-item--no-media' }}"
                        href="{{ route('announcements.show', $item->slug) }}">
                        @if ($item->picture)
                            <div class="news-item__media">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy">
                            </div>
                        @endif
                        <div class="news-item__body">
                            <div class="news-item__meta">
                                <span class="news-item__badge">Announcement</span>
                                <time datetime="{{ $item->created_at->toDateString() }}">{{ $item->created_at->format('M j, Y') }}</time>
                                @if ($item->category)
                                    <span>{{ $item->category->name }}</span>
                                @endif
                            </div>
                            <h2 class="news-item__title">{{ $item->title }}</h2>
                            <p class="news-item__excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 160) }}</p>
                            <span class="news-item__link">Read more</span>
                        </div>
                    </a>
                @empty
                    <p class="news-empty">No announcements found{{ !empty($search) ? ' for your search' : '' }}.</p>
                @endforelse
            </main>

            @include('pages.partials.announcements_sidebar', [
                'categories' => $categories,
                'activeCategory' => $category,
                'search' => $search ?? '',
            ])
        </div>
    </div>
@endsection
=======
@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h2 style="color:#C41E3A;font-weight:800;text-align:left;margin-bottom:2rem;letter-spacing:1px;">
            {{ $category ? $category->name : 'University Announcements' }}
        </h2>
        <div class="row">
            <!-- Main Announcements Content -->
            <div class="col s12 m9">
                @if($announcements->count() > 0)
                    @foreach($announcements as $item)
                        <div class="card" style="margin-bottom: 2rem;">
                            @if($item->picture)
                                <div class="card-image">
                                    <img src="{{ asset('storage/' . $item->picture) }}" alt="Announcement Image"
                                        style="max-height:200px;object-fit:cover;cursor:pointer;" onclick="openModal(this)">
                                </div>
                            @endif
                            <div class="card-content">
                                <span class="card-title" style="color:#C41E3A;font-weight:700;">{{ $item->title }}</span>
                                <div style="color:#888;font-size:0.95rem;margin-bottom:0.5rem;">
                                    <span>{{ $item->created_at->format('M d, Y') }}</span>
                                    @if($item->category)
                                        <span style="margin-left:10px;">• {{ $item->category->name }}</span>
                                    @endif
                                </div>
                                <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 200) }}</p>
                            </div>
                            <div class="card-action">
                                <a href="{{ route('announcements.show', $item->slug) }}"
                                    class="btn-flat red-text text-darken-2">Read More</a>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="card" style="margin-bottom: 2rem;">
                        <div class="card-content">
                            <span class="card-title" style="color:#C41E3A;font-weight:700;">No Announcements Found</span>
                            <p>There are no announcements available at the moment. Please check back later.</p>
                        </div>
                    </div>
                @endif
            </div>
            <!-- Categories + Search -->
            <div class="col s12 m3">
                <form action="{{ route('announcements.index') }}" method="GET" style="margin-bottom: 1.5rem;">
                    <div class="input-field" style="margin-bottom:0;">
                        <input type="text" name="search" id="search" placeholder="Search announcements..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn red" style="margin-top:8px;">Search</button>
                    </div>
                </form>
                <div>
                    <h6 style="font-weight:700;letter-spacing:1px;">ANNOUNCEMENT CATEGORIES</h6>
                    <ul style="list-style:none;padding-left:0;">
                        <li style="margin-bottom:8px;">
                            <a href="{{ route('announcements.index') }}"
                                style="color:#222;text-decoration:underline;font-weight:{{ request('category') ? 'normal' : 'bold' }};">
                                All Announcements
                            </a>
                        </li>
                        @foreach($categories as $cat)
                            <li style="margin-bottom:8px;">
                                <a href="{{ route('announcements.index', ['category' => $cat->slug]) }}"
                                    style="color:#222;text-decoration:underline;font-weight:{{ request('category') == $cat->slug ? 'bold' : 'normal' }};">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal for full screen image -->
    <div id="imgModal" class="modal"
        style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.9);align-items:center;justify-content:center;">
        <span onclick="closeModal()"
            style="position:absolute;top:30px;right:40px;font-size:40px;color:white;cursor:pointer;z-index:10001;">&times;</span>
        <img id="modalImg" src=""
            style="max-width:90vw;max-height:90vh;display:block;margin:auto;box-shadow:0 0 20px #000;">
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(img) {
            document.getElementById('imgModal').style.display = 'flex';
            document.getElementById('modalImg').src = img.src;
        }
        function closeModal() {
            document.getElementById('imgModal').style.display = 'none';
            document.getElementById('modalImg').src = '';
        }
        // Optional: Close modal when clicking outside the image
        document.addEventListener('DOMContentLoaded', function () {
            var modal = document.getElementById('imgModal');
            modal.addEventListener('click', function (e) {
                if (e.target === modal) closeModal();
            });
        });
    </script>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
