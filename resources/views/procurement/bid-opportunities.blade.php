@extends('layouts.app')

@section('title', 'Procurement - Bid Opportunities')

@section('content')
    <div class="section site-page site-page--procurement">
        <h1 class="site-page-title site-page-title--center">Bid opportunities</h1>
        <p class="site-page-intro">Public bidding notices and procurement documents from TUP Visayas.</p>

        <div class="news-layout">
            <main class="procurement-main">
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
                                <tr>
                                    <td class="procurement-table__ref">{{ $p->reference_no }}</td>
                                    <td class="procurement-table__title">{{ $p->title }}</td>
                                    <td>{{ $p->category }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->posting_date)->format('M j, Y') }}</td>
                                    <td>{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M j, Y') : '—' }}</td>
                                    <td>
                                        <a href="{{ $p->file_url }}" target="_blank" rel="noopener noreferrer"
                                            class="procurement-doc-link">Download PDF</a>
                                    </td>
                                    <td>
                                        @if ($p->status === 'awarded')
                                            <span class="procurement-status procurement-status--awarded">Awarded</span>
                                            @foreach ($poFiles as $idx => $poUrl)
                                                <a href="{{ $poUrl }}" target="_blank" rel="noopener noreferrer"
                                                    class="procurement-doc-link procurement-doc-link--po">PO{{ count($poFiles) > 1 ? ' ' . ($idx + 1) : '' }}</a>
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
                                <span>{{ $p->category }}</span>
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
                                <a href="{{ $p->file_url }}" target="_blank" rel="noopener noreferrer"
                                    class="procurement-doc-link">Download PDF</a>
                                @if ($p->status === 'awarded')
                                    <span class="procurement-status procurement-status--awarded">Awarded</span>
                                    @foreach ($poFiles as $idx => $poUrl)
                                        <a href="{{ $poUrl }}" target="_blank" rel="noopener noreferrer"
                                            class="procurement-doc-link procurement-doc-link--po">PO{{ count($poFiles) > 1 ? ' ' . ($idx + 1) : '' }}</a>
                                    @endforeach
                                @else
                                    <span class="procurement-status procurement-status--pending">Pending</span>
                                @endif
                            </div>
                        </article>
                    @empty
                        <p class="procurement-empty">No records found{{ request('q') || request('category') ? ' for your filters' : '' }}.</p>
                    @endforelse
                </div>

                @if ($procurements->hasPages())
                    <nav class="procurement-pagination" aria-label="Pagination">
                        {{ $procurements->links() }}
                    </nav>
                @endif
            </main>

            @include('procurement.partials.sidebar', [
                'filterRoute' => 'procurement.bid',
                'categories' => $categories,
                'otherLink' => [
                    'route' => 'procurement.philgeps',
                    'label' => 'View PhilGEPS posting',
                ],
            ])
        </div>
    </div>
@endsection
