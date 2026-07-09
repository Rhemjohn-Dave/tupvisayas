@extends('layouts.app')

@section('content')
    <div class="section">
        <div class="row">
            <div class="col s12 m4 center-align">
                <img src="{{ $official->photo ? asset('storage/' . $official->photo) : 'https://via.placeholder.com/200x200' }}"
                    alt="{{ $official->name }}" class="circle responsive-img"
                    style="width:300px; height:300px; object-fit:cover; display:block; margin:auto;">
                <h4>{{ $official->name }}</h4>
                <h6>{{ $official->position }}</h6>
            </div>
            <div class="col s12 m8">
                <h5>About</h5>
                <p>{{ $official->bio }}</p>
                @if($official->social_links)
                    <h6>Social Links</h6>
                    <ul>
                        @foreach(json_decode($official->social_links, true) as $type => $link)
                            <li><a href="{{ $link }}" target="_blank">{{ ucfirst($type) }}</a></li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
        <a href="{{ route('officials') }}" class="btn">Back to Officials</a>
    </div>
@endsection