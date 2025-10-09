@extends('layouts.admin')

@section('title', 'Edit TIPTTO Post')

@section('admin_content')
<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h4 class="card-title">Edit TIPTTO Post</h4>
                    
                    <form method="POST" action="{{ route('admin.tiptto_posts.update', $tipttoPost) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <input id="title" name="title" type="text" class="validate" 
                                           value="{{ old('title', $tipttoPost->title) }}" required>
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
                                    <input id="slug" name="slug" type="text" class="validate" 
                                           value="{{ old('slug', $tipttoPost->slug) }}">
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
                                    <textarea id="excerpt" name="excerpt" class="materialize-textarea">{{ old('excerpt', $tipttoPost->excerpt) }}</textarea>
                                    <label for="excerpt">Excerpt (Optional)</label>
                                    @error('excerpt')
                                        <span class="helper-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        @if($tipttoPost->featured_image)
                            <div class="row">
                                <div class="col s12">
                                    <p>Current Featured Image:</p>
                                    <img src="{{ asset('storage/' . $tipttoPost->featured_image) }}" 
                                         alt="Current featured image" 
                                         style="max-width: 200px; height: auto;">
                                    <p>
                                        <label>
                                            <input type="checkbox" name="remove_featured_image" value="1">
                                            <span>Remove current image</span>
                                        </label>
                                    </p>
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col s12">
                                <div class="file-field input-field">
                                    <div class="btn cardinal-red">
                                        <span>Change Featured Image</span>
                                        <input type="file" name="featured_image" accept="image/*">
                                    </div>
                                    <div class="file-path-wrapper">
                                        <input class="file-path validate" type="text" placeholder="Choose a new image">
                                    </div>
                                    @error('featured_image')
                                        <span class="helper-text red-text">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div id="preview" style="margin-top:10px; display:none;">
                                    <img id="previewImg" src="#" alt="Preview" style="max-width: 300px; height: auto; border:1px solid #eee; border-radius:4px;" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <div class="input-field">
                                    <textarea id="content" name="content" class="wysiwyg">{{ old('content', $tipttoPost->content) }}</textarea>
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
                                        <input type="checkbox" name="is_published" value="1" 
                                               {{ old('is_published', $tipttoPost->is_published) ? 'checked' : '' }}>
                                        <span>Published</span>
                                    </label>
                                </p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <button type="submit" class="btn cardinal-red white-text">
                                    <i class="material-icons left">save</i>
                                    Update Post
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
@endsection

@section('admin_scripts')
<script>
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
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endsection
