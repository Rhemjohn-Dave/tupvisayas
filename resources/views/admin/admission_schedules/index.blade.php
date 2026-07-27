@extends('layouts.admin')

@section('title', 'Admin — Admission test schedules')

@section('admin_content')
    <x-admin.page-header title="Admission test schedules"
        subtitle="Manage TUPSTAT exam dates and the homepage admission promo.">
        <x-slot name="actions">
            <a href="{{ route('admissions.enrollment') }}" class="admin-btn admin-btn--ghost" target="_blank" rel="noopener noreferrer">
                <i class="material-icons" aria-hidden="true">open_in_new</i>
                View on site
            </a>
            <a href="{{ route('admin.admission-schedules.create') }}" class="admin-btn admin-btn--primary">
                <i class="material-icons" aria-hidden="true">add</i>
                Add schedule
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-panel">
        <form method="POST" action="{{ route('admin.admission-promo.update') }}">
            @csrf
            @method('PUT')
            <h3 class="admin-panel__title">Homepage TUPSTAT promo</h3>
            <p class="admin-panel__text">
                When enabled, the homepage hero shows the TUPSTAT admission message over the carousel.
                Exam dates still come from the published schedules below.
                @if ($publishedCount === 0)
                    <strong>No published schedules yet</strong> — visitors will still see the promo if this is on, with dates marked as to be posted on the admissions page.
                @else
                    <strong>{{ $publishedCount }}</strong> published schedule{{ $publishedCount === 1 ? '' : 's' }} currently available.
                @endif
            </p>
            <label class="admin-checkbox" for="tupstat_hero_enabled">
                <input type="checkbox" name="tupstat_hero_enabled" id="tupstat_hero_enabled" value="1"
                    {{ old('tupstat_hero_enabled', $tupstatHeroEnabled) ? 'checked' : '' }}>
                <span>Show TUPSTAT promo on homepage hero</span>
            </label>
            <div style="margin-top:1rem;">
                <button type="submit" class="admin-btn admin-btn--primary">Save promo setting</button>
            </div>
        </form>
    </div>

    <div class="admin-section-head">
        <h2 class="site-section-title admin-section-title">Schedules</h2>
    </div>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Venue</th>
                        <th scope="col">Status</th>
                        <th scope="col" class="admin-table__actions">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($schedules as $schedule)
                        <tr>
                            <td class="admin-table__cell-title">{{ $schedule->displayDate() }}</td>
                            <td>{!! nl2br(e($schedule->times)) !!}</td>
                            <td>
                                {{ $schedule->venue }}
                                @if ($schedule->venue_note)
                                    <br><span class="admin-panel__text" style="margin:0;display:inline-block;">{{ $schedule->venue_note }}</span>
                                @endif
                            </td>
                            <td>
                                @if ($schedule->is_published)
                                    <span class="admin-badge admin-badge--published">Published</span>
                                @else
                                    <span class="admin-badge admin-badge--draft">Draft</span>
                                @endif
                            </td>
                            <td class="admin-table__actions">
                                <div class="admin-actions-row">
                                    <a href="{{ route('admin.admission-schedules.edit', $schedule) }}"
                                        class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit" aria-label="Edit">
                                        <i class="material-icons" aria-hidden="true">edit</i>
                                    </a>
                                    <form action="{{ route('admin.admission-schedules.destroy', $schedule) }}" method="POST"
                                        class="admin-inline-form" onsubmit="return confirm('Delete this schedule?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="admin-btn admin-btn--icon admin-btn--danger"
                                            title="Delete" aria-label="Delete">
                                            <i class="material-icons" aria-hidden="true">delete</i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="admin-table__empty">No admission test schedules yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($schedules->hasPages())
            <div class="admin-pagination-wrap">
                {{ $schedules->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
