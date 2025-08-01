@extends('layouts.app')

@section('head')
    <meta property="og:title" content="{{ $announcement->title }}" />
    <meta property="og:description" content="{{ strip_tags(Str::limit($announcement->content, 150)) }}" />
    <meta property="og:type" content="article" />
    <meta property="og:url" content="{{ url()->current() }}" />
    @if($announcement->picture)
        <meta property="og:image" content="{{ asset('storage/' . $announcement->picture) }}" />
    @else
        <meta property="og:image" content="{{ asset('images/tup-logo.png') }}" />
    @endif
@endsection

@section('content')
    <div class="section" style="max-width:1200px;margin:0 auto;">
        <div class="row">
            <!-- Main Announcement Content -->
            <div class="col s12 m9">
                <h2 style="color:#C41E3A;font-weight:800;text-align:left;margin-bottom:2rem;letter-spacing:1px;">University
                    Announcements</h2>
                @if($announcement->category)
                    <div style="margin-bottom:1rem;">
                        <span
                            style="display:inline-block;background:#C41E3A;color:#fff;font-weight:600;padding:4px 16px;border-radius:12px;font-size:1rem;letter-spacing:0.5px;">{{ $announcement->category->name }}</span>
                    </div>
                @endif
                <div class="card" style="box-shadow: 0 4px 24px rgba(196,30,58,0.08); border-radius: 16px;">
                    @if($announcement->picture)
                        <div class="card-image" style="border-radius: 16px 16px 0 0; overflow: hidden;">
                            <img src="{{ asset('storage/' . $announcement->picture) }}" alt="Announcement Image"
                                style="max-height:340px;object-fit:cover;width:100%;">
                        </div>
                    @endif
                    <div class="card-content" style="padding:2.5rem 2rem 2rem 2rem;">
                        <span class="card-title"
                            style="color:#C41E3A;font-weight:700;font-size:2.1rem;">{{ $announcement->title }}</span>
                        <div style="margin: 1.5rem 0 0.5rem 0; border-bottom: 2px solid #C41E3A; width: 60px;"></div>
                        <div style="margin-bottom: 1.2rem; color: #888; font-size: 1rem;">
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">person</i> TUP
                                Visayas</span>
                            &nbsp;|&nbsp;
                            <span><i class="material-icons tiny" style="vertical-align:middle;color:#C41E3A;">event</i>
                                {{ $announcement->created_at->format('F d, Y') }}</span>
                        </div>
                        <div class="announcement-content wysiwyg-content"
                            style="font-size:1.15rem;line-height:1.7;color:#222;">
                            {!! $announcement->content !!}
                        </div>
                        <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee;">
                            <h6 style="color: #C41E3A; margin-bottom: 15px;">Share this announcement:</h6>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}"
                                target="_blank" class="btn-small white-text" style="background:#3b5998;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Facebook</a>
                            <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($announcement->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#1da1f2;margin-right:8px;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>Twitter</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($announcement->title) }}"
                                target="_blank" class="btn-small white-text" style="background:#0077b5;"><i
                                    class="material-icons left" style="font-size:18px;">share</i>LinkedIn</a>
                        </div>
                    </div>
                </div>
                <div class="center-align" style="margin-top:2rem;">
                    <a href="{{ route('announcements.index') }}" class="btn grey" style="color: #fff !important;">Back to
                        Announcements</a>
                </div>
            </div>
            <!-- Categories + Search Sidebar -->
            <div class="col s12 m3">
                <form action="{{ route('announcements.index') }}" method="GET" style="margin-bottom: 1.5rem;">
                    <div class="input-field" style="margin-bottom:0;">
                        <input type="text" name="search" id="search" placeholder="Search announcements..."
                            value="{{ request('search') }}">
                        <button type="submit" class="btn red" style="margin-top:8px;">Search</button>
                    </div>
                </form>
                <div>
                    <h6 style="font-weight:700;letter-spacing:1px;">ANNOUNCEMENT CATEGORIES</h6>
                    <ul style="list-style:none;padding-left:0;">
                        <li style="margin-bottom:8px;">
                            <a href="{{ route('announcements.index') }}"
                                style="color:#222;text-decoration:underline;font-weight:{{ request('category') ? 'normal' : 'bold' }};">
                                All Announcements
                            </a>
                        </li>
                        @foreach($categories as $cat)
                            <li style="margin-bottom:8px;">
                                <a href="{{ route('announcements.index', ['category' => $cat->slug]) }}"
                                    style="color:#222;text-decoration:underline;font-weight:{{ request('category') == $cat->slug ? 'bold' : 'normal' }};">
                                    {{ $cat->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
                <!-- Related Announcements -->
                <div style="margin-top: 2rem;">
                    <h6 style="font-weight:700;letter-spacing:1px;color:#C41E3A;">RELATED ANNOUNCEMENTS</h6>
                    @php
                        $related = \App\Models\Announcement::where('id', '!=', $announcement->id)
                            ->where('category_id', $announcement->category_id)
                            ->orderBy('created_at', 'desc')
                            ->limit(3)
                            ->get();
                    @endphp
                    @foreach($related as $item)
                        <div style="margin-bottom: 1rem; padding: 0.5rem; border-left: 3px solid #C41E3A; background: #f9f9f9;">
                            <a href="{{ route('announcements.show', $item->slug) }}"
                                style="color:#C41E3A;font-weight:600;text-decoration:none;">
                                {{ $item->title }}
                            </a>
                            <div style="font-size:0.85rem;color:#888;margin-top:0.25rem;">
                                {{ $item->created_at->format('M d, Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection