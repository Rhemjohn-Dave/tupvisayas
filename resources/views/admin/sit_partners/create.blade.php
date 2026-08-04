@extends('layouts.admin')

@section('title', 'Admin — Add SIT Partner')

@section('admin_content')
    <div class="section">
        <h4>Add industry partner</h4>
        <form action="{{ route('admin.sit-partners.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                <label for="name">Company name <span style="color:red">*</span></label>
                @error('name')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="url" name="website_url" id="website_url" value="{{ old('website_url') }}"
                    placeholder="https://example.com">
                <label for="website_url">Website URL (optional)</label>
                @error('website_url')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Logo</span>
                    <input type="file" name="logo_path" id="logo_path" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload partner logo (optional)">
                </div>
                @error('logo_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
                <x-admin.image-spec type="sit-partner" />
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
            <button type="submit" class="btn">Add partner</button>
            <a href="{{ route('admin.sit-partners.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
@endsection
