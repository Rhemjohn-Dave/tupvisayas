@extends('layouts.admin')

@section('title', 'Admin — Edit course')

@section('admin_content')
    <x-admin.page-header title="Edit course" :subtitle="$college->college">
        <x-slot name="actions">
            @if ($course->slug)
                <a href="{{ route('academics.program', [$college->routeSlug(), $course->slug]) }}"
                    class="admin-btn admin-btn--ghost" target="_blank" rel="noopener noreferrer">
                    <i class="material-icons" aria-hidden="true">open_in_new</i>
                    View on site
                </a>
            @endif
            <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to college page
            </a>
        </x-slot>
    </x-admin.page-header>

    @php
        $sectionStatus = [
            'description' => 'Overview',
            'curriculum' => 'Curriculum',
            'facilities_labs' => 'Labs & facilities',
            'accreditation_info' => 'Accreditation',
            'board_performance' => 'Board performance',
            'scholarships' => 'Scholarships',
        ];
    @endphp

    <div class="admin-form-card admin-form admin-course-status">
        <h2 class="admin-section-title">Program page content</h2>
        <p class="admin-form__hint">Empty sections stay hidden on the public program page until you add content.</p>
        <ul class="admin-section-checklist">
            @foreach ($sectionStatus as $field => $label)
                <li class="admin-section-checklist__item">
                    @if ($course->hasSection($field))
                        <span class="admin-badge admin-badge--published">Filled</span>
                    @else
                        <span class="admin-badge admin-badge--draft">Empty</span>
                    @endif
                    <span>{{ $label }}</span>
                </li>
            @endforeach
            <li class="admin-section-checklist__item">
                @if ($course->logo)
                    <span class="admin-badge admin-badge--published">Filled</span>
                @else
                    <span class="admin-badge admin-badge--draft">Empty</span>
                @endif
                <span>Logo</span>
            </li>
        </ul>
    </div>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.courses.update', $course->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="name">Course name</label>
                <input class="admin-input" type="text" name="name" id="name"
                    value="{{ old('name', $course->name) }}" required>
                @error('name')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="slug">URL slug</label>
                <input class="admin-input" type="text" name="slug" id="slug"
                    value="{{ old('slug', $course->slug) }}" pattern="[a-z0-9]+(?:-[a-z0-9]+)*">
                <p class="admin-form__hint">Public URL:
                    /academics/{{ $college->routeSlug() }}/programs/<strong>{{ old('slug', $course->slug) ?: '…' }}</strong>
                </p>
                @error('slug')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="description">Description / overview</label>
                <textarea name="description" id="description"
                    class="admin-textarea wysiwyg">{{ old('description', $course->description) }}</textarea>
                @error('description')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            @include('admin.courses.partials.microsite-fields', ['course' => $course])

            <div class="admin-form__group">
                <label class="admin-label" for="logo">Course logo</label>
                <input class="admin-file" type="file" name="logo" id="logo" accept="image/*">
                @if ($course->logo)
                    <img class="admin-preview-img" src="{{ asset('storage/' . $course->logo) }}" alt="Current logo"
                        style="width:120px;height:120px;object-fit:contain;background:var(--color-surface-alt);">
                @endif
                <x-admin.image-spec type="course-logo" />
                @error('logo')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save course</button>
                <a href="{{ route('admin.college-pages.edit', $college->id) }}?tab=admin-college-courses" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
                    height: 280
                });
            }
        });
    </script>
@endsection
