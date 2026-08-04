@extends('layouts.admin')

@section('title', 'Admin — SIT Partners')

@section('admin_content')
    <x-admin.page-header title="SIT industry partners" subtitle="Companies shown on the Supervised Industrial Training page.">
        <x-slot name="actions">
            <a href="{{ route('admin.sit-partners.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add_business</i>
                Add partner
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Logo</th>
                        <th scope="col">Name</th>
                        <th scope="col">Website</th>
                        <th scope="col">Order</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($partners as $partner)
                        <tr>
                            <td>
                                @if ($partner->logo_path)
                                    <img src="{{ asset('storage/' . $partner->logo_path) }}" alt="" width="56" height="56"
                                        style="object-fit:contain;border-radius:8px;border:1px solid var(--admin-border);background:#fff;padding:4px;">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $partner->name }}</td>
                            <td>
                                @if ($partner->website_url)
                                    <a href="{{ $partner->website_url }}" target="_blank" rel="noopener noreferrer">
                                        {{ Str::limit($partner->website_url, 36) }}
                                    </a>
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ $partner->order }}</td>
                            <td>{{ $partner->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.sit-partners.edit', $partner) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.sit-partners.destroy', $partner) }}" method="POST"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this partner?');">
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
                            <td colspan="6" class="admin-table__empty">No industry partners yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
