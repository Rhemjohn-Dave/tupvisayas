@extends('layouts.admin')

@section('title', 'Admin — Edit SIT Photo')

@section('admin_content')
    <div class="section">
        <h4>Edit student experience photo</h4>
        <form action="{{ route('admin.sit-gallery.update', $image) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field">
                <label style="display:block; margin-bottom:8px;">Current photo</label>
                @if ($image->image_path)
                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->caption }}"
                        style="height: 120px; width: auto; border-radius: 4px; margin-bottom: 10px;">
                @endif
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Replace photo</span>
                    <input type="file" name="image_path" id="image_path" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload new photo (optional)">
                </div>
                @error('image_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
                <x-admin.image-spec type="sit-gallery" />
            </div>
            <div class="input-field">
                <input type="text" name="caption" id="caption" value="{{ old('caption', $image->caption) }}">
                <label for="caption">Caption</label>
                @error('caption')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="number" name="order" id="order" value="{{ old('order', $image->order) }}" min="1" required>
                <label for="order">Display order <span style="color:red">*</span></label>
                @error('order')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <p>
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                        {{ (string) old('is_active', $image->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                    <span>Show on public SIT page</span>
                </label>
            </p>
            <button type="submit" class="btn orange">Update photo</button>
            <a href="{{ route('admin.sit-gallery.index') }}" class="btn">Cancel</a>
        </form>
    </div>
@endsection
