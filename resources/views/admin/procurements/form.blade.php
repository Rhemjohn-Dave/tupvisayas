@extends('layouts.admin')

@section('title', 'Admin - Procurement')

@section('admin_content')
<div class="section" style="max-width: 900px;">
    <h5 class="red-text text-darken-2">{{ $procurement->id ? 'Edit Procurement' : 'Add Procurement' }}</h5>

    @if ($errors->any())
        <div class="card-panel red lighten-4 red-text text-darken-4">
            <ul style="margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form
        action="{{ $procurement->id ? route('admin.procurements.update', $procurement->id) : route('admin.procurements.store') }}"
        method="POST" enctype="multipart/form-data">
        @csrf
        @if($procurement->id)
            @method('PUT')
        @endif

        <div class="input-field">
            <input id="title" name="title" type="text" value="{{ old('title', $procurement->title) }}" required>
            <label for="title">Title</label>
        </div>

        <div class="input-field">
            <input id="reference_no" name="reference_no" type="text"
                value="{{ old('reference_no', $procurement->reference_no) }}" required>
            <label for="reference_no">Reference No.</label>
        </div>

        <div class="input-field">
            <select name="category" required>
                @php($categories = ['Goods', 'Services', 'Infrastructure', 'Consulting'])
                <option value="" disabled {{ old('category', $procurement->category) ? '' : 'selected' }}>Choose
                    category</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category', $procurement->category) === $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            <label>Category</label>
        </div>

        <div class="row">
            <div class="input-field col s12 m6">
                <input id="posting_date" name="posting_date" type="text" class="datepicker"
                    value="{{ old('posting_date', $procurement->posting_date) }}" required>
                <label for="posting_date">Posting Date</label>
            </div>
            <div class="input-field col s12 m6">
                <input id="closing_date" name="closing_date" type="text" class="datepicker"
                    value="{{ old('closing_date', $procurement->closing_date) }}">
                <label for="closing_date">Closing Date</label>
            </div>
        </div>

        <div class="file-field input-field">
            <div class="btn red">
                <span>File</span>
                <input type="file" name="file">
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload procurement file">
            </div>
            @if($procurement->file_url)
                <p style="margin-top:8px;">Current: <a href="{{ $procurement->file_url }}" target="_blank">Download</a>
                </p>
            @endif
        </div>

        <div class="input-field">
            <select name="status" required>
                <option value="pending" {{ old('status', $procurement->status ?? 'pending') === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="awarded" {{ old('status', $procurement->status ?? 'pending') === 'awarded' ? 'selected' : '' }}>Awarded</option>
            </select>
            <label>Status</label>
        </div>

        <div class="file-field input-field">
            <div class="btn red">
                <span>Purchase Orders</span>
                <input type="file" name="po_files[]" multiple>
            </div>
            <div class="file-path-wrapper">
                <input class="file-path validate" type="text" placeholder="Upload one or more PO files">
            </div>
        </div>

        @php($existingPoFiles = is_array($procurement->po_files) ? $procurement->po_files : (empty($procurement->po_file_url) ? [] : [$procurement->po_file_url]))
        @if(!empty($existingPoFiles))
            <div style="margin-top:8px;">
                <span>Existing PO files:</span>
                <ul style="margin:6px 0 0 16px;">
                    @foreach($existingPoFiles as $idx => $poUrl)
                        <li style="display:flex;align-items:center;gap:8px;">
                            <a href="{{ $poUrl }}" target="_blank">PO {{ $idx + 1 }}</a>
                            <button type="button" class="btn-flat red-text" title="Remove"
                                onclick="deletePoFile({{ $procurement->id }}, {{ $idx }}, event)">
                                <i class="material-icons">close</i>
                            </button>
                        </li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="input-field">
            <select name="type" required>
                <option value="" disabled {{ old('type', $procurement->type) ? '' : 'selected' }}>Choose type
                </option>
                <option value="bid_opportunity" {{ old('type', $procurement->type) === 'bid_opportunity' ? 'selected' : '' }}>Bid Opportunity</option>
                <option value="philgeps_posting" {{ old('type', $procurement->type) === 'philgeps_posting' ? 'selected' : '' }}>PhilGEPS Posting</option>
            </select>
            <label>Type</label>
        </div>

        <div class="section right-align">
            <a href="{{ route('admin.procurements.index') }}" class="btn-flat">Cancel</a>
            <button type="submit" class="btn waves-effect waves-light red">Save</button>
        </div>
    </form>
</div>
</div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Materialize form elements
            var selects = document.querySelectorAll('select');
            M.FormSelect.init(selects);
            var pickers = document.querySelectorAll('.datepicker');
            M.Datepicker.init(pickers, { format: 'yyyy-mm-dd' });
        });

        function deletePoFile(id, index, evt) {
            evt.preventDefault();
            evt.stopPropagation();
            if (!confirm('Delete this PO file?')) return;
            fetch(`{{ url('admin/procurements') }}/${id}/po`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': `{{ csrf_token() }}`,
                    'Content-Type': 'application/x-www-form-urlencoded;charset=UTF-8',
                    'Accept': 'text/html',
                },
                credentials: 'same-origin',
                body: new URLSearchParams({
                    _method: 'DELETE',
                    index: String(index),
                })
            }).then(() => {
                location.reload();
            });
        }
    </script>
@endsection