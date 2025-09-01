@extends('layouts.admin')

@section('admin_content')
    <div class="section">
        <h4>Add New Carousel Image</h4>
        <form action="{{ route('admin.carousel-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="file-field input-field">
                <div class="btn red">
                    <span>Image <span style="color:red">*</span></span>
                    <input type="file" name="image_path" id="image_path" required accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload carousel image">
                </div>
                @error('image_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
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
                <label for="order">Order <span style="color:red">*</span></label>
                @error('order')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn red">Add Image</button>
            <a href="{{ route('admin.carousel-images.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
@endsection