---
name: tupv-institutional-design
description: >-
  Applies TUP Visayas institutional layout and design — acad-hero, sit-section,
  acad-cta, brand tokens, and Blade page recipes. Use when building or restyling
  public Blade pages, editing site.css/custom.css, doing institutional redesign,
  or when the user mentions campus UI, TUP Visayas look, or matching existing pages.
---

# TUP Visayas institutional design

## When to use

Read this skill before adding or restyling public pages so the result matches the campus site, not a generic AI layout.

## Source of truth

| File | Role |
|------|------|
| `resources/views/layouts/app.blade.php` | Shell, CSS/JS stack, yields |
| `resources/views/layouts/partials/site-navigation.blade.php` | Nav / brand / drawer |
| `resources/views/layouts/partials/site-footer.blade.php` | Footer |
| `public/css/site.css` | Tokens (`:root`) + components |
| `public/css/custom.css` | Materialize → brand bridges only |
| `resources/views/pages/sit.blade.php` | Canonical full-bleed recipe |
| `resources/views/pages/home.blade.php` | Home `.home-*` pattern |
| `resources/views/pages/facilities.blade.php` | Contained `.site-page` pattern |

## Brand tokens

| Token / role | Value |
|--------------|--------|
| Brand / cardinal | `--color-brand` `#9e1b32` |
| Brand hover | `--color-brand-hover` `#7a1528` |
| On brand | `--color-on-brand` `#ffffff` |
| Text / muted | `#1a1a1a` / `#5c5c5c` |
| Surface / alt | `#ffffff` / `#f6f6f4` |
| Muted sections | `#f4f2f0` (`.sit-section--muted`) |
| Gold badge / accent | `#f3e4a8`, text `#5c4810` |
| Type | Inter only — `--font-sans` / `--font-display` |
| Content max | `--content-max` `75rem` |

## Page patterns

### Full-bleed marketing (SIT, academics hub, campus tour, HR, admissions)

```
@section('main_class', 'site-main--full')

.site-page.site-page--*
  .acad-hero (badge, title, lede, actions)
  .sit-section / .sit-section--muted  (alternate)
  .acad-cta
```

- Section inner: `.sit-section__inner` (~72rem); narrow prose: `--narrow` (~46rem)
- Headers: `.sit-eyebrow` + `.sit-section__title` + `.sit-section__lede`
- Use `aria-labelledby` on sections

### Contained content (facilities, contact, simple about)

- Default `main_class` (Materialize `container`)
- `.site-page` + `.site-page-title` (+ `--center` if needed) + `.site-page-intro`
- Prefer existing lists/prose; link out with `.acad-btn` or established program CTAs

### Homepage

- Use `.home-hero` / `.home-section` / `.home-eyebrow` — do not force `acad-hero` onto home

## Buttons

Use `.acad-btn` only:

| Class | Use |
|-------|-----|
| `--primary` | Main action (brand fill) |
| `--ghost` | Secondary on light |
| `--on-dark` | Primary on `.acad-cta` |
| `--outline-light` | Secondary on `.acad-cta` |

Page-family variants (`home-hero__cta`, `college-btn--gold`, `adm-btn`) only inside those page families.

## Canonical class checklist

`site-main--full`, `site-page`, `acad-hero`, `acad-hero__badge`, `acad-hero__title`, `acad-hero__lede`, `acad-hero__actions`, `acad-btn`, `acad-cta`, `sit-section`, `sit-section--muted`, `sit-eyebrow`, `sit-section__title`, `sit-section__lede`, `sit-section__inner`

## New marketing page skeleton

```blade
@extends('layouts.app')

@section('title', 'Page title - TUP Visayas')
@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'One sentence institutional description.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Page title - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--example">
        <section class="acad-hero" aria-labelledby="example-hero-heading">
            <p class="acad-hero__badge">Office or theme</p>
            <h1 id="example-hero-heading" class="acad-hero__title">Page title</h1>
            <p class="acad-hero__lede">One short supporting sentence.</p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#example-main">Primary action</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('contact') }}">Contact</a>
            </div>
        </section>

        <section class="sit-section" id="example-main" aria-labelledby="example-main-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section label</p>
                    <h2 id="example-main-heading" class="sit-section__title">Section title</h2>
                    <p class="sit-section__lede">One short supporting sentence.</p>
                </header>
                {{-- content --}}
            </div>
        </section>

        <section class="sit-section sit-section--muted" aria-labelledby="example-alt-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Next topic</p>
                    <h2 id="example-alt-heading" class="sit-section__title">Alternate section</h2>
                </header>
                {{-- content --}}
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="example-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="example-cta-heading" class="acad-cta__title">Closing call to action</h2>
                <p class="acad-cta__lede">One short next-step sentence.</p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('contact') }}">Contact us</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('home') }}">Back to home</a>
                </div>
            </div>
        </section>
    </div>
@endsection
```

Add page-specific CSS in `public/css/site.css` under a clear comment block; reuse tokens — do not hardcode random palettes.

## Do

- Match voice: TUP Visayas, colleges, SIT, admissions, institutional offices
- One composition / one job per section; brand-forward heroes
- Alternate muted sections for rhythm
- Prefer real campus imagery over abstract gradients as the main visual
- Preserve accessibility: skip link already in layout; label sections; focusable controls

## Do not

- Treat Materialize teal/default chrome as the design system
- Introduce purple/indigo gradients, glow effects, cream+terracotta AI defaults, or dark-mode-first looks
- Put cards, stats strips, or promo chips in the hero
- Nest full-bleed marketing pages in the default container without `site-main--full`
- Invent a second button system or a second typeface
- Restyle admin (`admin.css`) with public marketing patterns unless asked
