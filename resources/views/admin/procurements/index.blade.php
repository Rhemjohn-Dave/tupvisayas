@extends('layouts.admin')

@section('title', 'Admin — Procurement')

@section('admin_content')
    <x-admin.page-header title="Procurement" subtitle="Bid opportunities and PhilGEPS postings.">
        <x-slot name="actions">
            <a href="{{ route('admin.procurements.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                Add record
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Ref No.</th>
                        <th scope="col">Category</th>
                        <th scope="col">Posting</th>
                        <th scope="col">Closing</th>
                        <th scope="col">Type</th>
                        <th scope="col">File</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($procurements as $p)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $p->title }}">{{ Str::limit($p->title, 40) }}</td>
                            <td>{{ $p->reference_no }}</td>
                            <td>{{ $p->category }}</td>
                            <td>{{ \Carbon\Carbon::parse($p->posting_date)->format('M d, Y') }}</td>
                            <td>{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M d, Y') : '—' }}</td>
                            <td>
                                <span class="admin-badge {{ $p->type === 'bid_opportunity' ? 'admin-badge--job' : 'admin-badge--news' }}">
                                    {{ $p->type === 'bid_opportunity' ? 'Bid' : 'PhilGEPS' }}
                                </span>
                            </td>
                            <td>
                                @if($p->file_url)
                                    <a href="{{ $p->file_url }}" target="_blank" rel="noopener noreferrer" class="admin-btn admin-btn--icon admin-btn--ghost" title="Download file" aria-label="Download file">
                                        <i class="material-icons" aria-hidden="true">download</i>
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.procurements.edit', $p->id) }}" class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.procurements.destroy', $p->id) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this record?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--icon admin-btn--danger" title="Delete" aria-label="Delete">
                                            <i class="material-icons" aria-hidden="true">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="admin-table__empty">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($procurements->hasPages())
            <div class="admin-pagination-wrap">
                {{ $procurements->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
