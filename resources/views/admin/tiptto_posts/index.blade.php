@extends('layouts.admin')

@section('title', 'TIPTTO Posts Management')

@section('admin_content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m6">
                                <h4 class="card-title">TIPTTO Posts</h4>
                            </div>
                            <div class="col s12 m6 right-align">
                                <a href="{{ route('admin.tiptto_posts.create') }}" class="btn cardinal-red white-text">
                                    <i class="material-icons left">add</i>
                                    Create New Post
                                </a>
                            </div>
                        </div>

                        @if(session('success'))
                            <div class="card-panel green lighten-4 green-text text-darken-4">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col s12">
                                <table class="striped responsive-table">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                            <th>Created</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($posts as $post)
                                            <tr>
                                                <td>
                                                    <strong>{{ $post->title }}</strong>
                                                    @if($post->featured_image)
                                                        <i class="material-icons tiny green-text">image</i>
                                                    @endif
                                                </td>
                                                <td>{{ $post->author->name ?? 'Unknown' }}</td>
                                                <td>
                                                    @if($post->is_published)
                                                        <span class="badge green white-text">Published</span>
                                                    @else
                                                        <span class="badge orange white-text">Draft</span>
                                                    @endif
                                                </td>
                                                <td>{{ $post->created_at->format('M j, Y') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.tiptto_posts.show', $post) }}"
                                                        class="btn-small blue white-text">
                                                        <i class="material-icons tiny">visibility</i>
                                                    </a>
                                                    <a href="{{ route('admin.tiptto_posts.edit', $post) }}"
                                                        class="btn-small orange white-text">
                                                        <i class="material-icons tiny">edit</i>
                                                    </a>
                                                    <form method="POST"
                                                        action="{{ route('admin.tiptto_posts.destroy', $post) }}"
                                                        style="display: inline-block;"
                                                        onsubmit="return confirm('Are you sure you want to delete this post?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn-small red white-text">
                                                            <i class="material-icons tiny">delete</i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="center-align">
                                                    <p class="grey-text">No TIPTTO posts found.</p>
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Pagination -->
                        <div class="center-align" style="margin-top: 20px;">
                            {{ $posts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .cardinal-red {
            background-color: #C41E3A !important;
        }

        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .btn-small {
            padding: 0 8px;
            margin: 0 2px;
            min-width: 32px;
            height: 32px;
            line-height: 32px;
        }
    </style>
@endsection