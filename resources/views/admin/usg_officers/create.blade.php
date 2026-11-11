@extends('layouts.admin')

@section('title', 'Admin — Add USG officer')

@section('admin_content')
    <x-admin.page-header title="Add USG officer"
        subtitle="Add a published officer to the public University Student Government roster.">
        <x-slot name="actions">
            <a href="{{ route('admin.usg-officers.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to officers
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.usg-officers.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="name">Name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="position">Position</label>
                <input class="admin-input" type="text" name="position" id="position" value="{{ old('position') }}"
                    required placeholder="e.g. President">
                @error('position')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="term_label">Term</label>
                <input class="admin-input" type="text" name="term_label" id="term_label"
                    value="{{ old('term_label') }}" placeholder="e.g. AY 2025–2026">
                @error('term_label')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="sort_order">Sort order</label>
                <input class="admin-input" type="number" name="sort_order" id="sort_order" min="0" max="9999"
                    value="{{ old('sort_order', 0) }}">
                <p class="admin-form__hint">Lower numbers appear first.</p>
                @error('sort_order')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="photo">Photo</label>
                <input class="admin-file" type="file" name="photo" id="photo" accept="image/*">
                <p class="admin-form__hint">Optional · JPEG/PNG/WebP · max 4 MB.</p>
                @error('photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--checkbox">
                <label class="admin-checkbox" for="is_published">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        @checked(old('is_published', true))>
                    <span>Publish on the public USG page</span>
                </label>
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save officer</button>
            </div>
        </form>
    </div>
@endsection
