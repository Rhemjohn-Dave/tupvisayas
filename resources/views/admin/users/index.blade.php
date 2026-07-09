@extends('layouts.admin')

@section('title', 'Admin — Users')

@section('admin_content')
    <x-admin.page-header title="Users" subtitle="Manage administrator and staff accounts.">
        <x-slot name="actions">
            <a href="{{ route('admin.users.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">person_add</i>
                Add user
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $u)
                        <tr>
                            <td class="admin-table__cell-title">{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>
                                @if($u->is_admin)
                                    <span class="admin-badge admin-badge--published">Admin</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">User</span>
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.users.edit', $u->id) }}" class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit user" aria-label="Edit user">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="admin-inline-form" onsubmit="return confirm('Delete this user?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--icon admin-btn--danger" title="Delete user" aria-label="Delete user">
                                            <i class="material-icons" aria-hidden="true">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="admin-table__empty">No users found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($users->hasPages())
            <div class="admin-pagination-wrap">
                {{ $users->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
