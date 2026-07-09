@extends('layouts.admin')

@section('title', 'Admin — Dashboard')

@section('admin_content')
    @php
        $sortLink = function (string $column) use ($filters) {
            $isActive = ($filters['sort'] ?? 'created_at') === $column;
            $nextDir = $isActive && ($filters['dir'] ?? 'desc') === 'desc' ? 'asc' : 'desc';

            return request()->fullUrlWithQuery(array_merge(
                request()->except(['sort', 'dir', 'page']),
                ['sort' => $column, 'dir' => $nextDir]
            ));
        };
        $sortIndicator = function (string $column) use ($filters) {
            if (($filters['sort'] ?? 'created_at') !== $column) {
                return '';
            }
            return ($filters['dir'] ?? 'desc') === 'asc' ? '↑' : '↓';
        };
    @endphp

    <x-admin.page-header title="Dashboard" subtitle="Overview of site content and quick access to all post types.">
        <x-slot name="actions">
            <a href="{{ route('admin.posts.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                Create post
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-stats">
        <x-admin.stat-card label="Total posts" :value="$stats['posts']" icon="article" />
        <x-admin.stat-card label="Users" :value="$stats['users']" icon="group" />
        <x-admin.stat-card label="Categories" :value="$stats['categories']" icon="category" />
        <x-admin.stat-card label="Officials" :value="$stats['officials']" icon="badge" />
    </div>

<<<<<<< HEAD
    <h2 class="site-section-title admin-section-title">Posts</h2>

=======
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    {{-- Filters: type + preserved query for search/sort --}}
    <form method="get" action="{{ route('admin.dashboard') }}" class="admin-toolbar">
        @if($filters['q'] ?? null)
            <input type="hidden" name="q" value="{{ $filters['q'] }}">
        @endif
        @if($filters['sort'] ?? null)
            <input type="hidden" name="sort" value="{{ $filters['sort'] }}">
        @endif
        @if($filters['dir'] ?? null)
            <input type="hidden" name="dir" value="{{ $filters['dir'] }}">
        @endif
<<<<<<< HEAD
        <label class="admin-toolbar__label" for="filterType">Type</label>
=======
        <label class="visually-hidden" for="filterType">Filter by type</label>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        <select class="admin-select" id="filterType" name="type" onchange="this.form.submit()">
            <option value="">All types</option>
            <option value="news" @selected(($filters['type'] ?? '') === 'news')>News</option>
            <option value="announcement" @selected(($filters['type'] ?? '') === 'announcement')>Announcements</option>
            <option value="job" @selected(($filters['type'] ?? '') === 'job')>Jobs</option>
            <option value="event" @selected(($filters['type'] ?? '') === 'event')>Events</option>
        </select>
    </form>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">
                            <a href="{{ $sortLink('title') }}">Title <span aria-hidden="true">{{ $sortIndicator('title') }}</span></a>
                        </th>
                        <th scope="col">
                            <a href="{{ $sortLink('type') }}">Type <span aria-hidden="true">{{ $sortIndicator('type') }}</span></a>
                        </th>
                        <th scope="col">
                            <a href="{{ $sortLink('category') }}">Category <span aria-hidden="true">{{ $sortIndicator('category') }}</span></a>
                        </th>
                        <th scope="col">
                            <a href="{{ $sortLink('created_at') }}">Created <span aria-hidden="true">{{ $sortIndicator('created_at') }}</span></a>
                        </th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dashboardPaginator as $row)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $row['title'] }}">{{ Str::limit($row['title'], 56) }}</td>
                            <td>
                                @php
                                    $badgeClass = match ($row['type']) {
                                        'news' => 'admin-badge--news',
                                        'announcement' => 'admin-badge--announcement',
                                        'job' => 'admin-badge--job',
                                        'event' => 'admin-badge--event',
                                        default => 'admin-badge--news',
                                    };
                                @endphp
                                <span class="admin-badge {{ $badgeClass }}">{{ $row['type_label'] }}</span>
                            </td>
                            <td>{{ $row['category'] }}</td>
                            <td>{{ $row['created_at']->format('M d, Y') }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ $row['view_url'] }}" class="admin-btn admin-btn--icon admin-btn--primary" target="_blank" rel="noopener noreferrer" title="View on site" aria-label="View on site">
                                        <i class="material-icons" aria-hidden="true">visibility</i>
                                    </a>
                                    <a href="{{ $row['edit_url'] }}" class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ $row['destroy_url'] }}" class="admin-inline-form" onsubmit="return confirm('Delete this post?');">
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
                            <td colspan="5" class="admin-table__empty">No posts match your filters.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($dashboardPaginator->hasPages())
            <div class="admin-pagination-wrap">
                {{ $dashboardPaginator->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
