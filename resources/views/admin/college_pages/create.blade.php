@extends('layouts.admin')

@section('title', 'Admin — New college page')

@section('admin_content')
    <x-admin.page-header title="New college page" subtitle="Create a public academics landing page for a college." />

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.college-pages.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="college">College name</label>
                <input class="admin-input" type="text" name="college" id="college"
                    value="{{ old('college') }}" required
                    placeholder="e.g. College of Automation and Control">
                <p class="admin-form__hint">Use the full official college name. This appears in navigation and URLs.</p>
                @error('college')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="cover_photo">Cover photo</label>
                <input class="admin-file" type="file" name="cover_photo" id="cover_photo" accept="image/*">
                <x-admin.image-spec type="college-cover" />
                @error('cover_photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="history">History</label>
                <textarea name="history" id="history" class="admin-textarea wysiwyg">{{ old('history') }}</textarea>
                @error('history')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Create college page</button>
                <a href="{{ route('admin.college-pages.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
