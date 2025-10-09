@extends('layouts.admin')

@section('title', 'View TIPTTO Post')

@section('admin_content')
    <div class="container">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m8">
                                <h4 class="card-title">{{ $tipttoPost->title }}</h4>
                            </div>
                            <div class="col s12 m4 right-align">
                                <a href="{{ route('admin.tiptto_posts.edit', $tipttoPost) }}" class="btn orange white-text">
                                    <i class="material-icons left">edit</i>
                                    Edit
                                </a>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <p class="grey-text">
                                    <i class="material-icons tiny">person</i>
                                    By {{ $tipttoPost->author->name ?? 'Unknown' }}
                                    <span style="margin: 0 10px;">•</span>
                                    <i class="material-icons tiny">schedule</i>
                                    Created: {{ $tipttoPost->created_at->format('F j, Y g:i A') }}
                                    @if($tipttoPost->updated_at != $tipttoPost->created_at)
                                        <span style="margin: 0 10px;">•</span>
                                        <i class="material-icons tiny">update</i>
                                        Updated: {{ $tipttoPost->updated_at->format('F j, Y g:i A') }}
                                    @endif
                                </p>

                                <p>
                                    Status:
                                    @if($tipttoPost->is_published)
                                        <span class="badge green white-text">Published</span>
                                        @if($tipttoPost->published_at)
                                            on {{ $tipttoPost->published_at->format('F j, Y g:i A') }}
                                        @endif
                                    @else
                                        <span class="badge orange white-text">Draft</span>
                                    @endif
                                </p>
                            </div>
                        </div>

                        @if($tipttoPost->excerpt)
                            <div class="row">
                                <div class="col s12">
                                    <h6>Excerpt:</h6>
                                    <p class="grey-text text-darken-2">{{ $tipttoPost->excerpt }}</p>
                                </div>
                            </div>
                        @endif

                        @if($tipttoPost->featured_image)
                            <div class="row">
                                <div class="col s12">
                                    <h6>Featured Image:</h6>
                                    <img src="{{ asset('storage/' . $tipttoPost->featured_image) }}"
                                        alt="{{ $tipttoPost->title }}" class="responsive-img" style="max-width: 400px;">
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col s12">
                                <h6>Content:</h6>
                                <div class="post-content"
                                    style="border: 1px solid #e0e0e0; padding: 20px; border-radius: 4px;">
                                    {!! $tipttoPost->content !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col s12">
                                <a href="{{ route('admin.tiptto_posts.index') }}" class="btn grey white-text">
                                    <i class="material-icons left">arrow_back</i>
                                    Back to Posts
                                </a>
                                <a href="{{ route('tiptto.post.show', $tipttoPost->slug) }}" class="btn blue white-text"
                                    target="_blank">
                                    <i class="material-icons left">open_in_new</i>
                                    View on Website
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .badge {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.8rem;
        }

        .post-content h1,
        .post-content h2,
        .post-content h3,
        .post-content h4,
        .post-content h5,
        .post-content h6 {
            color: #C41E3A;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .post-content p {
            margin-bottom: 15px;
        }

        .post-content ul,
        .post-content ol {
            margin-bottom: 15px;
            padding-left: 30px;
        }

        .post-content li {
            margin-bottom: 5px;
        }

        .post-content img {
            max-width: 100%;
            height: auto;
            margin: 10px 0;
        }
    </style>
@endsection