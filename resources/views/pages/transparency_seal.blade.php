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
    <div class="site-page site-page--transparency">
        <section class="acad-hero" aria-labelledby="ts-hero-heading">
            <p class="acad-hero__badge">Accountability</p>
            <h1 id="ts-hero-heading" class="acad-hero__title">Transparency Seal</h1>
            <p class="acad-hero__lede">
                TUP Visayas publishes required transparency documents — budgets, financial and performance reports,
                procurement plans, FOI materials, and the Citizen’s Charter — for public access.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#ts-agency">Agency profile</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-budget">Budget</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-financial">Financial reports</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-procurement">Procurement</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-foi">FOI</a>
                <a class="acad-btn acad-btn--ghost" href="#ts-contact">Contact</a>
            </div>
        </section>

        {{-- I. Agency Profile --}}
        <section class="sit-section" id="ts-agency" aria-labelledby="ts-agency-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section I</p>
                    <h2 id="ts-agency-heading" class="sit-section__title">Agency Profile and Mandate</h2>
                    <p class="sit-section__lede">
                        Institutional identity, structure, and legal mandate of TUP Visayas.
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
                        accountability in all its operations. This page provides access to important documents and
                        information as required by the Philippine government’s transparency initiatives.
                    </p>
                </div>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Agency Profile</h3>
                        <p class="ts-doc-card__text">
                            Comprehensive information about TUP Visayas, including our history, mission, vision, and core values.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('about.mission') }}">View profile</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Organizational Structure</h3>
                        <p class="ts-doc-card__text">
                            Current organizational chart showing the university’s administrative structure and key personnel.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('officials') }}">View structure</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">University Mandate</h3>
                        <p class="ts-doc-card__text">
                            Legal basis and authority for the establishment and operation of TUP Visayas.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="{{ route('about.mandate') }}">View mandate</a>
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
                    <h2 id="ts-budget-heading" class="sit-section__title">Approved Budget and Corresponding Targets</h2>
                    <p class="sit-section__lede">Budget documents by fiscal year.</p>
                </header>

                <h3 class="ts-subhead">Budget documents</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2025</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2025 approved budget.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1s6OTIVCK4wxTBhX5zG46z-hqHaSZ6Ge3/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2024</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2024 approved budget.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1pMwrmuHq6Pf5r2ytD8FIdMaD-fqx5kNW/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2023</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2023 approved budget.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="#">Download PDF</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- IV. Financial reports --}}
        <section class="sit-section" id="ts-financial" aria-labelledby="ts-financial-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section IV</p>
                    <h2 id="ts-financial-heading" class="sit-section__title">Annual Financial Reports</h2>
                </header>

                <h3 class="ts-subhead">I. BAR No. 1: Quarterly Physical Report of Operations / Physical Plan</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2025</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Quarterly Physical Report of Operations / Physical Plan.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1tcRXgygic-5rvmSaQAdwgZzMW_RTp5Ih/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2024</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Quarterly Physical Report of Operations / Physical Plan.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--ghost"
                                href="https://drive.google.com/file/d/1C0ejGRosgEci8z8rLbNEUxofLmHk-S1a/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">4th Quarter</a>
                            <a class="acad-btn acad-btn--ghost"
                                href="https://drive.google.com/file/d/1OSTAeTxJhO8OBZ6juGn8rNMIGVQUhFt8/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">3rd Quarter</a>
                            <a class="acad-btn acad-btn--ghost"
                                href="https://drive.google.com/file/d/1EN4JVHh_bjRVxYsiKEDrR6cG2jpHaj_y/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">2nd Quarter</a>
                            <a class="acad-btn acad-btn--ghost"
                                href="https://drive.google.com/file/d/1RS56NgGPKzHYT8THUFepoqJp4TIFwCK2/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">1st Quarter</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FY 2023</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Fiscal Year 2023 approved budget.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="#">Download PDF</a>
                        </div>
                    </article>
                </div>

                <h3 class="ts-subhead">Annual Financial Reports</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Statement of Allotments, Obligations and Balances</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Quarterly SAOB reports showing budget utilization.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--ghost" href="#">Q1 2024</a>
                            <a class="acad-btn acad-btn--ghost" href="#">Q2 2024</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Financial Statements</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Annual audited financial statements and reports.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="#">FY 2023</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- Performance --}}
        <section class="sit-section sit-section--muted" id="ts-performance" aria-labelledby="ts-performance-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Performance</p>
                    <h2 id="ts-performance-heading" class="sit-section__title">Performance Documents</h2>
                </header>

                <h3 class="ts-subhead">Performance Targets and Accomplishments</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Annual Performance Report</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Comprehensive report on university performance and achievements.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1Je_IQEWLACKCGTI2xjThee-xHrRC5yHh/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Performance Commitment and Review Form</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">PCFR documents showing performance targets and actual accomplishments.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="#">Download PDF</a>
                        </div>
                    </article>
                </div>

                <h3 class="ts-subhead">Programs and Projects</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Major Programs and Projects</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">List and status of major programs, projects, and activities.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary" href="#">Download PDF</a>
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
                        Annual Procurement Plan, Contracts Award and the Names of Contractors / Suppliers / Consultants
                    </h2>
                </header>

                <h3 class="ts-subhead">1. Annual Procurement Plan — Visayas Campus</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2025 (Non-CSE)</h3>
                        <p class="ts-doc-card__text">Comprehensive procurement plan for the current fiscal year.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1Je_IQEWLACKCGTI2xjThee-xHrRC5yHh/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2025 (CSE)</h3>
                        <p class="ts-doc-card__text">Monthly and quarterly procurement monitoring reports.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1_FqD2EglHb6OuGi24dUpG36fkn5c9tky/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2024 (Non-CSE)</h3>
                        <p class="ts-doc-card__text">Comprehensive procurement plan for the current fiscal year.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1VTvY9gV4rktXtS4YlDC7zUOfMIaMI8n4/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2024 (CSE)</h3>
                        <p class="ts-doc-card__text">Monthly and quarterly procurement monitoring reports.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1TbQrpu09VyrZ4xfNZHd55vrhvjAZ3yIZ/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2023 (Non-CSE)</h3>
                        <p class="ts-doc-card__text">Comprehensive procurement plan for the current fiscal year.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1R0af9-4BFNk_ZpCcZS4_s6uQ1c9yFu1x/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">Annual Procurement Plan 2023 (CSE)</h3>
                        <p class="ts-doc-card__text">Monthly and quarterly procurement monitoring reports.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/10gfpsvuiSl37cvNQLvhqwBH6rceAVsL-/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- VII. QMS --}}
        <section class="sit-section sit-section--muted" id="ts-qms" aria-labelledby="ts-qms-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section VII</p>
                    <h2 id="ts-qms-heading" class="sit-section__title">QMS Certificate</h2>
                </header>

                <h3 class="ts-subhead">TUP Visayas QMS Certificate</h3>
                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <h3 class="ts-doc-card__title">ISO 9001:2015</h3>
                        <p class="ts-doc-card__text">
                            TUP Visayas’ QMS certificate (ISO 9001:2015) confirms its commitment to quality education and
                            continuous improvement in engineering and technology.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1wu_RMIcH-wrzgyWqBpfrnAb_-LCoZfqi/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- VIII. FOI --}}
        <section class="sit-section" id="ts-foi" aria-labelledby="ts-foi-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section VIII</p>
                    <h2 id="ts-foi-heading" class="sit-section__title">People’s Freedom of Information</h2>
                </header>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">FOI Manual</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Manual on Freedom of Information implementation and procedures.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1DvIEHIMgGwIL_-uchO4oNtQpkLahZFlH/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Approval of FOI</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Approval form of Freedom of Information.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1CrQiHjNL8KtdVOXOCeBENNWlIh3PZVNg/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download form</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Modified One-Page FOI</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Modified one-page Freedom of Information.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1WqjT8RdLX5RC9zThtNu52_86oCEfir7U/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download form</a>
                        </div>
                    </article>
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">Modified One-Page FOI in Filipino</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">Modified one-page Freedom of Information in Filipino.</p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1CGhVBCDct_eELVzpAcAEEuhaK0jKIZaI/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download form</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- XIII. Citizen's Charter --}}
        <section class="sit-section sit-section--muted" id="ts-charter" aria-labelledby="ts-charter-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Section XIII</p>
                    <h2 id="ts-charter-heading" class="sit-section__title">Citizen’s Charter</h2>
                </header>

                <div class="ts-doc-grid">
                    <article class="ts-doc-card">
                        <div class="ts-doc-card__meta">
                            <h3 class="ts-doc-card__title">TUP Visayas Citizen’s Charter</h3>
                            <span class="ts-status ts-status--updated">Updated</span>
                        </div>
                        <p class="ts-doc-card__text">
                            Comprehensive guide to university services, requirements, and procedures.
                        </p>
                        <div class="ts-doc-card__actions">
                            <a class="acad-btn acad-btn--primary"
                                href="https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">Download PDF</a>
                            <a class="acad-btn acad-btn--ghost"
                                href="https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link"
                                target="_blank" rel="noopener noreferrer">View online</a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        {{-- Contact --}}
        <section class="sit-section" id="ts-contact" aria-labelledby="ts-contact-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Office</p>
                    <h2 id="ts-contact-heading" class="sit-section__title">Contact Information</h2>
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
