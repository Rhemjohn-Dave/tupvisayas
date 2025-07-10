@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="card">
            @if($announcement->picture)
                <div class="card-image">
                    <img src="{{ asset('storage/' . $announcement->picture) }}" alt="Announcement Image"
                        style="max-height:300px;object-fit:cover;">
                </div>
            @endif
            <div class="card-content">
                <span class="card-title">{{ $announcement->title }}</span>
                <p>{{ $announcement->content }}</p>
            </div>
        </div>
        <a href="{{ route('announcements') }}" class="btn grey">Back to Announcements</a>
    </div>
@endsection