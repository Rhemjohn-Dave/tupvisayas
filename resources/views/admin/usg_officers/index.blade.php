@extends('layouts.admin')

@section('title', 'Admin — USG officers')

@section('admin_content')
    <x-admin.page-header title="USG officers"
        subtitle="Published officers appear on the public University Student Government page.">
        <x-slot name="actions">
            <a href="{{ route('usg.index') }}#usg-officers" class="admin-btn admin-btn--ghost" target="_blank"
                rel="noopener noreferrer">
                <i class="material-icons" aria-hidden="true">open_in_new</i>
                View on site
            </a>
            <a href="{{ route('admin.usg-officers.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">person_add</i>
                Add officer
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Photo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Term</th>
                        <th scope="col">Order</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($officers as $officer)
                        <tr>
                            <td>
                                @if ($officer->photoUrl())
                                    <img src="{{ $officer->photoUrl() }}" alt="" width="48" height="48"
                                        style="object-fit:cover;border-radius:4px;border:1px solid var(--color-border);">
                                @else
                                    —
                                @endif
                            </td>
                            <td class="admin-table__cell-title">{{ $officer->name }}</td>
                            <td>{{ $officer->position }}</td>
                            <td>{{ $officer->term_label ?: '—' }}</td>
                            <td>{{ $officer->sort_order }}</td>
                            <td>
                                @if ($officer->is_published)
                                    <span class="admin-badge admin-badge--published">Published</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">Draft</span>
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.usg-officers.edit', $officer) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit"
                                        aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.usg-officers.destroy', $officer) }}"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this officer?');">
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
                            <td colspan="7" class="admin-table__empty">No USG officers yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{ $officers->links() }}
@endsection
