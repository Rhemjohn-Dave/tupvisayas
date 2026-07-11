@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section">
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
                            </div>
                        @endif
                        <div class="card-content">
                            <span class="card-title">{{ $item->title }}</span>
                            <p class="site-prose">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                        </div>
                        <div class="card-action">
                            <a href="{{ route('jobs.show', $item->slug) }}" class="btn-flat">Read more</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if ($jobs->hasPages())
            <div class="section">
                {{ $jobs->links('pagination.public') }}
            </div>
        @endif
    </div>

    <div id="imgModal" class="site-modal-overlay" role="dialog" aria-modal="true" aria-label="Image preview">
        <button type="button" class="site-modal-close" onclick="closeModal()" aria-label="Close">&times;</button>
        <img id="modalImg" src="" alt="">
    </div>
@endsection

@section('scripts')
    <script>
        function openModal(img) {
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
                if (e.target === modal) closeModal();
            });
        });
    </script>
@endsection
