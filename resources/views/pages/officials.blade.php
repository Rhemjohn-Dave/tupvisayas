@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--officials">
        <h1 class="site-page-title site-page-title--center">Administrative officials</h1>
        <p class="site-page-intro">Leadership and key administrators of the Technological University of the Philippines Visayas.</p>

        @if ($officials->count())
            <div class="officials-grid">
                @foreach ($officials as $official)
                    @php
                        $parts = collect(preg_split('/\s+/', trim($official->name)))->filter();
                        $initials = $parts->take(2)->map(fn ($p) => strtoupper(mb_substr($p, 0, 1)))->implode('');
                    @endphp
                    <article class="official-card">
                        <div class="official-card__image">
                            @if ($official->photo)
                                <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                    loading="lazy">
                            @else
                                <div class="official-card__placeholder" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                            @endif
                        </div>
                        <div class="official-card__content">
                            <h2 class="official-card__name">{{ $official->name }}</h2>
                            <p class="official-card__role">{{ $official->position }}</p>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            <p class="officials-empty">No officials are listed at this time.</p>
        @endif
    </div>
@endsection
