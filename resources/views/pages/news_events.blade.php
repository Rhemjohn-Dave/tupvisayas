@extends('layouts.app')

@section('content')
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h2 style="color:#C41E3A;font-weight:800;text-align:left;margin-bottom:2rem;letter-spacing:1px;">
            {{ $category ? $category->name : 'University News & Events' }}
        </h2>
        <div class="row">
            <!-- Main News Content -->
            <div class="col s12 m9">
                {{-- Only use Str via fully qualified name --}}
                @foreach($news as $item)
                    <div class="card" style="margin-bottom: 2rem;">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="News Image"
                                    style="max-height:200px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="color:#C41E3A;font-weight:700;">{{ $item->title }}</span>
                            <div style="color:#888;font-size:0.95rem;margin-bottom:0.5rem;">
                                <span>{{ $item->created_at->format('M d, Y') }}</span>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('news.show', $item->id) }}" class="btn-flat red-text text-darken-2">Read More</a>
                        </div>
                    </div>
                @endforeach
                @foreach($announcements as $item)
                    <div class="card" style="margin-bottom: 2rem;">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Announcement Image"
                                    style="max-height:200px;object-fit:cover;">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title" style="color:#388e3c;font-weight:700;">{{ $item->title }}</span>
                            <div style="color:#888;font-size:0.95rem;margin-bottom:0.5rem;">
                                <span>{{ $item->created_at->format('M d, Y') }}</span>
                            </div>
                            <p>{{ \Illuminate\Support\Str::limit(strip_tags($item->content), 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('announcements.show', $item->id) }}"
                                class="btn-flat green-text text-darken-2">Read More</a>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Categories + Search -->
            <div class="col s12 m3">
                <form action="{{ route('news_events') }}" method="GET" style="margin-bottom: 1.5rem;">
                    <div class="input-field" style="margin-bottom:0;">
                        <input type="text" name="search" id="search" placeholder="Search news..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn red" style="margin-top:8px;">Search</button>
                    </div>
                </form>
                <div>
                    <h6 style="font-weight:700;letter-spacing:1px;">NEWS CATEGORIES</h6>
                    <ul style="list-style:none;padding-left:0;">
                        @foreach($categories as $category)
                            <li style="margin-bottom:8px;">
                                <a href="{{ route('news_events', ['category' => $category->slug]) }}"
                                    style="color:#222;text-decoration:underline;">{{ $category->name }}</a>
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
    <script>     function openModal(img) { document.getElementById('imgModal').style.display = 'flex'; document.getElementById('modalImg').src = img.src; } function closeModal() { document.getElementById('imgModal').style.display = 'none'; document.getElementById('modalImg').src = ''; }     // Optional: Close modal when clicking outside the image     document.addEventListener('DOMContentLoaded', function () {         var modal = document.getElementById('imgModal');         modal.addEventListener('click', function (e) {             if (e.target === modal) closeModal();         });     });
    </script>
@endsection