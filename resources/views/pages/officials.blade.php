@extends('layouts.app')

@section('content')
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
                            <a href="{{ route('officials.show', $official->id) }}" class="btn-small"
                                style="margin-top:10px;">View Profile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection