@extends('layouts.app')

@section('title', 'Procurement - Bid Opportunities')

@section('content')
<div class="container" style="max-width: 1200px;">
    <div class="section">
        <h4 class="red-text text-darken-2">Bid Opportunities</h4>
        <div class="row">
            <form method="GET" class="col s12">
                <div class="row" style="margin-bottom: 0;">
                    <div class="input-field col s12 m6">
                        <i class="material-icons prefix">search</i>
                        <input id="q" name="q" type="text" value="{{ request('q') }}"
                            placeholder="Search title or reference no.">
                        <label for="q">Search</label>
                    </div>
                    <div class="input-field col s12 m4">
                        <select name="category" onchange="this.form.submit()">
                            <option value="" {{ request('category') == '' ? 'selected' : '' }}>All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}
                                </option>
                            @endforeach
                        </select>
                        <label>Category</label>
                    </div>
                    <div class="input-field col s12 m2">
                        <button class="btn waves-effect waves-light red" type="submit" style="width:100%">
                            Filter
                        </button>
                    </div>
                </div>
            </form>
        </div>

        {{-- Desktop Table --}}
        <div class="hide-on-small-only">
            <table class="highlight striped responsive-table">
                <thead>
                    <tr>
                        <th>Reference No.</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Posting Date</th>
                        <th>Closing Date</th>
                        <th>File</th>
                        <th>Remarks</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($procurements as $p)
                    <tr>
                        <td>{{ $p->reference_no }}</td>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->category }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->posting_date)->format('M d, Y') }}</td>
                        <td>{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M d, Y') : '—' }}
                        </td>
                        <td>
                            <a href="{{ $p->file_url }}" target="_blank" download class="btn-flat"
                                title="Download (PDF)" aria-label="Download file">
                                <i class="material-icons red-text">picture_as_pdf</i>
                            </a>
                        </td>
                        <td>
                            @if($p->status === 'awarded')
                            <span class="new badge green" data-badge-caption="Awarded"></span>
                            @php($poFiles = is_array($p->po_files) ? $p->po_files : (!empty($p->po_file_url) ? [$p->po_file_url] : []))
                                @foreach($poFiles as $idx => $poUrl)
                                    <a href="{{ $poUrl }}" target="_blank" class="btn-flat"
                                        title="Purchase Order {{ $idx + 1 }}">
                                        <i class="material-icons">attach_file</i>
                                    </a>
                                @endforeach
                            @else
                            <span class="new badge grey" data-badge-caption="Pending"></span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="center-align">No records found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="section">{{ $procurements->links() }}</div>
        </div>

        {{-- Mobile Cards --}}
        <div class="row hide-on-med-and-up">
            @forelse($procurements as $p)
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <span class="card-title" style="font-size:1.2rem;">{{ $p->title }}</span>
                        <p><b>Ref:</b> {{ $p->reference_no }}</p>
                        <p><b>Category:</b> {{ $p->category }}</p>
                        <p><b>Posting:</b> {{ \Carbon\Carbon::parse($p->posting_date)->format('M d, Y') }}</p>
                        <p><b>Closing:</b>
                            {{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M d, Y') : '—' }}</p>
                        <p><b>Remarks:</b> {{ $p->status === 'awarded' ? 'Awarded' : 'Pending' }}</p>
                    </div>
                    <div class="card-action">
                        <a href="{{ $p->file_url }}" target="_blank" download class="btn-flat" title="Download (PDF)"
                            aria-label="Download file">
                            <i class="material-icons red-text">picture_as_pdf</i>
                        </a>
                        @if($p->status === 'awarded')
                        @php($poFiles = is_array($p->po_files) ? $p->po_files : (!empty($p->po_file_url) ? [$p->po_file_url] : []))
                        <span class="right">
                            @foreach($poFiles as $idx => $poUrl)
                                <a href="{{ $poUrl }}" target="_blank" class="btn-flat"
                                    title="Purchase Order {{ $idx + 1 }}">
                                    <i class="material-icons">attach_file</i>
                                </a>
                            @endforeach
                        </span>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="col s12 center-align grey-text">No records found.</div>
            @endforelse
            <div class="col s12 section">{{ $procurements->links() }}</div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('select');
            M.FormSelect.init(elems);
        });
    </script>
@endsection