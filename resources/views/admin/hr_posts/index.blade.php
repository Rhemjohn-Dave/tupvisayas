@extends('layouts.admin')

@section('title', 'Admin — HR posts')

@section('admin_content')
    <x-admin.page-header title="Human Resources posts"
        subtitle="Announcements and COA Sec. 13 programs (seminar, conference, training, oath taking).">
        <x-slot name="actions">
            <a href="{{ route('admin.hr_posts.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                New post
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Type</th>
                        <th scope="col">Department</th>
                        <th scope="col">Author</th>
                        <th scope="col">Status</th>
                        <th scope="col">Created</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($posts as $post)
                        <tr>
                            <td class="admin-table__cell-title" title="{{ $post->title }}">
                                {{ Str::limit($post->title, 48) }}
                                @if ($post->featured_image)
                                    <i class="material-icons" style="font-size:16px;vertical-align:middle;color:var(--admin-accent);"
                                        title="Has featured image" aria-hidden="true">image</i>
                                @endif
                                @if ($post->report_file)
                                    <i class="material-icons" style="font-size:16px;vertical-align:middle;color:var(--admin-accent);"
                                        title="Has report PDF" aria-hidden="true">picture_as_pdf</i>
                                @endif
                            </td>
                            <td>
                                <span class="admin-badge {{ $post->isProgram() ? 'admin-badge--job' : 'admin-badge--news' }}">
                                    {{ $post->type_label }}
                                </span>
                            </td>
                            <td>{{ $post->department->name ?? '—' }}</td>
                            <td>{{ $post->author->name ?? '—' }}</td>
                            <td>
                                @if ($post->is_published)
                                    <span class="admin-badge admin-badge--published">Published</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('M j, Y') }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    @if ($post->is_published)
                                        <a href="{{ route('human-resources.post.show', $post->slug) }}"
                                            class="admin-btn admin-btn--icon admin-btn--accent" title="View public"
                                            aria-label="View public" target="_blank" rel="noopener noreferrer">
                                            <i class="material-icons" aria-hidden="true">open_in_new</i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.hr_posts.edit', $post) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit"
                                        aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.hr_posts.destroy', $post) }}"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this post?');">
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
                            <td colspan="7" class="admin-table__empty">No HR posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($posts->hasPages())
            <div class="admin-pagination-wrap">
                {{ $posts->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
