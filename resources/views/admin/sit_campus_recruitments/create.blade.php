@extends('layouts.admin')

@section('title', 'Admin — Create campus recruitment')

@section('admin_content')
    <x-admin.page-header title="Create campus recruitment" subtitle="Post a student / OJT placement for the SIT page.">
        <x-slot name="actions">
            <a href="{{ route('admin.sit_campus_recruitments.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to campus recruitment
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.sit_campus_recruitments.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="category_id">Category</label>
                <select class="admin-select browser-default" name="category_id" id="category_id" required>
                    <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <p class="admin-form__hint" style="margin-top:-0.5rem;margin-bottom:1rem;">
                This form always creates a campus recruitment posting (students / OJT). Faculty &amp; staff vacancies stay under Human Resources → Job openings.
            </p>

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title" value="{{ old('title') }}" required
                    placeholder="Placement title">
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--editor">
                <label class="admin-label" for="content">Content</label>
                <textarea name="content" id="content" class="admin-textarea wysiwyg"
                    data-wysiwyg-required="true">{{ old('content') }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="picture">Image (optional)</label>
                <input class="admin-file" type="file" name="picture" id="picture" accept="image/*">
                <x-admin.image-spec type="article" />
                @error('picture')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    Create posting
                </button>
                <a href="{{ route('admin.sit_campus_recruitments.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
