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
    <div class="section">
        <h3 style="color:#C41E3A; font-weight:700;">Admin Dashboard</h3>
        <p>Welcome, Admin! Manage all your posts from this dashboard.</p>
        
        @if(session('success'))
            <div class="card-panel green lighten-4 green-text text-darken-4">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('admin.posts.create') }}" class="btn waves-effect waves-light"
            style="background-color:#C41E3A; margin-top:1.5rem; color: white !important;">
            <i class="material-icons left">add</i>Create New Post
        </a>

        <!-- Posts Table -->
        <div class="card" style="margin-top: 2rem;">
            <div class="card-content">
                <span class="card-title" style="color:#C41E3A;">All Posts</span>
                
                <!-- Tabs for different post types -->
                <div class="row">
                    <div class="col s12">
                        <ul class="tabs">
                            <li class="tab col s3"><a href="#news" class="active">News</a></li>
                            <li class="tab col s3"><a href="#announcements">Announcements</a></li>
                            <li class="tab col s3"><a href="#jobs">Jobs</a></li>
                            <li class="tab col s3"><a href="#events">Events</a></li>
                        </ul>
                    </div>

                    <!-- News Tab -->
                    <div id="news" class="col s12">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($news as $item)
                                    <tr>
                                        <td>{{ Str::limit($item->title, 50) }}</td>
                                        <td><span class="chip blue white-text">News</span></td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('news.show', $item->id) }}" class="btn-small waves-effect waves-light blue" target="_blank">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('admin.news.edit', $item->id) }}" class="btn-small waves-effect waves-light orange">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.news.destroy', $item->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-small waves-effect waves-light red" onclick="return confirm('Are you sure you want to delete this post?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="center-align grey-text">No news posts found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Announcements Tab -->
                    <div id="announcements" class="col s12">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($announcements as $item)
                                    <tr>
                                        <td>{{ Str::limit($item->title, 50) }}</td>
                                        <td><span class="chip green white-text">Announcement</span></td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('announcements.show', $item->id) }}" class="btn-small waves-effect waves-light blue" target="_blank">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('admin.announcements.edit', $item->id) }}" class="btn-small waves-effect waves-light orange">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.announcements.destroy', $item->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-small waves-effect waves-light red" onclick="return confirm('Are you sure you want to delete this post?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="center-align grey-text">No announcement posts found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Jobs Tab -->
                    <div id="jobs" class="col s12">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($jobs as $item)
                                    <tr>
                                        <td>{{ Str::limit($item->title, 50) }}</td>
                                        <td><span class="chip purple white-text">Job</span></td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('jobs.show', $item->id) }}" class="btn-small waves-effect waves-light blue" target="_blank">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('admin.jobs.edit', $item->id) }}" class="btn-small waves-effect waves-light orange">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.jobs.destroy', $item->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-small waves-effect waves-light red" onclick="return confirm('Are you sure you want to delete this post?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="center-align grey-text">No job posts found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Events Tab -->
                    <div id="events" class="col s12">
                        <table class="striped responsive-table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($events as $item)
                                    <tr>
                                        <td>{{ Str::limit($item->title, 50) }}</td>
                                        <td><span class="chip red white-text">Event</span></td>
                                        <td>{{ $item->created_at->format('M d, Y') }}</td>
                                        <td>
                                            <a href="{{ route('events.show', $item->id) }}" class="btn-small waves-effect waves-light blue" target="_blank">
                                                <i class="material-icons">visibility</i>
                                            </a>
                                            <a href="{{ route('admin.events.edit', $item->id) }}" class="btn-small waves-effect waves-light orange">
                                                <i class="material-icons">edit</i>
                                            </a>
                                            <form method="POST" action="{{ route('admin.events.destroy', $item->id) }}" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-small waves-effect waves-light red" onclick="return confirm('Are you sure you want to delete this post?')">
                                                    <i class="material-icons">delete</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="center-align grey-text">No event posts found</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('.tabs');
            M.Tabs.init(elems);
        });
    </script>
@endsection