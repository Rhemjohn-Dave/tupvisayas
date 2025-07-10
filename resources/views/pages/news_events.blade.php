@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section">
        <h3>News & Events</h3>
        <div class="row">
            <div class="input-field col s12 m6">
                <input id="search" type="text" class="validate">
                <label for="search">Filter News & Events</label>
            </div>
        </div>
        <div class="row">
            @foreach($news as $item)
                <div class="col s12 m6">
                    <div class="card">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="News Image"
                                    style="max-height:200px;object-fit:cover;cursor:pointer;" onclick="openModal(this)">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
                            <p>{{ Str::limit($item->content, 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('news.show', $item->id) }}" class="btn-flat red-text text-darken-2">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
            @foreach($events as $item)
                <div class="col s12 m6">
                    <div class="card">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Event Image"
                                    style="max-height:200px;object-fit:cover;cursor:pointer;" onclick="openModal(this)">
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
                            <p>{{ Str::limit($item->content, 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('events.show', $item->id) }}" class="btn-flat red-text text-darken-2">Read
                                More</a>
                        </div>
                    </div>
                </div>
            @endforeach
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