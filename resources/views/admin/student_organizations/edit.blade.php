@extends('layouts.admin')

@section('title', 'Admin — Edit student organization')

@section('admin_content')
    <x-admin.page-header title="Edit student organization" :subtitle="$college->college">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-org"
                class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.student-organizations.update', $organization->id) }}"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="name">Organization name</label>
                <input class="admin-input" type="text" name="name" id="name"
                    value="{{ old('name', $organization->name) }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="logo">Logo</label>
                <input class="admin-file" type="file" name="logo" id="logo" accept="image/*">
                @if ($organization->logo)
                    <img class="admin-preview-img" src="{{ asset('storage/' . $organization->logo) }}"
                        alt="{{ $organization->name }} logo"
                        style="width:120px;height:120px;object-fit:contain;background:var(--color-surface-alt);">
                @endif
                <x-admin.image-spec type="org-logo" />
                @error('logo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="description">About the organization</label>
                <textarea name="description" id="description"
                    class="admin-textarea wysiwyg">{{ old('description', $organization->description) }}</textarea>
                @error('description')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="email">Contact email</label>
                <input class="admin-input" type="email" name="email" id="email"
                    value="{{ old('email', $organization->email) }}">
                @error('email')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="website">Website or social link</label>
                <input class="admin-input" type="url" name="website" id="website"
                    value="{{ old('website', $organization->website) }}">
                @error('website')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="sort_order">Display order</label>
                <input class="admin-input" type="number" name="sort_order" id="sort_order"
                    value="{{ old('sort_order', $organization->sort_order) }}" min="0" step="1">
                @error('sort_order')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save organization</button>
                <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-org"
                    class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
