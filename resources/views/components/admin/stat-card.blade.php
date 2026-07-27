@props([
    'label',
    'value',
    'icon' => 'insights',
    'tone' => 'rose',
    'trend' => null,
])

<div class="admin-stat-card mission-card">
    <div class="admin-stat-card__icon admin-stat-card__icon--{{ $tone }}" aria-hidden="true">
        <i class="material-icons">{{ $icon }}</i>
    </div>
    <div class="admin-stat-card__body">
        @if ($trend)
            <span class="admin-stat-card__trend">{{ $trend }}</span>
        @endif
        <p class="admin-stat-card__label">{{ $label }}</p>
        <p class="admin-stat-card__value">{{ $value }}</p>
    </div>
</div>
