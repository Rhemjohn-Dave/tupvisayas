@extends('layouts.app')

@section('content')
<<<<<<< HEAD
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
=======
    <div class="section">
        <h3>Administrative Officials</h3>
        <div class="row">
            @foreach($officials as $official)
                <div class="col s12 m4">
                    <div class="card">
                        <div class="card-image">
                            <img src="{{ $official->photo ? asset('storage/' . $official->photo) : 'https://via.placeholder.com/200x200' }}"
                                alt="{{ $official->name }}"
                                style="width:300px; height:300px; object-fit:cover; display:block; margin:auto; border-radius:8px;">
                        </div>
                        <div class="card-content center-align">
                            <span class="card-title">{{ $official->name }}</span>
                            <p>{{ $official->position }}</p>
                            <!-- <a href="{{ route('officials.show', $official->id) }}" class="btn-small"
                                        style="margin-top:10px;">View Profile</a> -->
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
