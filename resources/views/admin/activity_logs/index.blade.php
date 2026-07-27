@extends('layouts.admin')

@section('title', 'Admin — Activity logs')

@section('admin_content')
    <x-admin.page-header title="Activity logs" subtitle="Audit trail of admin and content changes (RA 10173 accountability).">
    </x-admin.page-header>

    <form class="admin-toolbar" method="GET" action="{{ route('admin.activity-logs.index') }}">
        <div>
            <label class="admin-label" for="q">Search</label>
            <input class="admin-input" type="search" name="q" id="q" value="{{ request('q') }}" placeholder="Description…">
        </div>
        <div>
            <label class="admin-label" for="log">Log</label>
            <select class="admin-select browser-default" name="log" id="log">
                <option value="">All</option>
                @foreach ($logNames as $name)
                    <option value="{{ $name }}" @selected(request('log') === $name)>{{ $name }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="admin-label" for="event">Event</label>
            <select class="admin-select browser-default" name="event" id="event">
                <option value="">All</option>
                @foreach (['created', 'updated', 'deleted', 'login', 'logout'] as $event)
                    <option value="{{ $event }}" @selected(request('event') === $event)>{{ $event }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="admin-btn admin-btn--primary">Filter</button>
        <a href="{{ route('admin.activity-logs.index') }}" class="admin-btn admin-btn--ghost">Reset</a>
    </form>

    <div class="admin-table-card">
        <div class="admin-table-scroll">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th scope="col">When</th>
                        <th scope="col">Actor</th>
                        <th scope="col">Log</th>
                        <th scope="col">Event</th>
                        <th scope="col">Description</th>
                        <th scope="col">Subject</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($activities as $activity)
                        <tr>
                            <td>
                                <time datetime="{{ $activity->created_at?->toIso8601String() }}">
                                    {{ $activity->created_at?->format('M j, Y g:i A') }}
                                </time>
                            </td>
                            <td>{{ $activity->causer?->name ?? 'System' }}</td>
                            <td>{{ $activity->log_name ?? '—' }}</td>
                            <td>
                                <span class="admin-badge admin-badge--draft">{{ $activity->event ?? '—' }}</span>
                            </td>
                            <td class="admin-table__cell-title" title="{{ $activity->description }}">
                                {{ \Illuminate\Support\Str::limit($activity->description, 80) }}
                            </td>
                            <td>
                                @if ($activity->subject_type)
                                    {{ class_basename($activity->subject_type) }}
                                    @if ($activity->subject_id)
                                        #{{ $activity->subject_id }}
                                    @endif
                                @else
                                    —
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="admin-table__empty">No activity recorded yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if ($activities->hasPages())
            <div class="admin-pagination-wrap">
                {{ $activities->links('pagination.admin') }}
            </div>
        @endif
    </div>
@endsection
