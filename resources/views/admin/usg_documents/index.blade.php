@extends('layouts.admin')

@section('title', 'Admin — USG documents')

@section('admin_content')
    <x-admin.page-header title="USG documents"
        subtitle="Memoranda, resolutions, executive orders, and advisories with PDF downloads.">
        <x-slot name="actions">
            <a href="{{ route('usg.documents') }}" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener noreferrer">
                <i class="material-icons" aria-hidden="true">open_in_new</i>
                View on site
            </a>
            <a href="{{ route('admin.usg-documents.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                New document
            </a>
        </x-slot>
    </x-admin.page-header>

    <form method="GET" action="{{ route('admin.usg-documents.index') }}" class="admin-form-card admin-form"
        style="margin-bottom:var(--admin-space-4);">
        <div class="admin-dept-rename__row" style="gap:var(--admin-space-3);flex-wrap:wrap;">
            <div class="admin-form__group" style="margin:0;flex:1;min-width:12rem;">
                <label class="admin-label" for="q">Search</label>
                <input class="admin-input" type="search" name="q" id="q" value="{{ $filters['q'] ?? '' }}"
                    placeholder="Title or reference no.">
            </div>
            <div class="admin-form__group" style="margin:0;min-width:12rem;">
                <label class="admin-label" for="category">Category</label>
                <select class="admin-select browser-default" name="category" id="category">
                    <option value="">All categories</option>
                    @foreach ($categories as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['category'] ?? '') === $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="admin-form__group" style="margin:0;align-self:flex-end;">
                <button type="submit" class="admin-btn admin-btn--secondary">Filter</button>
            </div>
        </div>
    </form>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Reference</th>
                        <th scope="col">Issued</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($documents as $document)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $document->title }}">
                                {{ \Illuminate\Support\Str::limit($document->title, 48) }}
                                <i class="material-icons"
                                    style="font-size:16px;vertical-align:middle;color:var(--admin-accent);"
                                    title="PDF attached" aria-hidden="true">picture_as_pdf</i>
                            </td>
                            <td>{{ $document->category_label }}</td>
                            <td>{{ $document->reference_no ?: '—' }}</td>
                            <td>{{ $document->issued_at?->format('M j, Y') ?: '—' }}</td>
                            <td>
                                @if ($document->is_published)
                                    <span class="admin-badge admin-badge--published">Published</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">Draft</span>
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    @if ($document->fileUrl())
                                        <a href="{{ $document->fileUrl() }}"
                                            class="admin-btn admin-btn--icon admin-btn--accent" title="Download PDF"
                                            aria-label="Download PDF" target="_blank" rel="noopener noreferrer">
                                            <i class="material-icons" aria-hidden="true">download</i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.usg-documents.edit', $document) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit"
                                        aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.usg-documents.destroy', $document) }}"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this document?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--icon admin-btn--danger"
                                            title="Delete" aria-label="Delete">
                                            <i class="material-icons" aria-hidden="true">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table__empty">No USG documents yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $documents->links() }}
@endsection
