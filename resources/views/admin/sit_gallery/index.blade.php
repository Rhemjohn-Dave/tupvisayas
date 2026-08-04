@extends('layouts.admin')

@section('title', 'Admin — SIT Gallery')

@section('admin_content')
    <x-admin.page-header title="SIT student experiences" subtitle="Photos displayed in the Student Experiences gallery on the SIT page.">
        <x-slot name="actions">
            <a href="{{ route('admin.sit-gallery.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add_photo_alternate</i>
                Add photo
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Preview</th>
                        <th scope="col">Caption</th>
                        <th scope="col">Order</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($images as $image)
                        <tr>
                            <td>
                                @if ($image->image_path)
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="" width="84" height="56"
                                        style="object-fit:cover;border-radius:8px;border:1px solid var(--admin-border);">
                                @else
                                    —
                                @endif
                            </td>
                            <td>{{ Str::limit($image->caption ?: '—', 56) }}</td>
                            <td>{{ $image->order }}</td>
                            <td>{{ $image->is_active ? 'Active' : 'Hidden' }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.sit-gallery.edit', $image) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.sit-gallery.destroy', $image) }}" method="POST"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this photo?');">
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
                            <td colspan="5" class="admin-table__empty">No student experience photos yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
