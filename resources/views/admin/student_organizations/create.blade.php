@extends('layouts.admin')

@section('title', 'Admin — Add student organization')

@section('admin_content')
    <x-admin.page-header title="Add student organization" :subtitle="$college->college">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-org"
                class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.student-organizations.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="college_page_id" value="{{ $college->id }}">

            <div class="admin-form__group">
                <label class="admin-label" for="name">Organization name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required
                    placeholder="e.g. Institute of Electronics and Communications Engineers">
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="logo">Logo</label>
                <input class="admin-file" type="file" name="logo" id="logo" accept="image/*">
                <x-admin.image-spec type="org-logo" />
                @error('logo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="description">About the organization</label>
                <textarea name="description" id="description"
                    class="admin-textarea wysiwyg">{{ old('description') }}</textarea>
                @error('description')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="email">Contact email</label>
                <input class="admin-input" type="email" name="email" id="email" value="{{ old('email') }}"
                    placeholder="org@tup.edu.ph">
                @error('email')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="website">Website or social link</label>
                <input class="admin-input" type="url" name="website" id="website" value="{{ old('website') }}"
                    placeholder="https://">
                @error('website')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="sort_order">Display order</label>
                <input class="admin-input" type="number" name="sort_order" id="sort_order"
                    value="{{ old('sort_order', 0) }}" min="0" step="1">
                <p class="admin-form__hint">Lower numbers appear first.</p>
                @error('sort_order')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Add organization</button>
                <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-org"
                    class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
                    height: 280
                });
            }
        });
    </script>
@endsection
