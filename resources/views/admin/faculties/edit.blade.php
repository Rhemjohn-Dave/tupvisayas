@extends('layouts.admin')

@section('title', 'Admin — Edit faculty')

@section('admin_content')
    <x-admin.page-header title="Edit faculty" :subtitle="'Department: ' . $department->name">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}?tab=admin-college-dept"
                class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.faculties.update', $faculty->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="name">Faculty name</label>
                <input class="admin-input" type="text" name="name" id="name"
                    value="{{ old('name', $faculty->name) }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="rank">Faculty rank</label>
                <input class="admin-input" type="text" name="rank" id="rank"
                    value="{{ old('rank', $faculty->rank) }}" required>
                @error('rank')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="photo">Photo</label>
                <input class="admin-file" type="file" name="photo" id="photo" accept="image/*">
                @if ($faculty->photo)
                    <img class="admin-preview-img" src="{{ asset('storage/' . $faculty->photo) }}" alt="Current photo"
                        style="width:120px;height:120px;object-fit:cover;">
                @endif
                <p class="admin-form__hint">Upload a new image to replace the current photo.</p>
                @error('photo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
                <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}?tab=admin-college-dept"
                    class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
