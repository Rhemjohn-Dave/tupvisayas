@extends('layouts.app')

@section('title', 'Procurement - Bid Opportunities')

@section('content')
    @php
        $queryActive = filled(request('q')) || filled(request('category')) || request('sort', 'latest') !== 'latest';
    @endphp

    <div class="section site-page site-page--procurement">
        <section class="procurement-hero">
            <p class="procurement-hero__eyebrow">Transparent procurement</p>
            <h1 class="procurement-hero__title">Bid Opportunities</h1>
            <p class="procurement-hero__intro">
                Public bidding notices and procurement documents from TUP Visayas, presented in a clearer format for
                suppliers, partners, and campus stakeholders.
            </p>
            <div class="procurement-hero__actions">
                <a class="procurement-toolbar__link procurement-toolbar__link--primary"
                    href="{{ route('procurement.philgeps') }}">View PhilGEPS posting</a>
                <a class="procurement-toolbar__link" href="{{ route('contact') }}">Contact BAC / campus offices</a>
            </div>
        </section>

        <div class="procurement-hero__stats" aria-label="Bid opportunity summary">
            <article class="procurement-stat">
                <span class="procurement-stat__label">Total notices</span>
                <strong class="procurement-stat__value">{{ $summary['total'] }}</strong>
            </article>
            <article class="procurement-stat">
                <span class="procurement-stat__label">Pending</span>
                <strong class="procurement-stat__value">{{ $summary['pending'] }}</strong>
            </article>
            <article class="procurement-stat">
                <span class="procurement-stat__label">Awarded</span>
                <strong class="procurement-stat__value">{{ $summary['awarded'] }}</strong>
            </article>
        </div>

        <section class="procurement-panel">
            <div class="procurement-panel__head">
                <div>
                    <h2 class="procurement-panel__title">Find documents quickly</h2>
                    <p class="procurement-panel__text">Search by reference number or title, then narrow the list by category or sort order.</p>
                </div>
                @if ($queryActive)
                    <a class="procurement-panel__reset" href="{{ route('procurement.bid') }}">Clear filters</a>
                @endif
            </div>

            <form method="GET" class="procurement-filters">
                <label class="procurement-field procurement-field--search" for="q">
                    <span class="procurement-field__label">Search</span>
                    <input id="q" name="q" type="text" value="{{ request('q') }}"
                        placeholder="Search title or reference number">
                </label>

                <label class="procurement-field" for="category">
                    <span class="procurement-field__label">Category</span>
                    <select id="category" name="category">
                        <option value="">All categories</option>
                        @foreach ($categories as $cat)
                            <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                                {{ $cat }}
                            </option>
                        @endforeach
                    </select>
                </label>

                <label class="procurement-field" for="sort">
                    <span class="procurement-field__label">Sort by</span>
                    <select id="sort" name="sort">
                        <option value="latest" {{ $sort === 'latest' ? 'selected' : '' }}>Latest posted</option>
                        <option value="closing_soon" {{ $sort === 'closing_soon' ? 'selected' : '' }}>Closing soon</option>
                        <option value="reference" {{ $sort === 'reference' ? 'selected' : '' }}>Reference no.</option>
                        <option value="title" {{ $sort === 'title' ? 'selected' : '' }}>Title A-Z</option>
                    </select>
                </label>

                <div class="procurement-filters__actions">
                    <button class="procurement-filters__submit" type="submit">Apply filters</button>
                </div>
            </form>
        </section>

        <div class="procurement-results-bar">
            <p class="procurement-results-bar__count">
                Showing <strong>{{ $procurements->count() }}</strong> of <strong>{{ $procurements->total() }}</strong>
                bid {{ \Illuminate\Support\Str::plural('opportunity', $procurements->total()) }}
            </p>
            <p class="procurement-results-bar__hint">Download the bidding document directly from each row or card.</p>
        </div>

        <div class="procurement-table-scroll procurement-table-scroll--desktop">
            <table class="procurement-table">
                <thead>
                    <tr>
                        <th scope="col">Reference no.</th>
                        <th scope="col">Title</th>
                        <th scope="col">Category</th>
                        <th scope="col">Posting date</th>
                        <th scope="col">Closing date</th>
                        <th scope="col">Document</th>
                        <th scope="col">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($procurements as $p)
                        @php
                            $poFiles = is_array($p->po_files)
                                ? $p->po_files
                                : (!empty($p->po_file_url)
                                    ? [$p->po_file_url]
                                    : []);
                        @endphp
                        <tr class="procurement-table__row">
                            <td class="procurement-table__ref">{{ $p->reference_no }}</td>
                            <td class="procurement-table__title">{{ $p->title }}</td>
                            <td class="procurement-table__category">
                                <span class="procurement-chip">{{ $p->category }}</span>
                            </td>
                            <td class="procurement-table__date">{{ \Carbon\Carbon::parse($p->posting_date)->format('M j, Y') }}</td>
                            <td class="procurement-table__date">{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M j, Y') : '—' }}</td>
                            <td class="procurement-table__doc">
                                @if ($p->file_url)
                                    <a href="{{ $p->file_url }}" target="_blank" rel="noopener noreferrer"
                                        class="procurement-doc-link">Bid document</a>
                                @else
                                    —
                                @endif
                            </td>
                            <td class="procurement-table__status">
                                @if ($p->status === 'awarded')
                                    <span class="procurement-status procurement-status--awarded">Awarded</span>
                                    @foreach ($poFiles as $idx => $poUrl)
                                        <a href="{{ $poUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="procurement-doc-link procurement-doc-link--po">Purchase order{{ count($poFiles) > 1 ? ' ' . ($idx + 1) : '' }}</a>
                                    @endforeach
                                @else
                                    <span class="procurement-status procurement-status--pending">Pending</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="procurement-table__empty">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="procurement-cards">
            @forelse ($procurements as $p)
                @php
                    $poFiles = is_array($p->po_files)
                        ? $p->po_files
                        : (!empty($p->po_file_url)
                            ? [$p->po_file_url]
                            : []);
                @endphp
                <article class="procurement-card">
                    <div class="procurement-card__meta">
                        <span class="procurement-card__ref">{{ $p->reference_no }}</span>
                        <span class="procurement-chip">{{ $p->category }}</span>
                    </div>
                    <h2 class="procurement-card__title">{{ $p->title }}</h2>
                    <dl class="procurement-card__dates">
                        <div>
                            <dt>Posted</dt>
                            <dd>{{ \Carbon\Carbon::parse($p->posting_date)->format('M j, Y') }}</dd>
                        </div>
                        <div>
                            <dt>Closes</dt>
                            <dd>{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M j, Y') : '—' }}</dd>
                        </div>
                    </dl>
                    <div class="procurement-card__actions">
                        @if ($p->file_url)
                            <a href="{{ $p->file_url }}" target="_blank" rel="noopener noreferrer"
                                class="procurement-doc-link">Bid document</a>
                        @endif
                        @if ($p->status === 'awarded')
                            <span class="procurement-status procurement-status--awarded">Awarded</span>
                            @foreach ($poFiles as $idx => $poUrl)
                                <a href="{{ $poUrl }}" target="_blank" rel="noopener noreferrer"
                                    class="procurement-doc-link procurement-doc-link--po">Purchase order{{ count($poFiles) > 1 ? ' ' . ($idx + 1) : '' }}</a>
                            @endforeach
                        @else
                            <span class="procurement-status procurement-status--pending">Pending</span>
                        @endif
                    </div>
                </article>
            @empty
                <p class="procurement-empty">No records found.</p>
            @endforelse
        </div>

        @if ($procurements->hasPages())
            {{ $procurements->links('pagination.public') }}
        @endif
    </div>
@endsection
