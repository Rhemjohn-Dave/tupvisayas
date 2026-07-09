@extends('layouts.admin')

<<<<<<< HEAD
@section('title', 'Admin — Create TIPTTO post')

@section('admin_content')
    <x-admin.page-header title="Create TIPTTO post" subtitle="Add a new research or extension article.">
        <x-slot name="actions">
            <a href="{{ route('admin.tiptto_posts.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to posts
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.tiptto_posts.store') }}" enctype="multipart/form-data">
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
                <label class="admin-label" for="slug">Slug</label>
                <input class="admin-input" type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder="Auto-generated from title if left blank">
                <p class="admin-form__hint">Used in the public URL. Leave blank to generate from the title.</p>
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

            <div class="admin-form__group">
                <label class="admin-label" for="featured_image">Featured image</label>
                <input class="admin-file" type="file" name="featured_image" id="featured_image" accept="image/*">
                <img id="featuredImagePreview" class="admin-preview-img" src="#" alt="Featured image preview"
                    style="display:none;margin-top:var(--admin-space-3);max-width:320px;">
                @error('featured_image')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="content">Content</label>
                <textarea name="content" id="content" class="admin-textarea wysiwyg" data-wysiwyg-required="true">{{ old('content') }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label">
                    <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                    Publish immediately
                </label>
                <p class="admin-form__hint">Draft posts are hidden from the public TIPTTO page.</p>
                @error('is_published')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    Create post
                </button>
                <a href="{{ route('admin.tiptto_posts.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
=======
@section('title', 'Create TIPTTO Post')

@section('admin_content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title">Create New TIPTTO Post</h4>

                        <form method="POST" action="{{ route('admin.tiptto_posts.store') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="title" name="title" type="text" class="validate"
                                            value="{{ old('title') }}" required>
                                        <label for="title">Title *</label>
                                        @error('title')
                                            <span class="helper-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <input id="slug" name="slug" type="text" class="validate" value="{{ old('slug') }}">
                                        <label for="slug">Slug (optional - auto-generated from title)</label>
                                        @error('slug')
                                            <span class="helper-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <textarea id="excerpt" name="excerpt"
                                            class="materialize-textarea">{{ old('excerpt') }}</textarea>
                                        <label for="excerpt">Excerpt (Optional)</label>
                                        @error('excerpt')
                                            <span class="helper-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <div class="file-field input-field">
                                        <div class="btn cardinal-red">
                                            <span>Featured Image</span>
                                            <input type="file" name="featured_image" accept="image/*">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="Choose an image">
                                        </div>
                                        @error('featured_image')
                                            <span class="helper-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div id="preview" style="margin-top:10px; display:none;">
                                        <img id="previewImg" src="#" alt="Preview"
                                            style="max-width: 300px; height: auto; border:1px solid #eee; border-radius:4px;" />
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <div class="input-field">
                                        <textarea id="content" name="content"
                                            class="wysiwyg">{{ old('content') }}</textarea>
                                        <label for="content">Content *</label>
                                        @error('content')
                                            <span class="helper-text red-text">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}>
                                            <span>Publish immediately</span>
                                        </label>
                                    </p>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col s12">
                                    <button type="submit" class="btn cardinal-red white-text">
                                        <i class="material-icons left">save</i>
                                        Create Post
                                    </button>
                                    <a href="{{ route('admin.tiptto_posts.index') }}" class="btn grey white-text">
                                        <i class="material-icons left">cancel</i>
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cardinal-red {
            background-color: #C41E3A !important;
        }
    </style>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
@endsection

@section('admin_scripts')
    <script>
<<<<<<< HEAD
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
=======
        document.addEventListener('DOMContentLoaded', function () {
            var input = document.querySelector('input[name="featured_image"]');
            if (!input) return;
            input.addEventListener('change', function (e) {
                const file = e.target.files && e.target.files[0];
                if (!file) return;
                const reader = new FileReader();
                reader.onload = function (evt) {
                    const img = document.getElementById('previewImg');
                    const wrap = document.getElementById('preview');
                    if (img && wrap) {
                        img.src = evt.target.result;
                        wrap.style.display = 'block';
                    }
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
