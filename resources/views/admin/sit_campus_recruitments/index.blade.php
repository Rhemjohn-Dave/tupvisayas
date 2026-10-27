@extends('layouts.admin')

@section('title', 'Admin — SIT campus recruitment')

@section('admin_content')
    <x-admin.page-header title="Campus recruitment" subtitle="Student / OJT placement postings published on the SIT page.">
        <x-slot name="actions">
            <a href="{{ route('admin.sit_campus_recruitments.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                New posting
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Created</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($jobs as $job)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $job->title }}">
                                {{ Str::limit($job->title, 48) }}
                                @if ($job->picture)
                                    <i class="material-icons" style="font-size:16px;vertical-align:middle;color:var(--admin-accent);"
                                        title="Has image" aria-hidden="true">image</i>
                                @endif
                            </td>
                            <td>{{ $job->category->name ?? '—' }}</td>
                            <td>{{ $job->created_at->format('M j, Y') }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('jobs.show', $job->slug) }}"
                                        class="admin-btn admin-btn--icon admin-btn--accent" title="View public"
                                        aria-label="View public" target="_blank" rel="noopener noreferrer">
                                        <i class="material-icons" aria-hidden="true">open_in_new</i>
                                    </a>
                                    <a href="{{ route('admin.sit_campus_recruitments.edit', $job) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit"
                                        aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.sit_campus_recruitments.destroy', $job) }}"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this posting?');">
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
                            <td colspan="4" class="admin-table__empty">No campus recruitment postings found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($jobs->hasPages())
            <div class="admin-pagination-wrap">
                {{ $jobs->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
