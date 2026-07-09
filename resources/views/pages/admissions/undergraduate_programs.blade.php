<<<<<<< HEAD
@php use Illuminate\Support\Str; @endphp
@extends('layouts.app')

@section('content')
    <div class="section site-page site-page--programs ug-programs">
        <h1 class="site-page-title site-page-title--center">Undergraduate programs</h1>
        <p class="site-page-intro">Degree programs offered by each college at TUP Visayas.</p>

        @forelse ($colleges as $college)
            <section class="ug-college" aria-labelledby="college-{{ Str::slug($college->college) }}">
                <h2 id="college-{{ Str::slug($college->college) }}" class="site-section-title">{{ $college->college }}</h2>

                @if ($college->courses->count() > 0)
                    <div class="programs-grid">
                        @foreach ($college->courses as $course)
                            <article class="program-card">
                                <div class="program-card__head">
                                    @if ($course->logo)
                                        <img class="program-card__logo" src="{{ asset('storage/' . $course->logo) }}"
                                            alt="{{ $course->name }} logo" loading="lazy">
=======
@extends('layouts.app')

@section('head')
    <style>
        .college-section {
            margin-bottom: 3rem;
        }

        .college-title {
            color: #C41E3A;
            font-weight: 700;
            font-size: 1.75rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 3px solid #C41E3A;
        }

        .programs-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .program-card {
            background: #fff;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .program-card:hover {
            box-shadow: 0 4px 12px rgba(196, 30, 58, 0.2);
            transform: translateY(-2px);
            border-color: #C41E3A;
        }

        .program-logo {
            width: 100px;
            height: 100px;
            border-radius: 8px;
            object-fit: contain;
            background: #fafafa;
            border: 1px solid #eee;
            margin-bottom: 1rem;
        }

        .program-logo.placeholder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #C41E3A;
            background: #fff6f7;
            font-size: 1.5rem;
        }

        .program-name {
            font-weight: 600;
            font-size: 1.1rem;
            color: #333;
            margin-bottom: 0.75rem;
            line-height: 1.4;
        }

        .program-description {
            color: #555;
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            text-align: justify;
        }

        .program-actions {
            margin-top: 1rem;
        }

        .program-actions a {
            margin-right: 0.5rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-title {
            color: #C41E3A;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 1.1rem;
        }

        .no-programs {
            text-align: center;
            padding: 2rem;
            color: #999;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .programs-grid {
                grid-template-columns: 1fr;
            }

            .college-title {
                font-size: 1.5rem;
            }

            .page-title {
                font-size: 1.75rem;
            }
        }
    </style>
@endsection

@section('content')
    <div class="section">
        <div class="page-header">
            <h3 class="page-title">Undergraduate Programs</h3>
            <p class="page-subtitle">Explore all undergraduate programs offered by our colleges</p>
        </div>

        @forelse($colleges as $college)
            <div class="college-section">
                <h4 class="college-title">
                    {{ $college->college }}
                </h4>

                @if($college->courses->count() > 0)
                    <div class="programs-grid">
                        @foreach($college->courses as $course)
                            <div class="program-card">
                                <div style="display: flex; align-items: center; margin-bottom: 1rem;">
                                    @if($course->logo)
                                        <img class="program-logo" src="{{ asset('storage/' . $course->logo) }}"
                                            alt="{{ $course->name }} Logo">
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                                    @else
                                        @php
                                            $words = preg_split('/\s+/', trim($course->name));
                                            $initials = '';
                                            foreach ($words as $w) {
                                                if ($w !== '') {
                                                    $initials .= strtoupper(mb_substr($w, 0, 1));
<<<<<<< HEAD
                                                    if (strlen($initials) >= 2) {
                                                        break;
                                                    }
                                                }
                                            }
                                        @endphp
                                        <div class="program-card__logo program-card__logo--placeholder" aria-hidden="true">{{ $initials ?: 'TUP' }}</div>
                                    @endif
                                    <h3 class="program-card__name">{{ $course->name }}</h3>
                                </div>

                                @if ($course->description)
                                    <p class="program-card__description">{{ Str::limit(strip_tags($course->description), 160) }}</p>
                                @endif

                                <a class="program-card__link" href="{{ route('academics.show', $college->college) }}">View college page</a>
                            </article>
                        @endforeach
                    </div>
                @else
                    <p class="program-empty">No undergraduate programs listed for this college at the moment.</p>
                @endif
            </section>
        @empty
            <p class="program-empty">No undergraduate programs available at this time.</p>
        @endforelse
    </div>
@endsection
=======
                                                    if (strlen($initials) >= 2)
                                                        break;
                                                }
                                            }
                                        @endphp
                                        <div class="program-logo placeholder">{{ $initials }}</div>
                                    @endif
                                    <div style="flex: 1; margin-left: 1rem;">
                                        <div class="program-name">{{ $course->name }}</div>
                                    </div>
                                </div>

                                @if($course->description)
                                    <div class="program-description">
                                        {{ Str::limit($course->description, 150) }}
                                        @if(strlen($course->description) > 150)
                                            <a href="{{ route('academics.show', $college->college) }}" style="color: #C41E3A;">...read more</a>
                                        @endif
                                    </div>
                                @endif

                                <div class="program-actions">
                                    <a href="{{ route('academics.show', $college->college) }}"
                                        class="btn-small waves-effect waves-light red darken-2">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="no-programs">
                        No undergraduate programs available for this college at the moment.
                    </div>
                @endif
            </div>
        @empty
            <div class="no-programs">
                <p>No undergraduate programs available at this time.</p>
            </div>
        @endforelse
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
