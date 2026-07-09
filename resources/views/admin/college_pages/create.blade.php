@extends('layouts.admin')

<<<<<<< HEAD
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
=======
@section('admin_content')
    <div class="section" style="max-width:700px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Create College Page</h4>
        <form method="POST" action="{{ route('admin.college-pages.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <label for="college" class="active">College Key (e.g. coe, coac, coet)</label>
                <input type="text" name="college" id="college" value="{{ old('college') }}" required>
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Cover Photo</span>
                    <input type="file" name="cover_photo" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload cover photo (optional)">
                </div>
            </div>
            <div class="input-field">
                <label for="history" class="active">History</label>
                <textarea name="history" id="history" class="materialize-textarea wysiwyg">{{ old('history') }}</textarea>
            </div>
            <div class="input-field">
                <label for="department_faculty" class="active">Department & Faculty</label>
                <textarea name="department_faculty" id="department_faculty"
                    class="materialize-textarea wysiwyg">{{ old('department_faculty') }}</textarea>
            </div>
            <div class="input-field">
                <label for="student_organization" class="active">Student Organization</label>
                <textarea name="student_organization" id="student_organization"
                    class="materialize-textarea wysiwyg">{{ old('student_organization') }}</textarea>
            </div>
            <button type="submit" class="btn red white-text">Create</button>
            <a href="{{ route('admin.college-pages.index') }}" class="btn grey white-text">Cancel</a>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
<<<<<<< HEAD
        document.addEventListener('DOMContentLoaded', function() {
=======
        document.addEventListener('DOMContentLoaded', function () {
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
<<<<<<< HEAD
                    height: 280
=======
                    height: 250
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                });
            }
        });
    </script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
