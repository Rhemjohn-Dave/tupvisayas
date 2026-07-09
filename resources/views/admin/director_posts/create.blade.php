@extends('layouts.admin')

@section('title', "Admin — Create Director's Corner post")

@section('admin_content')
    <x-admin.page-header title="Create Director's Corner post" subtitle="Add a blog or news post from the director.">
        <x-slot name="actions">
            <a href="{{ route('admin.director_posts.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to posts
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.director_posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title" value="{{ old('title') }}" required
                    placeholder="Post title">
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="type">Type</label>
                <select class="admin-select browser-default" name="type" id="type" required>
                    <option value="news" {{ old('type', 'news') === 'news' ? 'selected' : '' }}>News</option>
                    <option value="blog" {{ old('type') === 'blog' ? 'selected' : '' }}>Blog</option>
                </select>
                @error('type')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="slug">Slug</label>
                <input class="admin-input" type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder="Auto-generated from title if left blank">
                <p class="admin-form__hint">Public URL: /directors-corner/posts/your-slug</p>
                @error('slug')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="excerpt">Excerpt</label>
                <textarea class="admin-textarea" name="excerpt" id="excerpt" rows="3"
                    placeholder="Short summary shown in listings (optional)">{{ old('excerpt') }}</textarea>
                @error('excerpt')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--checkbox">
                <label class="admin-checkbox" for="is_published">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        {{ old('is_published') ? 'checked' : '' }}>
                    <span>Publish immediately</span>
                </label>
                <p class="admin-form__hint">Draft posts are hidden from the public Director's Corner page.</p>
                @error('is_published')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="featured_image">Featured image</label>
                <input class="admin-file" type="file" name="featured_image" id="featured_image" accept="image/*">
                <img id="featuredImagePreview" class="admin-preview-img" src="#" alt="Featured image preview"
                    style="display:none;margin-top:var(--admin-space-3);max-width:320px;">
                <x-admin.image-spec type="director-post-featured" />
                @error('featured_image')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--editor">
                <label class="admin-label" for="content">Content</label>
                <textarea name="content" id="content" class="admin-textarea wysiwyg" data-wysiwyg-required="true">{{ old('content') }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    Create post
                </button>
                <a href="{{ route('admin.director_posts.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var input = document.getElementById('featured_image');
            var preview = document.getElementById('featuredImagePreview');
            if (!input || !preview) return;

            input.addEventListener('change', function(e) {
                var file = e.target.files && e.target.files[0];
                if (!file) {
                    preview.style.display = 'none';
                    return;
                }

                var reader = new FileReader();
                reader.onload = function(evt) {
                    preview.src = evt.target.result;
                    preview.style.display = 'block';
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
@endsection
