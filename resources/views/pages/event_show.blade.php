@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="card">
            @if($event->picture)
                <div class="card-image">
                    <img src="{{ asset('storage/' . $event->picture) }}" alt="Event Image"
                        style="max-height:300px;object-fit:cover;">
                </div>
            @endif
            <div class="card-content">
                <span class="card-title">{{ $event->title }}</span>
                <p>{{ $event->content }}</p>
            </div>
        </div>
        <a href="{{ route('news_events') }}" class="btn grey">Back to News & Events</a>
    </div>
@endsection