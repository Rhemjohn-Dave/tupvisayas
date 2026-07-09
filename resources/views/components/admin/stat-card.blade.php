@props([
    'label',
    'value',
    'icon' => 'insights',
])

<<<<<<< HEAD
<div class="admin-stat-card mission-card">
=======
<div class="admin-stat-card">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
    <div class="admin-stat-card__icon" aria-hidden="true">
        <i class="material-icons">{{ $icon }}</i>
    </div>
    <div>
        <p class="admin-stat-card__label">{{ $label }}</p>
        <p class="admin-stat-card__value">{{ $value }}</p>
    </div>
</div>
