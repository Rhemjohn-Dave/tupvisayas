@extends('layouts.admin')

@section('title', 'Admin — Edit job')

@section('admin_content')
    <x-admin.page-header title="Edit hiring post" subtitle="Update a job opening (HR) or campus recruitment (SIT) posting.">
        <x-slot name="actions">
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to dashboard
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.jobs.update', $job->slug) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="category_id">Category</label>
                <select class="admin-select browser-default" name="category_id" id="category_id" required>
                    <option value="" disabled>Select category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $job->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="listing_type">Hiring type</label>
                <select class="admin-select browser-default" name="listing_type" id="listing_type" required>
                    <option value="{{ \App\Models\Job::TYPE_JOB_OPENING }}"
                        @selected(old('listing_type', $job->listing_type) === \App\Models\Job::TYPE_JOB_OPENING)>
                        Job opening — HR (faculty &amp; staff)
                    </option>
                    <option value="{{ \App\Models\Job::TYPE_CAMPUS_RECRUITMENT }}"
                        @selected(old('listing_type', $job->listing_type) === \App\Models\Job::TYPE_CAMPUS_RECRUITMENT)>
                        Campus recruitment — SIT (students / OJT)
                    </option>
                </select>
                <p class="admin-form__hint">Job openings are campus HR vacancies. Campus recruitment is for SIT student placements.</p>
                @error('listing_type')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title"
                    value="{{ old('title', $job->title) }}" required>
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--editor">
                <label class="admin-label" for="content">Content</label>
                <textarea name="content" id="content" class="admin-textarea wysiwyg"
                    data-wysiwyg-required="true">{{ old('content', $job->content) }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="picture">Image (optional)</label>
                <input class="admin-file" type="file" name="picture" id="picture" accept="image/*">
                <x-admin.image-spec type="article" />
                @if ($job->picture)
                    <img class="admin-preview-img" src="{{ asset('storage/' . $job->picture) }}" alt="Current image"
                        style="max-width:200px;margin-top:0.75rem;">
                @endif
                @error('picture')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Update job</button>
                <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
