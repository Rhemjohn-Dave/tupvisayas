@extends('layouts.admin')

@section('title', 'Admin — Edit USG document')

@section('admin_content')
    <x-admin.page-header title="Edit USG document"
        subtitle="Update details or replace the PDF file.">
        <x-slot name="actions">
            <a href="{{ route('admin.usg-documents.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to documents
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST" action="{{ route('admin.usg-documents.update', $document) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title"
                    value="{{ old('title', $document->title) }}" required>
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="reference_no">Reference no.</label>
                <input class="admin-input" type="text" name="reference_no" id="reference_no"
                    value="{{ old('reference_no', $document->reference_no) }}">
                @error('reference_no')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="category">Category</label>
                <select class="admin-select browser-default" name="category" id="category" required>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(old('category', $document->category) === $value)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="issued_at">Issued date</label>
                <input class="admin-input" type="date" name="issued_at" id="issued_at"
                    value="{{ old('issued_at', $document->issued_at?->format('Y-m-d')) }}">
                @error('issued_at')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="summary">Summary</label>
                <textarea class="admin-textarea" name="summary" id="summary"
                    rows="4">{{ old('summary', $document->summary) }}</textarea>
                @error('summary')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="file">PDF file</label>
                @if ($document->fileUrl())
                    <p class="admin-form__hint" style="margin-bottom:0.5rem;">
                        Current:
                        <a href="{{ $document->fileUrl() }}" target="_blank" rel="noopener noreferrer">Download PDF</a>
                    </p>
                @endif
                <input class="admin-file" type="file" name="file" id="file" accept="application/pdf,.pdf">
                <p class="admin-form__hint">Leave blank to keep the current file. PDF only · max 10 MB.</p>
                @error('file')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--checkbox">
                <label class="admin-checkbox" for="is_published">
                    <input type="checkbox" name="is_published" id="is_published" value="1"
                        @checked(old('is_published', $document->is_published))>
                    <span>Publish on the public USG page</span>
                </label>
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">Save changes</button>
            </div>
        </form>
    </div>
@endsection
