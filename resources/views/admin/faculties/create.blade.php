@extends('layouts.admin')

<<<<<<< HEAD
@section('title', 'Admin — Add faculty')

@section('admin_content')
    <x-admin.page-header title="Add faculty" :subtitle="'Department: ' . $department->name">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}?tab=admin-college-dept"
                class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.faculties.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="department_id" value="{{ $department->id }}">

            <div class="admin-form__group">
                <label class="admin-label" for="name">Faculty name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="rank">Faculty rank</label>
                <input class="admin-input" type="text" name="rank" id="rank" value="{{ old('rank') }}" required
                    placeholder="e.g. Professor I">
                @error('rank')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="photo">Photo</label>
                <input class="admin-file" type="file" name="photo" id="photo" accept="image/*">
                <p class="admin-form__hint">Optional. JPEG or PNG, up to 4 MB.</p>
                @error('photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Add faculty</button>
                <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}?tab=admin-college-dept"
                    class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
=======
@section('admin_content')
    <div class="section" style="max-width:600px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Add Faculty to {{ $department->name }}</h4>
        <form method="POST" action="{{ route('admin.faculties.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="department_id" value="{{ $department->id }}">
            <div class="input-field">
                <label for="name" class="active">Faculty Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="input-field">
                <label for="rank" class="active">Faculty Rank</label>
                <input type="text" name="rank" id="rank" value="{{ old('rank') }}" required>
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Photo</span>
                    <input type="file" name="photo" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload faculty photo (optional)">
                </div>
            </div>
            <button type="submit" class="btn green white-text">Add Faculty</button>
            <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}"
                class="btn grey white-text">Cancel</a>
        </form>
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
