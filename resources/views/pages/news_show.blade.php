@extends('layouts.app')

@section('content')
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <h2 style="color:#C41E3A;font-weight:800;text-align:left;margin-bottom:2rem;letter-spacing:1px;">University News
        </h2>
        <div class="row">
            <!-- Main News Content -->
            <div class="col s12 m9">
                @if($news->category)
                    <div style="text-align:center;margin-bottom:1rem;">
                        <span
                            style="display:inline-block;background:#C41E3A;color:#fff;font-weight:600;padding:4px 16px;border-radius:12px;font-size:1rem;letter-spacing:0.5px;">{{ $news->category->name }}</span>
                    </div>
                @endif
                <div class="card" style="box-shadow: 0 4px 24px rgba(196,30,58,0.08); border-radius: 16px;">
                    @if($news->picture)
                        <div class="card-image" style="border-radius: 16px 16px 0 0; overflow: hidden;">
                            <img src="{{ asset('storage/' . $news->picture) }}" alt="News Image"
                                style="max-height:340px;object-fit:cover;width:100%;">
                        </div>
                    @endif
                    <div class="card-content" style="padding:2.5rem 2rem 2rem 2rem;">
                        <span class="card-title"
                            style="color:#C41E3A;font-weight:700;font-size:2.1rem;">{{ $news->title }}</span>
                        <div style="margin: 1.5rem 0 0.5rem 0; border-bottom: 2px solid #C41E3A; width: 60px;"></div>
                        <div style="margin-bottom: 1.2rem; color: #888; font-size: 1rem;">
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">person</i> TUP
                                Visayas</span>
                            &nbsp;|&nbsp;
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">event</i>
                                {{ $news->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="news-content wysiwyg-content" style="font-size:1.15rem;line-height:1.7;color:#222;">
                            {!! $news->content !!}
                        </div>
                        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                            <h6 style="color: #C41E3A; margin-bottom: 15px;">Share this news:</h6>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn-small white-text" style="background:#3b5998;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($news->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#1da1f2;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($news->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#0077b5;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>LinkedIn</a>
                        </div>
                    </div>
                </div>
                <div class="center-align" style="margin-top:2rem;">
                    <a href="{{ route('news_events') }}" class="btn grey" style="color: #fff !important;">Back to News &
                        Events</a>
                </div>
            </div>
            <!-- Categories + Search -->
            <div class="col s12 m3">
                <form action="{{ route('news_events') }}" method="GET" style="margin-bottom: 1.5rem;">
                    <div class="input-field" style="margin-bottom:0;">
                        <input type="text" name="search" id="search" placeholder="Search news..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn red" style="margin-top:8px;">Search</button>
                    </div>
                </form>
                <div>
                    <h6 style="font-weight:700;letter-spacing:1px;">NEWS CATEGORIES</h6>
                    <ul style="list-style:none;padding-left:0;">
                        @foreach($categories as $category)
                            <li style="margin-bottom:8px;">
                                <a href="{{ route('news_events', ['category' => $category->slug]) }}"
                                    style="color:#222;text-decoration:underline;">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="section" style="max-width: 900px; margin: 2rem auto 0 auto;">
        <h5 style="color:#C41E3A;font-weight:700;">Popular Updates</h5>
        <div class="row">
            @php
                $popular = \App\Models\News::orderBy('created_at', 'desc')->limit(3)->get();
            @endphp
            @foreach($popular as $item)
                <div class="col s12 m4">
                    <div class="card hoverable" style="border-radius:10px;">
                        @if($item->picture)
                            <div class="card-image" style="border-radius:10px 10px 0 0;overflow:hidden;">
                                <img src="{{ asset('storage/' . $item->picture) }}" alt="Popular News Image"
                                    style="height:120px;object-fit:cover;width:100%;">
                            </div>
                        @endif
                        <div class="card-content" style="padding:1rem;">
                            <span class="card-title"
                                style="font-size:1.1rem;color:#C41E3A;font-weight:600;">{{ $item->title }}</span>
                            <div style="font-size:0.95rem;color:#888;">{{ $item->created_at->format('M d, Y') }}</div>
                        </div>
                        <div class="card-action" style="padding:0 1rem 1rem 1rem;">
                            <a href="{{ route('news.show', $item->slug) }}" class="red-text">Read More</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection