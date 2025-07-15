@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="container">
                <h3>Edit Official</h3>
                <form action="{{ route('admin.officials.update', $official->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="input-field">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $official->name) }}" required>
                    </div>
                    <div class="input-field">
                        <label for="position">Position</label>
                        <input type="text" name="position" id="position" value="{{ old('position', $official->position) }}"
                            required>
                    </div>
                    <div class="input-field">
                        <label for="order">Order</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $official->order) }}">
                    </div>
                    <div class="input-field">
                        <label for="bio">Bio</label>
                        <textarea name="bio" id="bio"
                            class="materialize-textarea">{{ old('bio', $official->bio) }}</textarea>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn">
                            <span>Photo</span>
                            <input type="file" name="photo" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text">
                        </div>
                        @if($official->photo)
                            <div style="margin-top:10px;">
                                <img src="{{ asset('storage/' . $official->photo) }}" alt="Current Photo"
                                    style="max-width:100px;">
                            </div>
                        @endif
                    </div>
                    <div class="input-field">
                        <label for="social_links[facebook]">Facebook</label>
                        <input type="url" name="social_links[facebook]" id="social_links[facebook]"
                            value="{{ old('social_links.facebook', optional(json_decode($official->social_links))->facebook) }}">
                    </div>
                    <div class="input-field">
                        <label for="social_links[linkedin]">LinkedIn</label>
                        <input type="url" name="social_links[linkedin]" id="social_links[linkedin]"
                            value="{{ old('social_links.linkedin', optional(json_decode($official->social_links))->linkedin) }}">
                    </div>
                    <button type="submit" class="btn orange">Update Official</button>
                    <a href="{{ route('admin.officials.index') }}" class="btn grey">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection