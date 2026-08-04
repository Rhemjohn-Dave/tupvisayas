@props(['type'])

@php
    $specs = [
        'carousel' => [
            'ratio' => '21:9 (desktop), 16:10 (mobile)',
            'size' => '1920 × 823 px (or 1920 × 520 px with centered subject)',
            'format' => 'JPG or PNG',
            'max' => '2 MB',
            'tips' => [
                'Used full-width on the homepage hero.',
                'Images are cropped with cover — keep faces and text in the center.',
            ],
        ],
        'college-cover' => [
            'ratio' => '3:1 to 16:9 landscape',
            'size' => '1920 × 640 px recommended',
            'format' => 'JPG or PNG',
            'max' => '4 MB (compress before upload)',
            'tips' => [
                'Shown at the top of each college academics page.',
                'Wide banner; max display height is 420 px.',
                'Phone photos are often 8–12 MB — export/compress to under 4 MB first.',
            ],
        ],
        'article' => [
            'ratio' => '4:3 (listings), 16:9 (article page)',
            'size' => '800 × 600 px for listings · 1600 × 900 px for best article quality',
            'format' => 'JPG or PNG',
            'max' => '2 MB',
            'tips' => [
                'Used on news & events listings and the article header.',
                'Landscape photos work best; edges may be cropped.',
            ],
        ],
        'tiptto-featured' => [
            'ratio' => '4:3 (listings), 16:9 (post page)',
            'size' => '800 × 600 px for listings · 1600 × 900 px for the post header',
            'format' => 'JPG, PNG, or WebP',
            'max' => '4 MB',
            'tips' => [
                'Shown on the ADRE technologies list and the TIPTTO post page.',
                'Center the product or subject; wide images are cropped.',
            ],
        ],
        'director-post-featured' => [
            'ratio' => '4:3 (listings), 16:9 (post page)',
            'size' => '800 × 600 px for listings · 1600 × 900 px for the post header',
            'format' => 'JPG, PNG, or WebP',
            'max' => '4 MB',
            'tips' => [
                'Shown on the Director\'s Corner list and the article page.',
                'Landscape photos work best for news and blog posts.',
            ],
        ],
        'official' => [
            'ratio' => '1:1 square',
            'size' => '600 × 600 px',
            'format' => 'JPG or PNG',
            'max' => '2 MB',
            'tips' => [
                'Head-and-shoulders portrait on the Officials page.',
                'Displayed as a square; face should be centered.',
            ],
        ],
        'faculty' => [
            'ratio' => '1:1 square',
            'size' => '400 × 400 px (300 × 300 px minimum)',
            'format' => 'JPG or PNG',
            'max' => '4 MB',
            'tips' => [
                'Small faculty card photo on college department pages.',
                'Use a clear headshot with the face centered.',
            ],
        ],
        'course-logo' => [
            'ratio' => '1:1 square',
            'size' => '512 × 512 px PNG recommended',
            'format' => 'PNG (transparent) or JPG',
            'max' => '4 MB',
            'tips' => [
                'Shown in a 120 × 120 px box; the full logo is kept visible.',
                'Leave padding around the logo — nothing is cropped.',
                'SVG uploads are not allowed (security). Use PNG with transparency.',
            ],
        ],
        'org-logo' => [
            'ratio' => '1:1 square',
            'size' => '512 × 512 px PNG recommended',
            'format' => 'PNG (transparent) or JPG',
            'max' => '4 MB',
            'tips' => [
                'Student organization logo on the college page.',
                'Square format; entire logo stays visible (not cropped).',
                'SVG uploads are not allowed (security). Use PNG with transparency.',
            ],
        ],
        'sit-partner' => [
            'ratio' => '1:1 square or wide logo',
            'size' => '512 × 512 px (or 640 × 320 px for horizontal logos)',
            'format' => 'PNG (transparent) or JPG / WebP',
            'max' => '2 MB',
            'tips' => [
                'Shown on the public SIT industry partners grid.',
                'Logo is contained (not cropped) inside the card.',
                'Prefer transparent PNG for clean placement on white.',
            ],
        ],
        'sit-gallery' => [
            'ratio' => '4:3 landscape',
            'size' => '1200 × 900 px recommended',
            'format' => 'JPG, PNG, or WebP',
            'max' => '4 MB',
            'tips' => [
                'Student experience photos on the public SIT page.',
                'Landscape photos work best; images use cover crop.',
                'Only upload photos with student / company consent.',
            ],
        ],
    ];

    $spec = $specs[$type] ?? null;
@endphp

@if ($spec)
    <div {{ $attributes->merge(['class' => 'admin-image-spec']) }} role="note" aria-label="Image upload guidelines">
        <p class="admin-image-spec__title">Image guidelines</p>
        <dl class="admin-image-spec__list">
            <div class="admin-image-spec__item">
                <dt>Aspect ratio</dt>
                <dd>{{ $spec['ratio'] }}</dd>
            </div>
            <div class="admin-image-spec__item">
                <dt>Recommended size</dt>
                <dd>{{ $spec['size'] }}</dd>
            </div>
            <div class="admin-image-spec__item">
                <dt>Format</dt>
                <dd>{{ $spec['format'] }}</dd>
            </div>
            <div class="admin-image-spec__item">
                <dt>Max upload</dt>
                <dd>{{ $spec['max'] }}</dd>
            </div>
        </dl>
        @if (!empty($spec['tips']))
            <ul class="admin-image-spec__tips">
                @foreach ($spec['tips'] as $tip)
                    <li>{{ $tip }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endif
