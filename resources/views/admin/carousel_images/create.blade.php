@extends('layouts.app')

@section('content')
    <div class="section">
        <h4>Add New Carousel Image</h4>
        <form action="{{ route('admin.carousel-images.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <label for="image_path" style="display:block; margin-bottom:8px;">Image <span
                        style="color:red">*</span></label>
                <input type="file" name="image_path" id="image_path" required accept="image/*">
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