@extends('layouts.admin')

@section('title', 'Admin — Create USG document')

@section('admin_content')
    <x-admin.page-header title="Create USG document"
        subtitle="Upload a PDF memorandum, resolution, executive order, or advisory.">
        <x-slot name="actions">
            <a href="{{ route('admin.usg-documents.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to documents
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.usg-documents.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title" value="{{ old('title') }}" required>
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="reference_no">Reference no.</label>
                <input class="admin-input" type="text" name="reference_no" id="reference_no"
                    value="{{ old('reference_no') }}" placeholder="e.g. Memo No. 01, s. 2026">
                @error('reference_no')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="category">Category</label>
                <select class="admin-select browser-default" name="category" id="category" required>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category', 'memorandum') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
                @error('category')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="issued_at">Issued date</label>
                <input class="admin-input" type="date" name="issued_at" id="issued_at" value="{{ old('issued_at') }}">
                @error('issued_at')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="summary">Summary</label>
                <textarea class="admin-textarea" name="summary" id="summary" rows="4"
                    placeholder="Optional short description">{{ old('summary') }}</textarea>
                @error('summary')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="file">PDF file</label>
                <input class="admin-file" type="file" name="file" id="file" accept="application/pdf,.pdf" required>
                <p class="admin-form__hint">PDF only · max 10 MB.</p>
                @error('file')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--checkbox">
                <label class="admin-checkbox" for="is_published">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        @checked(old('is_published'))>
                    <span>Publish on the public USG page</span>
                </label>
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save document</button>
            </div>
        </form>
    </div>
@endsection
