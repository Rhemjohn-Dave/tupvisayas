@extends('layouts.app')

<<<<<<< HEAD
@section('title', $post->title . ' - TIPTTO - TUP Visayas')

@section('head')
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($post->excerpt ?: $post->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if ($post->featured_image)
=======
@section('head')
    <meta property="og:title" content="{{ $post->title }}" />
    <meta property="og:description" content="{{ strip_tags(\Illuminate\Support\Str::limit($post->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($post->featured_image)
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        <meta property="og:image" content="{{ asset('storage/' . $post->featured_image) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
<<<<<<< HEAD
    <div class="section site-page site-page--article">
        <div class="news-layout">
            <article class="article-detail">
                <header class="article-detail__header">
                    <p class="article-detail__kicker">TUPV technology</p>
                    <span class="news-item__badge">TIPTTO</span>
                    <h1 class="article-detail__title">{{ $post->title }}</h1>
                    <div class="article-detail__meta">
                        <span>{{ $post->author->name ?? 'TIPTTO' }}</span>
                        <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">
                            {{ ($post->published_at ?? $post->created_at)->format('F j, Y') }}
                        </time>
                    </div>
                    @if ($post->excerpt)
                        <p class="article-detail__excerpt">{{ $post->excerpt }}</p>
                    @endif
                </header>

                @if ($post->featured_image)
                    <figure class="article-detail__media">
                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                            loading="lazy">
                    </figure>
                @endif

                <div class="article-detail__body site-prose">
                    {!! $post->content !!}
                </div>

                <footer class="article-detail__footer">
                    <div class="article-share">
                        <p class="article-share__title">Share this technology</p>
                        <div class="article-share__links">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" rel="noopener noreferrer">Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                target="_blank" rel="noopener noreferrer">Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}"
                                target="_blank" rel="noopener noreferrer">LinkedIn</a>
                        </div>
                    </div>
                    <p class="article-back">
                        <a href="{{ route('adre') }}#adre-products-heading">&larr; Back to TUPV technologies</a>
                    </p>
                </footer>
            </article>

            @include('pages.partials.adre_sidebar')
        </div>

        @if ($relatedPosts->count())
            <section class="article-more" aria-labelledby="more-tiptto-posts">
                <h2 id="more-tiptto-posts" class="site-section-title">More TUPV technologies</h2>
                <div class="article-more__list">
                    @foreach ($relatedPosts as $related)
                        <a class="article-more__item" href="{{ route('tiptto.post.show', $related->slug) }}">
                            @if ($related->featured_image)
                                <div class="article-more__media">
                                    <img src="{{ asset('storage/' . $related->featured_image) }}" alt=""
                                        loading="lazy">
                                </div>
                            @endif
                            <div class="article-more__body">
                                <time datetime="{{ ($related->published_at ?? $related->created_at)->toDateString() }}">
                                    {{ ($related->published_at ?? $related->created_at)->format('M j, Y') }}
                                </time>
                                <span>{{ $related->title }}</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        @endif
    </div>
@endsection
=======
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h2 style="color:#C41E3A;font-weight:800;text-align:left;margin-bottom:2rem;letter-spacing:1px;">TIPTTO Technologies
        </h2>
        <div class="row">
            <!-- Main TIPTTO Post Content -->
            <div class="col s12 m9">
                <div class="card" style="box-shadow: 0 4px 24px rgba(196,30,58,0.08); border-radius: 16px;">
                    @if($post->featured_image)
                        <div class="card-image" style="border-radius: 16px 16px 0 0; overflow: hidden;">
                            <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}"
                                style="max-height:340px;object-fit:cover;width:100%;">
                        </div>
                    @endif
                    <div class="card-content" style="padding:2.5rem 2rem 2rem 2rem;">
                        <span class="card-title"
                            style="color:#C41E3A;font-weight:700;font-size:2.1rem;">{{ $post->title }}</span>
                        <div style="margin: 1.5rem 0 0.5rem 0; border-bottom: 2px solid #C41E3A; width: 60px;"></div>
                        <div style="margin-bottom: 1.2rem; color: #888; font-size: 1rem;">
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">person</i>
                                {{ $post->author->name ?? 'TIPTTO' }}</span>
                            &nbsp;|&nbsp;
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">event</i>
                                {{ ($post->published_at ?? $post->created_at)->format('F d, Y') }}</span>
                        </div>
                        <div class="wysiwyg-content" style="font-size:1.15rem;line-height:1.7;color:#222;">
                            {!! $post->content !!}
                        </div>
                        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                            <h6 style="color: #C41E3A; margin-bottom: 15px;">Share this product:</h6>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn-small white-text" style="background:#3b5998;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($post->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#1da1f2;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($post->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#0077b5;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>LinkedIn</a>
                        </div>
                    </div>
                </div>
                <div class="center-align" style="margin-top:2rem;">
                    <a href="{{ route('adre') }}" class="btn grey" style="color: #fff !important;">Back to TIPTTO</a>
                </div>
            </div>

            <!-- Sidebar Quick Links -->
            <div class="col s12 m3">
                <div class="card" style="border-radius:10px;">
                    <div class="card-content">
                        <span class="card-title" style="font-size:1.1rem;color:#C41E3A;font-weight:700;">Quick Links</span>
                        <ul style="list-style:none;padding-left:0;margin:0;">
                            <li style="margin-bottom:8px;"><a href="{{ route('adre') }}#tiptto">TIPTTO Services</a></li>
                            <li style="margin-bottom:8px;"><a href="{{ route('adre') }}#research-programs">Research
                                    Programs</a></li>
                            <li style="margin-bottom:8px;"><a href="{{ route('adre') }}#extension-services">Extension
                                    Services</a></li>
                            <li style="margin-bottom:8px;"><a href="{{ route('adre') }}#contact-info">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
