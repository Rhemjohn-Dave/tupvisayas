{{--
  Collapsible sidebar block: chevron rotates with .is-expanded (animated via CSS).
  Set :open when any child route is active so users land in the right section.
--}}
@props([
    'title',
    'icon',
    'groupId',
    'open' => false,
])

@php
    $panelId = $groupId . '-panel';
    $btnId = $groupId . '-btn';
@endphp

<div
    class="admin-sidebar__group {{ $open ? 'is-expanded' : '' }}"
    data-sidebar-group
    data-group-id="{{ $groupId }}"
>
    <button
        type="button"
        class="admin-sidebar__group-toggle"
        id="{{ $btnId }}"
        aria-expanded="{{ $open ? 'true' : 'false' }}"
        aria-controls="{{ $panelId }}"
        title="{{ $title }}"
    >
        <span class="material-symbols-outlined admin-sidebar__icon admin-sidebar__icon--group" aria-hidden="true">{{ $icon }}</span>
        <span class="admin-sidebar__group-label">{{ $title }}</span>
        <span class="material-symbols-outlined admin-sidebar__chevron" aria-hidden="true">expand_more</span>
    </button>
    <div class="admin-sidebar__group-panel" id="{{ $panelId }}" role="region" aria-labelledby="{{ $btnId }}">
        <div class="admin-sidebar__group-panel-inner" data-sidebar-group-panel-inner @unless($open) inert @endunless>
            <ul class="admin-sidebar__list admin-sidebar__list--nested">
                {{ $slot }}
            </ul>
        </div>
    </div>
</div>
