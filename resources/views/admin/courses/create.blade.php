@extends('layouts.admin')

@section('title', 'Admin — Add course')

@section('admin_content')
    <x-admin.page-header title="Add course" :subtitle="$college->college">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="college_page_id" value="{{ $college->id }}">

            <div class="admin-form__group">
                <label class="admin-label" for="name">Course name</label>
                <input class="admin-input" type="text" name="name" id="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="slug">URL slug (optional)</label>
                <input class="admin-input" type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder="Auto-generated from course name" pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
                <p class="admin-form__hint">Used in the public program URL. Leave blank to generate from the course name.</p>
                @error('slug')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="description">Description</label>
                <textarea name="description" id="description"
                    class="admin-textarea wysiwyg">{{ old('description') }}</textarea>
                @error('description')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            @include('admin.courses.partials.microsite-fields')

            <div class="admin-form__group">
                <label class="admin-label" for="logo">Course logo</label>
                <input class="admin-file" type="file" name="logo" id="logo" accept="image/*">
                <x-admin.image-spec type="course-logo" />
                @error('logo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Add course</button>
                <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
