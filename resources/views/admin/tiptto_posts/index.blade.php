@extends('layouts.admin')

@section('title', 'Admin — TIPTTO posts')

@section('admin_content')
    <x-admin.page-header title="TIPTTO posts" subtitle="Research and extension articles for the TIPTTO section.">
        <x-slot name="actions">
            <a href="{{ route('admin.tiptto_posts.create') }}" class="admin-btn admin-btn--primary">
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
                                @if($post->featured_image)
                                    <i class="material-icons" style="font-size:16px;vertical-align:middle;color:var(--admin-accent);" title="Has featured image" aria-hidden="true">image</i>
                                @endif
                            </td>
                            <td>{{ $post->author->name ?? '—' }}</td>
                            <td>
                                @if($post->is_published)
                                    <span class="admin-badge admin-badge--published">Published</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">Draft</span>
                                @endif
                            </td>
                            <td>{{ $post->created_at->format('M j, Y') }}</td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.tiptto_posts.show', $post) }}" class="admin-btn admin-btn--icon admin-btn--accent" title="View" aria-label="View">
                                        <i class="material-icons" aria-hidden="true">visibility</i>
                                    </a>
                                    <a href="{{ route('admin.tiptto_posts.edit', $post) }}" class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form method="POST" action="{{ route('admin.tiptto_posts.destroy', $post) }}" class="admin-inline-form" onsubmit="return confirm('Delete this post?');">
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
                            <td colspan="5" class="admin-table__empty">No TIPTTO posts found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($posts->hasPages())
            <div class="admin-pagination-wrap">
                {{ $posts->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
