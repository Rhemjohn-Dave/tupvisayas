@props([
    'title',
    'subtitle' => null,
])

<div class="admin-page-head">
    <div>
<<<<<<< HEAD
        <h1 class="site-page-title admin-page-title">{{ $title }}</h1>
        @if($subtitle)
            <p class="site-page-intro admin-page-subtitle">{{ $subtitle }}</p>
=======
        <h1 class="admin-page-title">{{ $title }}</h1>
        @if($subtitle)
            <p class="admin-page-subtitle">{{ $subtitle }}</p>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
        @endif
    </div>
    @isset($actions)
        <div class="admin-page-actions">
            {{ $actions }}
        </div>
    @endisset
</div>
