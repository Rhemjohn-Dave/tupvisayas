@extends('layouts.admin')

@section('title', 'Admin — Create post')

@section('admin_content')
    <x-admin.page-header title="Create post" subtitle="Publish news, announcements, jobs, or events.">
        <x-slot name="actions">
            <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to dashboard
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.posts.store') }}" enctype="multipart/form-data">
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

            <div class="admin-form__group">
                <label class="admin-label" for="type">Post type</label>
                <select class="admin-select browser-default" name="type" id="type" required>
                    <option value="" disabled {{ old('type') ? '' : 'selected' }}>Select post type</option>
                    <option value="news" @selected(old('type') === 'news')>News</option>
                    <option value="announcement" @selected(old('type') === 'announcement')>Announcement</option>
                    <option value="job" @selected(old('type') === 'job')>Job opening</option>
                    <option value="event" @selected(old('type') === 'event')>Event</option>
                </select>
                @error('type')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title" value="{{ old('title') }}" required>
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
                <button type="submit" class="admin-btn admin-btn--primary">Create post</button>
                <a href="{{ route('admin.dashboard') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
