@extends('layouts.admin')

@section('title', 'Admin — Categories')

@section('admin_content')
    <x-admin.page-header title="Categories" subtitle="Categories group news, announcements, jobs, and events.">
        <x-slot name="actions">
            <a href="{{ route('admin.categories.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                New category
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Slug</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="admin-table__cell-title">{{ $category->name }}</td>
                            <td><code style="font-size:0.8125rem;color:var(--admin-text-muted);">{{ $category->slug }}</code></td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="admin-table__empty">No categories yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
