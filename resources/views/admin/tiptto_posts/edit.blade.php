@extends('layouts.admin')

@section('title', 'Admin — Edit TIPTTO post')

@section('admin_content')
    <x-admin.page-header title="Edit TIPTTO post" :subtitle="$tipttoPost->title">
        <x-slot name="actions">
            <a href="{{ route('admin.tiptto_posts.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to posts
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.tiptto_posts.update', $tipttoPost) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title"
                    value="{{ old('title', $tipttoPost->title) }}" required>
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="slug">Slug</label>
                <input class="admin-input" type="text" name="slug" id="slug"
                    value="{{ old('slug', $tipttoPost->slug) }}">
                <p class="admin-form__hint">Public URL: /tiptto/posts/{{ $tipttoPost->slug }}</p>
                @error('slug')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="excerpt">Excerpt</label>
                <textarea class="admin-textarea" name="excerpt" id="excerpt" rows="3">{{ old('excerpt', $tipttoPost->excerpt) }}</textarea>
                @error('excerpt')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            @if ($tipttoPost->featured_image)
                <div class="admin-form__group">
                    <span class="admin-label">Current featured image</span>
                    <img class="admin-preview-img" src="{{ asset('storage/' . $tipttoPost->featured_image) }}"
                        alt="{{ $tipttoPost->title }} featured image"
                        style="max-width:320px;display:block;margin-bottom:var(--admin-space-3);">
                    <label class="admin-label">
                        <input type="checkbox" name="remove_featured_image" value="1">
                        Remove current image
                    </label>
                </div>
            @endif

            <div class="admin-form__group">
                <label class="admin-label" for="featured_image">{{ $tipttoPost->featured_image ? 'Replace featured image' : 'Featured image' }}</label>
                <input class="admin-file" type="file" name="featured_image" id="featured_image" accept="image/*">
                <img id="featuredImagePreview" class="admin-preview-img" src="#" alt="Featured image preview"
                    style="display:none;margin-top:var(--admin-space-3);max-width:320px;">
                @error('featured_image')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="content">Content</label>
                <textarea name="content" id="content" class="admin-textarea wysiwyg" data-wysiwyg-required="true">{{ old('content', $tipttoPost->content) }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label">
                    <input type="checkbox" name="is_published" value="1"
                        {{ old('is_published', $tipttoPost->is_published) ? 'checked' : '' }}>
                    Published
                </label>
                @error('is_published')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    Save changes
                </button>
                <a href="{{ route('admin.tiptto_posts.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
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
