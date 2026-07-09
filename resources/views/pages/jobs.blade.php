@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section">
<<<<<<< HEAD
        <h1 class="site-page-title">Job openings</h1>
        <p class="site-prose site-stack-top">Explore career opportunities and join our mission to provide quality education
            and service to the community.</p>
        <div class="row site-stack-top">
            @foreach ($jobs as $item)
                <div class="col s12 m6">
                    <div class="card hoverable">
                        @if ($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="" loading="lazy"
                                    class="site-zoom-thumb" onclick="openModal(this)">
=======
        <h3 style="color:#C41E3A; font-weight:700;">Job Openings at TUP Visayas</h3>
        <p>Explore exciting career opportunities and join our mission to provide quality education and service to the
            community.</p>
        <div class="row">
            @foreach($jobs as $item)
                <div class="col s12 m6">
                    <div class="card hoverable">
                        @if($item->picture)
                            <div class="card-image">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Job Image"
                                    style="max-height:200px;object-fit:cover;cursor:pointer;" onclick="openModal(this)">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
<<<<<<< HEAD
                            <p class="site-prose">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="btn-flat">Read more</a>
=======
                            <p>{{ Str::limit($item->content, 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="btn-flat red-text text-darken-2">Read
                                More</a>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
<<<<<<< HEAD

    <div id="imgModal" class="site-modal-overlay" role="dialog" aria-modal="true" aria-label="Image preview">
        <button type="button" class="site-modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
        <img id="modalImg" src="" alt="">
=======
    <!-- Modal for full screen image -->
    <div id="imgModal" class="modal"
        style="display:none;position:fixed;z-index:9999;left:0;top:0;width:100vw;height:100vh;background:rgba(0,0,0,0.9);align-items:center;justify-content:center;">
        <span onclick="closeModal()"
            style="position:absolute;top:30px;right:40px;font-size:40px;color:white;cursor:pointer;z-index:10001;">&times;</span>
        <img id="modalImg" src=""
            style="max-width:90vw;max-height:90vh;display:block;margin:auto;box-shadow:0 0 20px #000;">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(img) {
<<<<<<< HEAD
            document.getElementById('imgModal').classList.add('is-open');
            document.getElementById('modalImg').src = img.src;
        }

        function closeModal() {
            document.getElementById('imgModal').classList.remove('is-open');
            document.getElementById('modalImg').src = '';
        }
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('imgModal');
            if (!modal) return;
            modal.addEventListener('click', function(e) {
=======
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
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                if (e.target === modal) closeModal();
            });
        });
    </script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
