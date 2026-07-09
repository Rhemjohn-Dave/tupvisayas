@extends('layouts.admin')

@section('title', 'Admin — Edit course')

@section('admin_content')
    <x-admin.page-header title="Edit course" :subtitle="$college->college">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="name">Course name</label>
                <input class="admin-input" type="text" name="name" id="name"
                    value="{{ old('name', $course->name) }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="description">Description</label>
                <textarea name="description" id="description"
                    class="admin-textarea wysiwyg">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="logo">Course logo</label>
                <input class="admin-file" type="file" name="logo" id="logo" accept="image/*">
                @if ($course->logo)
                    <img class="admin-preview-img" src="{{ asset('storage/' . $course->logo) }}" alt="Current logo"
                        style="width:120px;height:120px;object-fit:contain;background:var(--color-surface-alt);">
                @endif
                <x-admin.image-spec type="course-logo" />
                @error('logo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save course</button>
                <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">Cancel</a>
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
