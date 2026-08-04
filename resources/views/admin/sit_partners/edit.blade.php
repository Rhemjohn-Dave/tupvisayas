@extends('layouts.admin')

@section('title', 'Admin — Edit SIT Partner')

@section('admin_content')
    <div class="section">
        <h4>Edit industry partner</h4>
        <form action="{{ route('admin.sit-partners.update', $partner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field">
                <input type="text" name="name" id="name" value="{{ old('name', $partner->name) }}" required>
                <label for="name">Company name <span style="color:red">*</span></label>
                @error('name')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <input type="url" name="website_url" id="website_url"
                    value="{{ old('website_url', $partner->website_url) }}" placeholder="https://example.com">
                <label for="website_url">Website URL (optional)</label>
                @error('website_url')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <div class="input-field">
                <label style="display:block; margin-bottom:8px;">Current logo</label>
                @if ($partner->logo_path)
                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="{{ $partner->name }}"
                        style="height: 72px; width: auto; border-radius: 4px; margin-bottom: 10px; background:#fff; padding:6px; border:1px solid #ddd;">
                @else
                    <p class="grey-text">No logo uploaded.</p>
                @endif
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Replace logo</span>
                    <input type="file" name="logo_path" id="logo_path" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload new logo (optional)">
                </div>
                @error('logo_path')
                    <span class="red-text">{{ $message }}</span>
                @enderror
                <x-admin.image-spec type="sit-partner" />
            </div>
            <div class="input-field">
                <input type="number" name="order" id="order" value="{{ old('order', $partner->order) }}" min="1" required>
                <label for="order">Display order <span style="color:red">*</span></label>
                @error('order')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <p>
                <label>
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1"
                        {{ (string) old('is_active', $partner->is_active ? '1' : '0') === '1' ? 'checked' : '' }}>
                    <span>Show on public SIT page</span>
                </label>
            </p>
            <button type="submit" class="btn orange">Update partner</button>
            <a href="{{ route('admin.sit-partners.index') }}" class="btn">Cancel</a>
        </form>
    </div>
@endsection
