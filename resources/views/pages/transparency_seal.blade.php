@extends('layouts.app')

@section('title', 'Transparency Seal - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'TUP Visayas Transparency Seal — agency profile, budgets, financial reports, procurement plans, FOI, QMS, and Citizen\'s Charter documents.';
        $sealImg = asset('images/Philippine_Transparency_Seal.svg');
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Transparency Seal - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    @php
        /**
         * Paste Google Drive view links here.
         * Empty string = "Pending posting" (no download button).
         */
        $drive = [
            // Section II — budget (existing)
            'budget_2025' => 'https://drive.google.com/file/d/1s6OTIVCK4wxTBhX5zG46z-hqHaSZ6Ge3/view?usp=drive_link',
            'budget_2024' => 'https://drive.google.com/file/d/1pMwrmuHq6Pf5r2ytD8FIdMaD-fqx5kNW/view?usp=drive_link',
            'budget_2023' => '',

            // Section III — GAA modifications / N/A certification (AOM gap)
            'modifications_na' => '',

            // Section IV — major PAPs & beneficiaries
            'paps_beneficiaries' => '',

            // Section V — implementation & evaluation (AOM gap)
            'implementation_status' => '',
            'evaluation_reports' => '',

            // Section VI — contracts awarded (AOM gap); APPs kept below as filled
            'contracts_awarded' => '',

            // Section VII — BFARs / financial
            'bar_2025' => 'https://drive.google.com/file/d/1tcRXgygic-5rvmSaQAdwgZzMW_RTp5Ih/view?usp=drive_link',
            'bar_2024_q4' => 'https://drive.google.com/file/d/1C0ejGRosgEci8z8rLbNEUxofLmHk-S1a/view?usp=drive_link',
            'bar_2024_q3' => 'https://drive.google.com/file/d/1OSTAeTxJhO8OBZ6juGn8rNMIGVQUhFt8/view?usp=drive_link',
            'bar_2024_q2' => 'https://drive.google.com/file/d/1EN4JVHh_bjRVxYsiKEDrR6cG2jpHaj_y/view?usp=drive_link',
            'bar_2024_q1' => 'https://drive.google.com/file/d/1RS56NgGPKzHYT8THUFepoqJp4TIFwCK2/view?usp=drive_link',
            'bar_2023' => '',
            'saob' => '',
            'financial_statements' => '',
            'far_5' => '',
            'financial_plan' => '',
            'pcfr' => '',
            'donated_property_inventory' => 'https://drive.google.com/file/d/1QQ3zVwQqO9tO4F2iYPkQZcAjE_G53Eug/view?usp=drive_link',
            'annual_performance' => 'https://drive.google.com/file/d/1Je_IQEWLACKCGTI2xjThee-xHrRC5yHh/view?usp=drive_link',

            // Section VI APP
            'app_2025_non_cse' => 'https://drive.google.com/file/d/1Je_IQEWLACKCGTI2xjThee-xHrRC5yHh/view?usp=drive_link',
            'app_2025_cse' => 'https://drive.google.com/file/d/1_FqD2EglHb6OuGi24dUpG36fkn5c9tky/view?usp=drive_link',
            'app_2024_non_cse' => 'https://drive.google.com/file/d/1VTvY9gV4rktXtS4YlDC7zUOfMIaMI8n4/view?usp=drive_link',
            'app_2024_cse' => 'https://drive.google.com/file/d/1TbQrpu09VyrZ4xfNZHd55vrhvjAZ3yIZ/view?usp=drive_link',
            'app_2023_non_cse' => 'https://drive.google.com/file/d/1R0af9-4BFNk_ZpCcZS4_s6uQ1c9yFu1x/view?usp=drive_link',
            'app_2023_cse' => 'https://drive.google.com/file/d/10gfpsvuiSl37cvNQLvhqwBH6rceAVsL-/view?usp=drive_link',

            // QMS / FOI / Charter
            'qms_iso' => 'https://drive.google.com/file/d/1wu_RMIcH-wrzgyWqBpfrnAb_-LCoZfqi/view?usp=drive_link',
            'foi_manual' => 'https://drive.google.com/file/d/1DvIEHIMgGwIL_-uchO4oNtQpkLahZFlH/view?usp=drive_link',
            'foi_approval' => 'https://drive.google.com/file/d/1CrQiHjNL8KtdVOXOCeBENNWlIh3PZVNg/view?usp=drive_link',
            'foi_onepage' => 'https://drive.google.com/file/d/1WqjT8RdLX5RC9zThtNu52_86oCEfir7U/view?usp=drive_link',
            'foi_onepage_fil' => 'https://drive.google.com/file/d/1CGhVBCDct_eELVzpAcAEEuhaK0jKIZaI/view?usp=drive_link',
            'citizens_charter' => 'https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link',
        ];

        $driveUrl = function (string $key) use ($drive): string {
            return trim((string) ($drive[$key] ?? ''));
        };

        $hasDrive = function (string $key) use ($driveUrl): bool {
            return $driveUrl($key) !== '';
        };
    @endphp

    <div class="site-page site-page--transparency">
        <section class="acad-hero" aria-labelledby="ts-hero-heading">
            <p class="acad-hero__badge">Accountability</p>
            <h1 id="ts-hero-heading" class="acad-hero__title">Transparency Seal</h1>
            <p class="acad-hero__lede">
                TUP Visayas publishes required transparency documents under the General Appropriations Act —
                agency information, budgets, financial reports, procurement, FOI materials, and related disclosures.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#ts-agency">Agency</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-budget">Budget</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-modifications">Modifications</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-projects">Projects</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-procurement">Procurement</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-financial">BFARs</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-foi">FOI</a>
            </div>
        </section>

        {{-- Compliance overview (Section 104) --}}
        <section class="sit-section sit-section--muted" id="ts-compliance" aria-labelledby="ts-compliance-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section 104 checklist</p>
                    <h2 id="ts-compliance-heading" class="sit-section__title">Transparency Seal disclosures</h2>
                    <p class="sit-section__lede">
                        Index of mandatory postings. Pending items will show a download button once a Google Drive link is added.
                    </p>
                </header>
                <ul class="ts-compliance-list">
                    <li>
                        <a href="#ts-agency">i. Agency mandate, officials, and contact</a>
                        <span class="ts-status ts-status--updated">Posted</span>
                    </li>
                    <li>
                        <a href="#ts-budget">ii. Approved budgets and corresponding targets</a>
                        <span class="ts-status ts-status--updated">Posted</span>
                    </li>
                    <li>
                        <a href="#ts-modifications">iii. Modifications pursuant to the GAA</a>
                        @if ($hasDrive('modifications_na'))
                            <span class="ts-status ts-status--updated">Posted</span>
                        @else
                            <span class="ts-status ts-status--na">N/A / Pending</span>
                        @endif
                    </li>
                    <li>
                        <a href="#ts-procurement">iv. APP and contracts awarded / winning suppliers</a>
                        @if ($hasDrive('contracts_awarded'))
                            <span class="ts-status ts-status--updated">Posted</span>
                        @else
                            <span class="ts-status ts-status--pending">Partial / Pending contracts</span>
                        @endif
                    </li>
                    <li>
                        <a href="#ts-projects">v. Major activities / projects and beneficiaries</a>
                        @if ($hasDrive('paps_beneficiaries'))
                            <span class="ts-status ts-status--updated">Posted</span>
                        @else
                            <span class="ts-status ts-status--pending">Pending posting</span>
                        @endif
                    </li>
                    <li>
                        <a href="#ts-evaluation">vi. Implementation / evaluation reports</a>
                        @if ($hasDrive('evaluation_reports'))
                            <span class="ts-status ts-status--updated">Posted</span>
                        @else
                            <span class="ts-status ts-status--pending">Pending evaluation</span>
                        @endif
                    </li>
                    <li>
                        <a href="#ts-financial">vii. Budget and Financial Accountability Reports (BFARs)</a>
                        <span class="ts-status ts-status--updated">Posted</span>
                    </li>
                    <li>
                        <a href="#ts-foi">viii. People’s Freedom of Information (FOI)</a>
                        <span class="ts-status ts-status--updated">Posted</span>
                    </li>
                </ul>
            </div>
        </section>

        {{-- I. Agency --}}
        <section class="sit-section" id="ts-agency" aria-labelledby="ts-agency-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section I</p>
                    <h2 id="ts-agency-heading" class="sit-section__title">
                        Agency mandate, officials, and contact information
                    </h2>
                    <p class="sit-section__lede">
                        Institutional identity, campus officials, and public contact details for TUP Visayas.
                    </p>
                </header>

                <div class="ts-intro">
                    <figure class="ts-intro__seal">
                        <img src="{{ $sealImg }}"
                            alt="Official Transparency Seal"
                            width="160"
                            height="160"
                            loading="lazy"
                            decoding="async">
                        <figcaption>Official Transparency Seal</figcaption>
                    </figure>
                    <p class="sit-prose">
                        The Technological University of the Philippines Visayas is committed to transparency and
                        accountability in all its operations. This page provides access to information required under
                        the Philippine government’s Transparency Seal provisions.
                    </p>
                </div>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Agency mandate, mission, and vision</h3>
                        <p class="ts-doc-card__text">
                            Legal mandate and institutional statements of TUP Visayas.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('about.mandate') }}">View mandate</a>
                            <a class="acad-btn acad-btn--ghost" href="{{ route('about.mission') }}">Mission &amp; vision</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Names of officials with position / designation</h3>
                        <p class="ts-doc-card__text">
                            Directory of campus officials and their designations.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('officials') }}">View officials</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Contact information</h3>
                        <p class="ts-doc-card__text">
                            Campus address, telephone, and email for public inquiries.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('contact') }}">Campus contact</a>
                            <a class="acad-btn acad-btn--ghost" href="#ts-contact">Transparency office</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Organizational structure</h3>
                        <p class="ts-doc-card__text">
                            Administrative structure and key personnel of TUP Visayas.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('officials') }}">View structure</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- II. Budget --}}
        <section class="sit-section sit-section--muted" id="ts-budget" aria-labelledby="ts-budget-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section II</p>
                    <h2 id="ts-budget-heading" class="sit-section__title">Approved budgets and corresponding targets</h2>
                    <p class="sit-section__lede">Budget documents by fiscal year, posted upon approval of the GAA.</p>
                </header>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2025</h3>
                            @if ($hasDrive('budget_2025'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2025 approved budget and corresponding targets.</p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('budget_2025'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('budget_2025') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2024</h3>
                            @if ($hasDrive('budget_2024'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2024 approved budget and corresponding targets.</p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('budget_2024'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('budget_2024') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2023</h3>
                            @if ($hasDrive('budget_2023'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2023 approved budget and corresponding targets.</p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('budget_2023'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('budget_2023') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- III. Modifications --}}
        <section class="sit-section" id="ts-modifications" aria-labelledby="ts-modifications-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section III</p>
                    <h2 id="ts-modifications-heading" class="sit-section__title">
                        Modifications made pursuant to the general and special provisions of the GAA
                    </h2>
                    <p class="sit-section__lede">
                        Budgetary or programmatic modifications, or a certification that none were incurred for the period.
                    </p>
                </header>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">GAA modifications / N/A certification</h3>
                            @if ($hasDrive('modifications_na'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--na">N/A / Pending</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            Post the report of modifications under the GAA, or a certification that no modifications
                            were made for the covered period (paste Google Drive link in <code>$drive['modifications_na']</code>).
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('modifications_na'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('modifications_na') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- IV / V. Projects --}}
        <section class="sit-section sit-section--muted" id="ts-projects" aria-labelledby="ts-projects-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Sections IV–V</p>
                    <h2 id="ts-projects-heading" class="sit-section__title">
                        Major programs, activities, and projects
                    </h2>
                    <p class="sit-section__lede">
                        Target beneficiaries, status of implementation, and evaluation or assessment reports.
                    </p>
                </header>

                <h3 class="ts-subhead">IV. Major activities / projects and target beneficiaries</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Major PAPs and beneficiaries</h3>
                            @if ($hasDrive('paps_beneficiaries'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            List of major programs, activities, and projects with target beneficiaries.
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('paps_beneficiaries'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('paps_beneficiaries') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>

                <h3 class="ts-subhead" id="ts-evaluation">V. Status of implementation and evaluation / assessment</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Status of implementation</h3>
                            @if ($hasDrive('implementation_status'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            Status of implementation of major programs, activities, and projects.
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('implementation_status'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('implementation_status') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Evaluation / assessment reports</h3>
                            @if ($hasDrive('evaluation_reports'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            Evaluation or assessment reports of major programs or projects (flagged in COA AOM).
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('evaluation_reports'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('evaluation_reports') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- VI. Procurement --}}
        <section class="sit-section" id="ts-procurement" aria-labelledby="ts-procurement-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section VI</p>
                    <h2 id="ts-procurement-heading" class="sit-section__title">
                        Annual Procurement Plan and contracts awarded
                    </h2>
                    <p class="sit-section__lede">
                        APP (CSE and Non-CSE), contracts awarded, and names of winning suppliers / contractors / consultants.
                    </p>
                </header>

                <h3 class="ts-subhead">Annual Procurement Plan — Visayas Campus</h3>
                <div class="ts-doc-grid">
                    @foreach ([
                        ['app_2025_non_cse', 'Annual Procurement Plan 2025 (Non-CSE)'],
                        ['app_2025_cse', 'Annual Procurement Plan 2025 (CSE)'],
                        ['app_2024_non_cse', 'Annual Procurement Plan 2024 (Non-CSE)'],
                        ['app_2024_cse', 'Annual Procurement Plan 2024 (CSE)'],
                        ['app_2023_non_cse', 'Annual Procurement Plan 2023 (Non-CSE)'],
                        ['app_2023_cse', 'Annual Procurement Plan 2023 (CSE)'],
                    ] as [$key, $title])
                        <article class="ts-doc-card">
                            <div class="ts-doc-card__meta">
                                <h3 class="ts-doc-card__title">{{ $title }}</h3>
                                @if ($hasDrive($key))
                                    <span class="ts-status ts-status--updated">Posted</span>
                                @else
                                    <span class="ts-status ts-status--pending">Pending posting</span>
                                @endif
                            </div>
                            <div class="ts-doc-card__actions">
                                @if ($hasDrive($key))
                                    <a class="acad-btn acad-btn--primary" href="{{ $driveUrl($key) }}"
                                        target="_blank" rel="noopener noreferrer">Download PDF</a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>

                <h3 class="ts-subhead" id="ts-contracts">Contracts awarded and winning suppliers</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Contracts awarded report</h3>
                            @if ($hasDrive('contracts_awarded'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            Report of contracts awarded with names of winning suppliers, contractors, or consultants
                            (COA AOM gap). Paste the Google Drive PDF link in <code>$drive['contracts_awarded']</code>.
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('contracts_awarded'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('contracts_awarded') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Bid opportunities (awarded listings)</h3>
                        <p class="ts-doc-card__text">
                            Campus bid opportunities board, including items marked awarded.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('procurement.bid') }}">View bid opportunities</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">PhilGEPS posting</h3>
                        <p class="ts-doc-card__text">
                            PhilGEPS-related procurement postings for TUP Visayas.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('procurement.philgeps') }}">View PhilGEPS posting</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- VII. BFARs / Financial --}}
        <section class="sit-section sit-section--muted" id="ts-financial" aria-labelledby="ts-financial-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section VII</p>
                    <h2 id="ts-financial-heading" class="sit-section__title">
                        Budget and Financial Accountability Reports (BFARs)
                    </h2>
                    <p class="sit-section__lede">
                        Physical and financial accountability reports for TUP Visayas.
                    </p>
                </header>

                <h3 class="ts-subhead">BAR No. 1 — Quarterly Physical Report of Operations / Physical Plan</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2025</h3>
                            @if ($hasDrive('bar_2025'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('bar_2025'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('bar_2025') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2024 (by quarter)</h3>
                            <span class="ts-status ts-status--updated">Posted</span>
                        </div>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('bar_2024_q4'))
                                <a class="acad-btn acad-btn--ghost" href="{{ $driveUrl('bar_2024_q4') }}"
                                    target="_blank" rel="noopener noreferrer">4th Quarter</a>
                            @endif
                            @if ($hasDrive('bar_2024_q3'))
                                <a class="acad-btn acad-btn--ghost" href="{{ $driveUrl('bar_2024_q3') }}"
                                    target="_blank" rel="noopener noreferrer">3rd Quarter</a>
                            @endif
                            @if ($hasDrive('bar_2024_q2'))
                                <a class="acad-btn acad-btn--ghost" href="{{ $driveUrl('bar_2024_q2') }}"
                                    target="_blank" rel="noopener noreferrer">2nd Quarter</a>
                            @endif
                            @if ($hasDrive('bar_2024_q1'))
                                <a class="acad-btn acad-btn--ghost" href="{{ $driveUrl('bar_2024_q1') }}"
                                    target="_blank" rel="noopener noreferrer">1st Quarter</a>
                            @endif
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2023</h3>
                            @if ($hasDrive('bar_2023'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('bar_2023'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('bar_2023') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>

                <h3 class="ts-subhead">Other BFAR / financial reports</h3>
                <div class="ts-doc-grid">
                    @foreach ([
                        ['saob', 'FAR No. 1 / SAOB (Statement of Appropriations, Allotments, Obligations, Disbursements and Balances)'],
                        ['far_5', 'FAR No. 5 — Quarterly Report on Revenue and Other Receipts'],
                        ['financial_plan', 'Financial Plan'],
                        ['financial_statements', 'Annual audited financial statements'],
                        ['annual_performance', 'Annual performance report'],
                        ['pcfr', 'Performance Commitment and Review Form (PCFR)'],
                        ['donated_property_inventory', 'Report on Inventory of Donated Property'],
                    ] as [$key, $title])
                        <article class="ts-doc-card">
                            <div class="ts-doc-card__meta">
                                <h3 class="ts-doc-card__title">{{ $title }}</h3>
                                @if ($hasDrive($key))
                                    <span class="ts-status ts-status--updated">Posted</span>
                                @else
                                    <span class="ts-status ts-status--pending">Pending posting</span>
                                @endif
                            </div>
                            <div class="ts-doc-card__actions">
                                @if ($hasDrive($key))
                                    <a class="acad-btn acad-btn--primary" href="{{ $driveUrl($key) }}"
                                        target="_blank" rel="noopener noreferrer">Download PDF</a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- QMS (additional) --}}
        <section class="sit-section" id="ts-qms" aria-labelledby="ts-qms-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Quality management</p>
                    <h2 id="ts-qms-heading" class="sit-section__title">QMS certificate</h2>
                </header>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">ISO 9001:2015</h3>
                            @if ($hasDrive('qms_iso'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            TUP Visayas QMS certificate confirming commitment to quality education and continuous improvement.
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('qms_iso'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('qms_iso') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- VIII. FOI --}}
        <section class="sit-section sit-section--muted" id="ts-foi" aria-labelledby="ts-foi-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section VIII</p>
                    <h2 id="ts-foi-heading" class="sit-section__title">People’s Freedom of Information</h2>
                </header>

                <div class="ts-doc-grid">
                    @foreach ([
                        ['foi_manual', 'FOI Manual', 'Manual on Freedom of Information implementation and procedures.'],
                        ['foi_approval', 'Approval of FOI', 'Approval form of Freedom of Information.'],
                        ['foi_onepage', 'Modified One-Page FOI', 'Modified one-page Freedom of Information.'],
                        ['foi_onepage_fil', 'Modified One-Page FOI in Filipino', 'Modified one-page Freedom of Information in Filipino.'],
                    ] as [$key, $title, $text])
                        <article class="ts-doc-card">
                            <div class="ts-doc-card__meta">
                                <h3 class="ts-doc-card__title">{{ $title }}</h3>
                                @if ($hasDrive($key))
                                    <span class="ts-status ts-status--updated">Posted</span>
                                @else
                                    <span class="ts-status ts-status--pending">Pending posting</span>
                                @endif
                            </div>
                            <p class="ts-doc-card__text">{{ $text }}</p>
                            <div class="ts-doc-card__actions">
                                @if ($hasDrive($key))
                                    <a class="acad-btn acad-btn--primary" href="{{ $driveUrl($key) }}"
                                        target="_blank" rel="noopener noreferrer">Download PDF</a>
                                @endif
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Citizen's Charter --}}
        <section class="sit-section" id="ts-charter" aria-labelledby="ts-charter-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">ARTA</p>
                    <h2 id="ts-charter-heading" class="sit-section__title">Citizen’s Charter</h2>
                </header>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">TUP Visayas Citizen’s Charter</h3>
                            @if ($hasDrive('citizens_charter'))
                                <span class="ts-status ts-status--updated">Posted</span>
                            @else
                                <span class="ts-status ts-status--pending">Pending posting</span>
                            @endif
                        </div>
                        <p class="ts-doc-card__text">
                            Guide to university services, requirements, and procedures.
                        </p>
                        <div class="ts-doc-card__actions">
                            @if ($hasDrive('citizens_charter'))
                                <a class="acad-btn acad-btn--primary" href="{{ $driveUrl('citizens_charter') }}"
                                    target="_blank" rel="noopener noreferrer">Download PDF</a>
                                <a class="acad-btn acad-btn--ghost" href="{{ $driveUrl('citizens_charter') }}"
                                    target="_blank" rel="noopener noreferrer">View online</a>
                            @endif
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- Contact --}}
        <section class="sit-section sit-section--muted" id="ts-contact" aria-labelledby="ts-contact-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Office</p>
                    <h2 id="ts-contact-heading" class="sit-section__title">Contact information</h2>
                </header>

                <article class="sit-contact-card">
                    <div class="sit-contact-card__body">
                        <p class="sit-contact-card__role">Transparency and Accountability</p>
                        <h3 class="sit-contact-card__name">Transparency and Accountability Office</h3>
                        <p class="sit-contact-card__title">TUP Visayas, Talisay City, Negros Occidental</p>
                        <dl class="sit-contact-card__meta">
                            <div>
                                <dt>Email</dt>
                                <dd><a href="mailto:transparency@tupv.edu.ph">transparency@tupv.edu.ph</a></dd>
                            </div>
                            <div>
                                <dt>Phone</dt>
                                <dd><a href="tel:+63343412345">(034) 341-2345</a></dd>
                            </div>
                            <div>
                                <dt>Office hours</dt>
                                <dd>Monday to Friday, 8:00 AM – 5:00 PM</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="sit-contact-card__actions">
                        <a class="acad-btn acad-btn--primary" href="mailto:transparency@tupv.edu.ph">Email transparency office</a>
                        <a class="acad-btn acad-btn--ghost" href="{{ route('contact') }}">Campus contact page</a>
                    </div>
                </article>

                <p class="ts-updated">
                    <strong>Last updated:</strong> {{ date('F d, Y') }}
                    <span aria-hidden="true"> · </span>
                    <strong>Next review:</strong> {{ date('F d, Y', strtotime('+6 months')) }}
                </p>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="ts-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="ts-cta-heading" class="acad-cta__title">Need a transparency document?</h2>
                <p class="acad-cta__lede">
                    Browse the sections above, or contact the Transparency and Accountability Office for FOI and
                    document requests.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="mailto:transparency@tupv.edu.ph">Email transparency@tupv.edu.ph</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('contact') }}">Contact campus</a>
                </div>
            </div>
        </section>
    </div>
@endsection
