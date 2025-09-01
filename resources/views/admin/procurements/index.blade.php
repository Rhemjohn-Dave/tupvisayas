@extends('layouts.admin')

@section('title', 'Admin - Procurement')

@section('admin_content')
    <div class="row" style="align-items:center;">
        <div class="col s12 m8">
            <h5 class="red-text text-darken-2">Procurements</h5>
        </div>
        <div class="col s12 m4 right-align">
            <a href="{{ route('admin.procurements.create') }}" class="btn waves-effect waves-light white-text red">
                <i class="material-icons left">add</i> Add New Procurement
            </a>
        </div>
    </div>

    @if(session('status'))
        <div class="card-panel green lighten-4 green-text text-darken-4">{{ session('status') }}</div>
    @endif

    <div class="responsive-table" style="overflow-x:auto;">
        <table class="highlight striped">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Ref No.</th>
                    <th>Category</th>
                    <th>Posting Date</th>
                    <th>Closing Date</th>
                    <th>Type</th>
                    <th>File</th>
                    <th class="right-align">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($procurements as $p)
                    <tr>
                        <td>{{ $p->title }}</td>
                        <td>{{ $p->reference_no }}</td>
                        <td>{{ $p->category }}</td>
                        <td>{{ \Carbon\Carbon::parse($p->posting_date)->format('M d, Y') }}</td>
                        <td>{{ $p->closing_date ? \Carbon\Carbon::parse($p->closing_date)->format('M d, Y') : '—' }}
                        </td>
                        <td>{{ $p->type === 'bid_opportunity' ? 'Bid Opportunity' : 'PhilGEPS Posting' }}</td>
                        <td>
                            @if($p->file_url)
                                <a href="{{ $p->file_url }}" target="_blank" class="btn-flat"><i
                                        class="material-icons">file_download</i></a>
                            @endif
                        </td>
                        <td class="right-align">
                            <a href="{{ route('admin.procurements.edit', $p->id) }}" class="btn-small waves-effect">Edit</a>
                            <form action="{{ route('admin.procurements.destroy', $p->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small red lighten-1 waves-effect"
                                    onclick="return confirm('Delete this record?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="center-align">No records found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">{{ $procurements->links() }}</div>

@endsection