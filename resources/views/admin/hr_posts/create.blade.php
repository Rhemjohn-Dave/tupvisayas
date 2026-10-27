@extends('layouts.admin')

@section('title', 'Admin — Create HR post')

@section('admin_content')
    <x-admin.page-header title="Create HR post"
        subtitle="Announcements or COA Sec. 13 programs (seminar, conference, training, oath taking).">
        <x-slot name="actions">
            <a href="{{ route('admin.hr_posts.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to posts
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.hr_posts.store') }}" enctype="multipart/form-data">
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
                    @foreach (\App\Models\HrPost::typeOptions() as $value => $label)
                        <option value="{{ $value }}" @selected(old('type', 'announcement') === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('type')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group" data-hr-program-fields>
                <label class="admin-label" for="department_id">Department</label>
                <select class="admin-select browser-default" name="department_id" id="department_id">
                    <option value="">Select department</option>
                    @foreach ($departments as $department)
                        <option value="{{ $department->id }}"
                            {{ (string) old('department_id') === (string) $department->id ? 'selected' : '' }}>
                            {{ $department->name }}
                        </option>
                    @endforeach
                </select>
                <p class="admin-form__hint">Required for programs conducted by a department.</p>
                @error('department_id')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group" data-hr-program-fields>
                <label class="admin-label" for="event_date">Event date</label>
                <input class="admin-input" type="date" name="event_date" id="event_date"
                    value="{{ old('event_date') }}">
                <p class="admin-form__hint">Required for programs.</p>
                @error('event_date')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group" data-hr-program-fields>
                <label class="admin-label" for="report_file">Report PDF (optional)</label>
                <input class="admin-file" type="file" name="report_file" id="report_file" accept="application/pdf,.pdf">
                <p class="admin-form__hint">Upload the posted report for COA Sec. 13 (PDF · max 10 MB).</p>
                @error('report_file')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="slug">Slug</label>
                <input class="admin-input" type="text" name="slug" id="slug" value="{{ old('slug') }}"
                    placeholder="Auto-generated from title if left blank">
                <p class="admin-form__hint">Public URL: /human-resources/posts/your-slug</p>
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
                <p class="admin-form__hint">Draft posts are hidden from the public Human Resources page.</p>
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
                <textarea name="content" id="content" class="admin-textarea wysiwyg"
                    data-wysiwyg-required="true">{{ old('content') }}</textarea>
                @error('content')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    Create post
                </button>
                <a href="{{ route('admin.hr_posts.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var typeSelect = document.getElementById('type');
            var programFields = document.querySelectorAll('[data-hr-program-fields]');
            var programTypes = @json(\App\Models\HrPost::PROGRAM_TYPES);
            var input = document.getElementById('featured_image');
            var preview = document.getElementById('featuredImagePreview');

            function syncProgramFields() {
                var isProgram = typeSelect && programTypes.indexOf(typeSelect.value) !== -1;
                programFields.forEach(function(el) {
                    el.style.display = isProgram ? '' : 'none';
                });
            }

            if (typeSelect) {
                typeSelect.addEventListener('change', syncProgramFields);
                syncProgramFields();
            }

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
