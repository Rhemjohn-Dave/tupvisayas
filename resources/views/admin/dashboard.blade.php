@extends('layouts.app')

@section('head')
    <style>
        .tabs .tab a.active {
            color: white !important;
        }

        .tabs .tab a:hover {
            color: white !important;
        }
    </style>
@endsection

@section('content')
    <div class="row" style="margin-bottom:0;">
        <!-- Sidebar -->
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <!-- Main Content -->
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div style="padding: 2rem 0 0 0;">
                <h3 style="color:#C41E3A; font-weight:700; margin-bottom:0.5rem;">Admin Dashboard</h3>
                <p style="font-size:1.1rem; color:#444; margin-bottom:1.5rem;">Welcome, Admin! Manage all your posts from
                    this dashboard.</p>
                @if(session('success'))
                    <div class="card-panel green lighten-4 green-text text-darken-4" style="border-radius:8px;">
                        {{ session('success') }}
                    </div>
                @endif
                <a href="{{ route('admin.posts.create') }}" class="btn waves-effect waves-light"
                    style="background-color:#C41E3A; margin-bottom:1.5rem; color: white !important;">
                    <i class="material-icons left">add</i>Create New Post
                </a>
                <div class="responsive-table" style="overflow-x:auto;">
                    <table class="striped highlight centered" style="border-radius:8px;overflow:hidden;">
                        <thead style="background:#f5f5f5;">
                            <tr style="font-weight:600;">
                                <th>Title</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Created</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($news as $item)
                                <tr>
                                    <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ Str::limit($item->title, 50) }}
                                    </td>
                                    <td><span
                                            style="background:#C41E3A;color:white;padding:4px 16px;border-radius:16px;font-weight:600;font-size:0.95rem;">News</span>
                                    </td>
                                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('news.show', $item->slug) }}"
                                            class="btn-small waves-effect waves-light" style="background:#C41E3A;"
                                            target="_blank" title="View"><i class="material-icons white-text">visibility</i></a>
                                        <a href="{{ route('admin.news.edit', $item->id) }}"
                                            class="btn-small waves-effect waves-light" style="background:#444;" title="Edit"><i
                                                class="material-icons white-text">edit</i></a>
                                        <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-small waves-effect waves-light"
                                                style="background:#888;"
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                title="Delete"><i class="material-icons white-text">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($announcements as $item)
                                <tr>
                                    <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ Str::limit($item->title, 50) }}
                                    </td>
                                    <td><span
                                            style="background:#C41E3A;color:white;padding:4px 16px;border-radius:16px;font-weight:600;font-size:0.95rem;">Announcement</span>
                                    </td>
                                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('announcements.show', $item->slug) }}"
                                            class="btn-small waves-effect waves-light" style="background:#C41E3A;"
                                            target="_blank" title="View"><i class="material-icons white-text">visibility</i></a>
                                        <a href="{{ route('admin.announcements.edit', $item->id) }}"
                                            class="btn-small waves-effect waves-light" style="background:#444;" title="Edit"><i
                                                class="material-icons white-text">edit</i></a>
                                        <form method="POST" action="{{ route('admin.announcements.destroy', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-small waves-effect waves-light"
                                                style="background:#888;"
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                title="Delete"><i class="material-icons white-text">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($jobs as $item)
                                <tr>
                                    <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ Str::limit($item->title, 50) }}
                                    </td>
                                    <td><span
                                            style="background:#C41E3A;color:white;padding:4px 16px;border-radius:16px;font-weight:600;font-size:0.95rem;">Job</span>
                                    </td>
                                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('jobs.show', $item->slug) }}"
                                            class="btn-small waves-effect waves-light" style="background:#C41E3A;"
                                            target="_blank" title="View"><i class="material-icons white-text">visibility</i></a>
                                        <a href="{{ route('admin.jobs.edit', $item->id) }}"
                                            class="btn-small waves-effect waves-light" style="background:#444;" title="Edit"><i
                                                class="material-icons white-text">edit</i></a>
                                        <form method="POST" action="{{ route('admin.jobs.destroy', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-small waves-effect waves-light"
                                                style="background:#888;"
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                title="Delete"><i class="material-icons white-text">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @foreach($events as $item)
                                <tr>
                                    <td style="max-width:220px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                                        {{ Str::limit($item->title, 50) }}
                                    </td>
                                    <td><span
                                            style="background:#C41E3A;color:white;padding:4px 16px;border-radius:16px;font-weight:600;font-size:0.95rem;">Event</span>
                                    </td>
                                    <td>{{ $item->category ? $item->category->name : '-' }}</td>
                                    <td>{{ $item->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <a href="{{ route('events.show', $item->slug) }}"
                                            class="btn-small waves-effect waves-light" style="background:#C41E3A;"
                                            target="_blank" title="View"><i class="material-icons white-text">visibility</i></a>
                                        <a href="{{ route('admin.events.edit', $item->id) }}"
                                            class="btn-small waves-effect waves-light" style="background:#444;" title="Edit"><i
                                                class="material-icons white-text">edit</i></a>
                                        <form method="POST" action="{{ route('admin.events.destroy', $item->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-small waves-effect waves-light"
                                                style="background:#888;"
                                                onclick="return confirm('Are you sure you want to delete this post?')"
                                                title="Delete"><i class="material-icons white-text">delete</i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.tabs');
            M.Tabs.init(elems);
        });
    </script>
@endsection