@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="card">
            @if($news->picture)
                <div class="card-image">
                    <img src="{{ asset('storage/' . $news->picture) }}" alt="News Image"
                        style="max-height:300px;object-fit:cover;">
                </div>
            @endif
            <div class="card-content">
                <span class="card-title">{{ $news->title }}</span>
                <p>{{ $news->content }}</p>
            </div>
        </div>
        <a href="{{ route('news_events') }}" class="btn grey">Back to News & Events</a>
    </div>
@endsection