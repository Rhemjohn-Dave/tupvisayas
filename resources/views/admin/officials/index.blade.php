@extends('layouts.admin')

@section('title', 'Admin — Officials')

@section('admin_content')
    <x-admin.page-header title="Officials" subtitle="University leadership shown on the public site.">
        <x-slot name="actions">
            <a href="{{ route('admin.officials.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">person_add</i>
                Add official
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Position</th>
                        <th scope="col">Order</th>
                        <th scope="col">Photo</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($officials as $official)
                        <tr>
                            <td class="admin-table__cell-title">{{ $official->name }}</td>
                            <td>{{ $official->position }}</td>
                            <td>{{ $official->order }}</td>
                            <td>
                                @if($official->photo)
                                    <img src="{{ asset('storage/' . $official->photo) }}" alt="" width="56" height="56" style="object-fit:cover;border-radius:8px;border:1px solid var(--admin-border);">
                                @else
                                    <span style="color:var(--admin-text-muted);">—</span>
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.officials.edit', $official->id) }}" class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.officials.destroy', $official->id) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this official?');">
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
                            <td colspan="5" class="admin-table__empty">No officials yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
