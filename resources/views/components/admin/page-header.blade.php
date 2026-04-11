@props([
    'title',
    'subtitle' => null,
])

<div class="admin-page-head">
    <div>
        <h1 class="admin-page-title">{{ $title }}</h1>
        @if($subtitle)
            <p class="admin-page-subtitle">{{ $subtitle }}</p>
        @endif
    </div>
    @isset($actions)
        <div class="admin-page-actions">
            {{ $actions }}
        </div>
    @endisset
</div>
