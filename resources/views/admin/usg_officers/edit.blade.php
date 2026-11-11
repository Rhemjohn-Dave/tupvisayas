@extends('layouts.admin')

@section('title', 'Admin — Edit USG officer')

@section('admin_content')
    <x-admin.page-header title="Edit USG officer"
        subtitle="Update officer details or photo.">
        <x-slot name="actions">
            <a href="{{ route('admin.usg-officers.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to officers
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.usg-officers.update', $officer) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="name">Name</label>
                <input class="admin-input" type="text" name="name" id="name"
                    value="{{ old('name', $officer->name) }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="position">Position</label>
                <input class="admin-input" type="text" name="position" id="position"
                    value="{{ old('position', $officer->position) }}" required>
                @error('position')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="term_label">Term</label>
                <input class="admin-input" type="text" name="term_label" id="term_label"
                    value="{{ old('term_label', $officer->term_label) }}">
                @error('term_label')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="sort_order">Sort order</label>
                <input class="admin-input" type="number" name="sort_order" id="sort_order" min="0" max="9999"
                    value="{{ old('sort_order', $officer->sort_order) }}">
                @error('sort_order')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="photo">Photo</label>
                @if ($officer->photoUrl())
                    <div style="margin-bottom:0.75rem;">
                        <img src="{{ $officer->photoUrl() }}" alt="" width="96" height="96"
                            style="object-fit:cover;border-radius:4px;border:1px solid var(--color-border);">
                    </div>
                    <label class="admin-checkbox" for="remove_photo" style="margin-bottom:0.75rem;">
                        <input type="checkbox" name="remove_photo" id="remove_photo" value="1">
                        <span>Remove current photo</span>
                    </label>
                @endif
                <input class="admin-file" type="file" name="photo" id="photo" accept="image/*">
                <p class="admin-form__hint">Optional · JPEG/PNG/WebP · max 4 MB.</p>
                @error('photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--checkbox">
                <label class="admin-checkbox" for="is_published">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        @checked(old('is_published', $officer->is_published))>
                    <span>Publish on the public USG page</span>
                </label>
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
            </div>
        </form>
    </div>
@endsection
