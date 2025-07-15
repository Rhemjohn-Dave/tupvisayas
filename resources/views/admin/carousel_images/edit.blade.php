@extends('layouts.app')

@section('content')
    <div class="section">
        <h4>Edit Carousel Image</h4>
        <form action="{{ route('admin.carousel-images.update', $carouselImage->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field">
                <label style="display:block; margin-bottom:8px;">Current Image</label>
                @if($carouselImage->image_path)
                    <img src="{{ asset('storage/' . $carouselImage->image_path) }}" alt="Carousel Image"
                        style="height: 80px; width: auto; border-radius: 4px; margin-bottom: 10px;">
                @endif
            </div>
            <div class="input-field">
                <label for="image_path" style="display:block; margin-bottom:8px;">Replace Image</label>
                <input type="file" name="image_path" id="image_path" accept="image/*">
                @error('image_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="text" name="caption" id="caption" value="{{ old('caption', $carouselImage->caption) }}">
                <label for="caption">Caption</label>
                @error('caption')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="number" name="order" id="order" value="{{ old('order', $carouselImage->order) }}" min="1"
                    required>
                <label for="order">Order <span style="color:red">*</span></label>
                @error('order')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn orange">Update Image</button>
            <a href="{{ route('admin.carousel-images.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
@endsection