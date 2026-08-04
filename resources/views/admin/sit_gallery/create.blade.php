@extends('layouts.admin')

@section('title', 'Admin — Add SIT Photo')

@section('admin_content')
    <div class="section">
        <h4>Add student experience photo</h4>
        <form action="{{ route('admin.sit-gallery.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="file-field input-field">
                <div class="btn">
                    <span>Photo <span style="color:red">*</span></span>
                    <input type="file" name="image_path" id="image_path" required accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload SIT photo">
                </div>
                @error('image_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
                <x-admin.image-spec type="sit-gallery" />
            </div>
            <div class="input-field">
                <input type="text" name="caption" id="caption" value="{{ old('caption') }}">
                <label for="caption">Caption</label>
                @error('caption')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="number" name="order" id="order" value="{{ old('order', 1) }}" min="1" required>
                <label for="order">Display order <span style="color:red">*</span></label>
                @error('order')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <p>
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" {{ old('is_active', '1') == '1' ? 'checked' : '' }}>
                    <span>Show on public SIT page</span>
                </label>
            </p>
            <button type="submit" class="btn">Add photo</button>
            <a href="{{ route('admin.sit-gallery.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
@endsection
