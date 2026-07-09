@extends('layouts.admin')

<<<<<<< HEAD
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
                <p class="admin-form__hint">Optional. Shown on the public college page.</p>
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
=======
@section('admin_content')
    <div class="section" style="max-width:600px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Edit Course ({{ strtoupper($college->college) }})</h4>
        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="input-field">
                <label for="name" class="active">Course Name</label>
                <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" required>
            </div>
            <div class="input-field">
                <label for="description" class="active">Description</label>
                <textarea name="description" id="description"
                    class="materialize-textarea">{{ old('description', $course->description) }}</textarea>
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Logo</span>
                    <input type="file" name="logo" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload course logo (optional)">
                </div>
            </div>
            @if($course->logo)
                <div style="margin:10px 0;">
                    <img src="{{ asset('storage/' . $course->logo) }}" alt="Course Logo"
                        style="height:60px;object-fit:contain;">
                </div>
            @endif
            <button type="submit" class="btn orange white-text">Update Course</button>
            <a href="{{ route('admin.college-pages.edit', $college->id) }}" class="btn grey white-text">Cancel</a>
        </form>
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
