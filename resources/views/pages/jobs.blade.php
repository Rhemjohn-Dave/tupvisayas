@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section">
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
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
                            <p>{{ Str::limit($item->content, 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="btn-flat red-text text-darken-2">Read
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