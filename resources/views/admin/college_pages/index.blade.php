@extends('layouts.admin')

@section('title', 'Admin — Academics pages')

@section('admin_content')
    <x-admin.page-header title="Academics pages" subtitle="College landing pages linked from the public Academics menu.">
        <x-slot name="actions">
            <a href="{{ route('admin.college-pages.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                New college page
            </a>
        </x-slot>
    </x-admin.page-header>

    <h2 class="site-section-title admin-section-title">All colleges</h2>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">College</th>
                        <th scope="col">Courses</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($colleges as $college)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $college->college }}">{{ $college->college }}</td>
                            <td>{{ $college->courses_count }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('academics.show', $college->routeSlug()) }}"
                                        class="admin-btn admin-btn--icon admin-btn--primary" target="_blank"
                                        rel="noopener noreferrer" title="View on site" aria-label="View on site">
                                        <i class="material-icons" aria-hidden="true">visibility</i>
                                    </a>
                                    <a href="{{ route('admin.college-pages.edit', $college->id) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit"
                                        aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.college-pages.destroy', $college->id) }}" method="POST"
                                        class="admin-inline-form"
                                        onsubmit="return confirm('Delete this college page and related content?');">
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
                            <td colspan="3" class="admin-table__empty">No college pages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
