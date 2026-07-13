@extends('layouts.admin')

@section('title', $schedule->id ? 'Admin — Edit admission schedule' : 'Admin — Add admission schedule')

@section('admin_content')
    @php
        $examDate = old('exam_date', $schedule->exam_date);
        if ($examDate instanceof \Illuminate\Support\Carbon) {
            $examDate = $examDate->format('Y-m-d');
        }
    @endphp

    <x-admin.page-header :title="$schedule->id ? 'Edit admission schedule' : 'Add admission schedule'"
        subtitle="Appears in the Admission test schedule table on the enrollment page.">
        <x-slot name="actions">
            <a href="{{ route('admin.admission-schedules.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to schedules
            </a>
        </x-slot>
    </x-admin.page-header>

    @if ($errors->any())
        <div class="card-panel red lighten-4 red-text text-darken-4" style="margin-bottom:1rem;">
            <ul style="margin:0;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-form-card admin-form">
        <form method="POST"
            action="{{ $schedule->id ? route('admin.admission-schedules.update', $schedule) : route('admin.admission-schedules.store') }}">
            @csrf
            @if ($schedule->id)
                @method('PUT')
            @endif

            <div class="admin-form__group">
                <label class="admin-label" for="exam_date">Exam date</label>
                <input class="admin-input" type="date" name="exam_date" id="exam_date"
                    value="{{ $examDate }}" required>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="times">Time(s)</label>
                <textarea class="admin-input" name="times" id="times" rows="3" required
                    placeholder="8 AM&#10;1 PM">{{ old('times', $schedule->times) }}</textarea>
                <p class="grey-text text-darken-1" style="margin:0.35rem 0 0; font-size:0.85rem;">
                    Put each session on its own line (e.g. 8 AM then 1 PM).
                </p>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="venue">Venue</label>
                <input class="admin-input" type="text" name="venue" id="venue"
                    value="{{ old('venue', $schedule->venue) }}" required>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="venue_note">Venue note (optional)</label>
                <input class="admin-input" type="text" name="venue_note" id="venue_note"
                    value="{{ old('venue_note', $schedule->venue_note) }}"
                    placeholder="Exclusive to their SHS students only">
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="address">Address</label>
                <textarea class="admin-input" name="address" id="address" rows="2" required>{{ old('address', $schedule->address) }}</textarea>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="sort_order">Sort order</label>
                <input class="admin-input" type="number" name="sort_order" id="sort_order" min="0"
                    value="{{ old('sort_order', $schedule->sort_order ?? 0) }}">
                <p class="grey-text text-darken-1" style="margin:0.35rem 0 0; font-size:0.85rem;">
                    Used when two rows share the same date. Schedules are ordered by date first.
                </p>
            </div>

            <div class="admin-form__group">
                <label>
                    <input type="checkbox" class="filled-in" name="is_published" value="1"
                        {{ old('is_published', $schedule->is_published ?? true) ? 'checked' : '' }} />
                    <span>Published (visible on the public site)</span>
                </label>
            </div>

            <div class="admin-form__actions" style="display:flex; gap:0.75rem; flex-wrap:wrap;">
                <button type="submit" class="admin-btn admin-btn--primary">
                    {{ $schedule->id ? 'Update schedule' : 'Save schedule' }}
                </button>
                <a href="{{ route('admin.admission-schedules.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
