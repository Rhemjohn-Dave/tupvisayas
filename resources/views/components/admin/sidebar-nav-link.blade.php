{{--
  Primary / nested nav row: Material Symbols outlined + label.
  Pass optional Tailwind/extra classes via class="..." (merged below).
--}}
@props([
    'href',
    'label',
    'icon',
    'active' => false,
])

<a
    href="{{ $href }}"
    {{ $attributes->class(['admin-sidebar__link', 'is-active' => $active]) }}
    @if($active) aria-current="page" @endif
    title="{{ $label }}"
>
    <span class="material-symbols-outlined admin-sidebar__icon" aria-hidden="true">{{ $icon }}</span>
    <span class="admin-sidebar__label-text">{{ $label }}</span>
</a>
