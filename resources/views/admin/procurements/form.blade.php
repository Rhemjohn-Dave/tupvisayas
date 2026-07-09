@extends('layouts.admin')

@section('title', $procurement->id ? 'Admin — Edit procurement' : 'Admin — Add procurement')

@section('admin_content')
    @php
        $postingDate = old('posting_date', $procurement->posting_date);
        $closingDate = old('closing_date', $procurement->closing_date);

        if ($postingDate && !$postingDate instanceof \Illuminate\Support\Carbon) {
            $postingDate = \Illuminate\Support\Carbon::parse($postingDate)->format('Y-m-d');
        } elseif ($postingDate instanceof \Illuminate\Support\Carbon) {
            $postingDate = $postingDate->format('Y-m-d');
        }

        if ($closingDate && !$closingDate instanceof \Illuminate\Support\Carbon) {
            $closingDate = \Illuminate\Support\Carbon::parse($closingDate)->format('Y-m-d');
        } elseif ($closingDate instanceof \Illuminate\Support\Carbon) {
            $closingDate = $closingDate->format('Y-m-d');
        }

        $categories = ['Goods', 'Services', 'Infrastructure', 'Consulting'];
        $selectedType = old('type', $procurement->type ?: 'bid_opportunity');
        $selectedCategory = old('category', $procurement->category ?: 'Goods');
        $selectedStatus = old('status', $procurement->status ?? 'pending');
        $existingPoFiles = is_array($procurement->po_files)
            ? $procurement->po_files
            : (empty($procurement->po_file_url) ? [] : [$procurement->po_file_url]);
    @endphp

    <x-admin.page-header :title="$procurement->id ? 'Edit procurement' : 'Add procurement'"
        subtitle="Bid opportunities and PhilGEPS postings for the public site.">
        <x-slot name="actions">
            <a href="{{ route('admin.procurements.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to procurement
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form-card admin-form">
        <form method="POST"
            action="{{ $procurement->id ? route('admin.procurements.update', $procurement->id) : route('admin.procurements.store') }}"
            enctype="multipart/form-data">
            @csrf
            @if ($procurement->id)
                @method('PUT')
            @endif

            <div class="admin-form__group">
                <label class="admin-label" for="title">Title</label>
                <input class="admin-input" type="text" name="title" id="title"
                    value="{{ old('title', $procurement->title) }}" required>
                @error('title')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="reference_no">Reference number</label>
                <input class="admin-input" type="text" name="reference_no" id="reference_no"
                    value="{{ old('reference_no', $procurement->reference_no) }}" required>
                @error('reference_no')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="type">Type</label>
                <select class="admin-select browser-default" name="type" id="type" required>
                    <option value="bid_opportunity" {{ $selectedType === 'bid_opportunity' ? 'selected' : '' }}>
                        Bid opportunity
                    </option>
                    <option value="philgeps_posting" {{ $selectedType === 'philgeps_posting' ? 'selected' : '' }}>
                        PhilGEPS posting
                    </option>
                </select>
                @error('type')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="category">Category</label>
                <select class="admin-select browser-default" name="category" id="category" required>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ $selectedCategory === $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
                @error('category')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group admin-form__group--split">
                <div>
                    <label class="admin-label" for="posting_date">Posting date</label>
                    <input class="admin-input" type="date" name="posting_date" id="posting_date"
                        value="{{ $postingDate }}" required>
                    @error('posting_date')
                        <span class="admin-form__error">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="admin-label" for="closing_date">Closing date</label>
                    <input class="admin-input" type="date" name="closing_date" id="closing_date"
                        value="{{ $closingDate }}">
                    <p class="admin-form__hint">Optional for open postings.</p>
                    @error('closing_date')
                        <span class="admin-form__error">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="status">Status</label>
                <select class="admin-select browser-default" name="status" id="status" required>
                    <option value="pending" {{ $selectedStatus === 'pending' ? 'selected' : '' }}>
                        Pending
                    </option>
                    <option value="awarded" {{ $selectedStatus === 'awarded' ? 'selected' : '' }}>
                        Awarded
                    </option>
                </select>
                <p class="admin-form__hint">Awarded records require at least one purchase order file.</p>
                @error('status')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="file">Procurement document</label>
                <input class="admin-file" type="file" name="file" id="file"
                    accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                <p class="admin-form__hint">Optional for pending postings. PDF, Word, Excel, or PowerPoint · max 10 MB.</p>
                @if ($procurement->file_url)
                    <p class="admin-form__hint">
                        Current file:
                        <a href="{{ $procurement->file_url }}" target="_blank" rel="noopener noreferrer">Download</a>
                    </p>
                @endif
                @error('file')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="po_files">Purchase order files</label>
                <input class="admin-file" type="file" name="po_files[]" id="po_files" multiple
                    accept=".pdf,.doc,.docx,.xls,.xlsx">
                <p class="admin-form__hint">Required when status is Awarded. You can select multiple files.</p>
                @error('po_files')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
                @error('po_files.*')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
                @error('po_file')
                    <span class="admin-form__error">{{ $message }}</span>
                @enderror
            </div>

            @if (!empty($existingPoFiles) && $procurement->id)
                <div class="admin-form__group">
                    <span class="admin-label">Existing purchase orders</span>
                    <ul class="admin-po-list">
                        @foreach ($existingPoFiles as $idx => $poUrl)
                            <li class="admin-po-list__item">
                                <a href="{{ $poUrl }}" target="_blank" rel="noopener noreferrer">PO {{ $idx + 1 }}</a>
                                <button type="button" class="admin-btn admin-btn--icon admin-btn--danger"
                                    title="Remove PO file" aria-label="Remove PO file"
                                    onclick="deletePoFile({{ $procurement->id }}, {{ $idx }}, event)">
                                    <i class="material-icons" aria-hidden="true">delete</i>
                                </button>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    <i class="material-icons" aria-hidden="true">save</i>
                    {{ $procurement->id ? 'Save changes' : 'Create record' }}
                </button>
                <a href="{{ route('admin.procurements.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection

@section('admin_scripts')
    <script>
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
            }).then(function() {
                location.reload();
            });
        }
    </script>
@endsection
