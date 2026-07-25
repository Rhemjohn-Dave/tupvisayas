@extends('layouts.admin')

@section('title', 'Admin — Edit ' . $college->college)

@section('admin_content')
    <x-admin.page-header :title="'Edit academics: ' . $college->college"
        subtitle="Manage the public college page shown under Academics in the site menu.">
        <x-slot name="actions">
            <a href="{{ route('academics.show', $college->routeSlug()) }}" class="admin-btn admin-btn--ghost"
                target="_blank" rel="noopener noreferrer">
                <i class="material-icons" aria-hidden="true">open_in_new</i>
                View on site
            </a>
        </x-slot>
    </x-admin.page-header>

    <div class="admin-form--wide">
        <div class="uitc-tabs" data-uitc-tabs>
            <div class="uitc-tabs__nav" role="tablist" aria-label="College academics sections">
                <button type="button" class="uitc-tabs__btn is-active" role="tab" aria-selected="true"
                    aria-controls="admin-college-info" id="admin-college-tab-info"
                    data-uitc-tab="admin-college-info">College info</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="admin-college-history" id="admin-college-tab-history"
                    data-uitc-tab="admin-college-history">History</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="admin-college-courses" id="admin-college-tab-courses"
                    data-uitc-tab="admin-college-courses">Courses offered</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="admin-college-dept" id="admin-college-tab-dept"
                    data-uitc-tab="admin-college-dept">Department &amp; faculty</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="admin-college-board" id="admin-college-tab-board"
                    data-uitc-tab="admin-college-board">Board exam ratings</button>
            </div>

            {{-- College info: name, cover, public URL --}}
            <div id="admin-college-info" class="uitc-tabs__panel is-active" role="tabpanel"
                aria-labelledby="admin-college-tab-info">
                <div class="admin-form-card admin-form">
                    <form method="POST" action="{{ route('admin.college-pages.update', $college->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="section" value="info">
                        <input type="hidden" name="tab" value="admin-college-info">

                        <div class="admin-form__group">
                            <label class="admin-label" for="college">College name</label>
                            <input class="admin-input" type="text" name="college" id="college"
                                value="{{ old('college', $college->college) }}" required>
                            <p class="admin-form__hint">Shown in the Academics menu and as the page title on the public site.</p>
                            @error('college')
                                <span class="admin-form__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form__group">
                            <span class="admin-label">Public page URL</span>
                            <p class="admin-form__hint" style="margin-top:0;">
                                <a href="{{ route('academics.show', $college->routeSlug()) }}" target="_blank" rel="noopener noreferrer">
                                    {{ route('academics.show', $college->routeSlug()) }}
                                </a>
                            </p>
                        </div>

                        <div class="admin-form__group">
                            <label class="admin-label" for="cover_photo">Cover photo</label>
                            <input class="admin-file" type="file" name="cover_photo" id="cover_photo" accept="image/*">
                            @if ($college->cover_photo)
                                <img class="admin-preview-img" src="{{ asset('storage/' . $college->cover_photo) }}"
                                    alt="Current cover photo">
                            @endif
                            <x-admin.image-spec type="college-cover" />
                            @error('cover_photo')
                                <span class="admin-form__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form__actions">
                            <button type="submit" class="admin-btn admin-btn--primary">Save college info</button>
                            <a href="{{ route('admin.college-pages.index') }}" class="admin-btn admin-btn--ghost">Back to list</a>
                        </div>
                    </form>
                </div>
            </div>

            {{-- History --}}
            <div id="admin-college-history" class="uitc-tabs__panel" role="tabpanel"
                aria-labelledby="admin-college-tab-history" hidden>
                <div class="admin-form-card admin-form">
                    <form method="POST" action="{{ route('admin.college-pages.update', $college->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="section" value="history">
                        <input type="hidden" name="tab" value="admin-college-history">

                        <div class="admin-form__group">
                            <label class="admin-label" for="history">History</label>
                            <textarea name="history" id="history"
                                class="admin-textarea wysiwyg">{{ old('history', $college->history) }}</textarea>
                            @error('history')
                                <span class="admin-form__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form__actions">
                            <button type="submit" class="admin-btn admin-btn--primary">Save history</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Courses --}}
            <div id="admin-college-courses" class="uitc-tabs__panel" role="tabpanel"
                aria-labelledby="admin-college-tab-courses" hidden>
                <div class="admin-form__actions admin-form__actions--toolbar">
                    <a href="{{ route('admin.courses.create', ['college_page_id' => $college->id]) }}"
                        class="admin-btn admin-btn--primary">
                        <i class="material-icons" aria-hidden="true">add</i>
                        Add course
                    </a>
                </div>

                <div class="admin-table-card">
                    <div class="admin-table-scroll">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col" class="admin-table__actions">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($college->courses as $course)
                                    <tr>
                                        <td class="admin-table__cell-title" title="{{ $course->name }}">{{ $course->name }}</td>
                                        <td>{{ \Illuminate\Support\Str::limit(strip_tags($course->description), 80) ?: '—' }}</td>
                                        <td class="admin-table__actions">
                                            <div class="admin-actions-row">
                                                <a href="{{ route('admin.courses.edit', $course->id) }}"
                                                    class="admin-btn admin-btn--icon admin-btn--secondary" title="Edit course"
                                                    aria-label="Edit course">
                                                    <i class="material-icons" aria-hidden="true">edit</i>
                                                </a>
                                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                                    class="admin-inline-form"
                                                    onsubmit="return confirm('Delete this course and its department?');">
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
                                        <td colspan="3" class="admin-table__empty">No courses yet. Add a course to create its department.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Departments & faculty --}}
            <div id="admin-college-dept" class="uitc-tabs__panel" role="tabpanel"
                aria-labelledby="admin-college-tab-dept" hidden>
                <p class="admin-form__hint" style="margin-bottom:var(--admin-space-4);">
                    Each course creates a matching department. Rename departments here or manage faculty below.
                </p>

                @forelse($college->departments as $department)
                    <details class="admin-accordion" @if($loop->first) open @endif>
                        <summary class="admin-accordion__summary">{{ $department->name }}</summary>
                        <div class="admin-accordion__body">
                            <form method="POST" action="{{ route('admin.departments.update', $department->id) }}"
                                class="admin-dept-rename">
                                @csrf
                                @method('PUT')
                                <div class="admin-form__group" style="margin-bottom:var(--admin-space-4);">
                                    <label class="admin-label" for="dept-name-{{ $department->id }}">Department name</label>
                                    <div class="admin-dept-rename__row">
                                        <input class="admin-input" type="text" name="name"
                                            id="dept-name-{{ $department->id }}"
                                            value="{{ old('name', $department->name) }}" required>
                                        <button type="submit" class="admin-btn admin-btn--secondary">Save</button>
                                    </div>
                                </div>

                                <div class="admin-form__group" style="margin-bottom:var(--admin-space-4);">
                                    <label class="admin-label" for="dept-head-{{ $department->id }}">Program head</label>
                                    <select class="admin-select browser-default" name="head_faculty_id"
                                        id="dept-head-{{ $department->id }}">
                                        <option value="">— Not assigned —</option>
                                        @foreach ($department->faculties as $faculty)
                                            <option value="{{ $faculty->id }}"
                                                @selected((string) old('head_faculty_id', $department->head_faculty_id) === (string) $faculty->id)>
                                                {{ $faculty->name }}@if ($faculty->rank) — {{ $faculty->rank }}@endif
                                            </option>
                                        @endforeach
                                    </select>
                                    <p class="admin-form__hint">
                                        Shown on the college Programs tab, Faculty tab, and the program page.
                                        Add faculty below first if the list is empty.
                                    </p>
                                </div>
                            </form>

                            <div class="admin-accordion__actions">
                                <a href="{{ route('admin.faculties.create', ['department_id' => $department->id]) }}"
                                    class="admin-btn admin-btn--primary">
                                    <i class="material-icons" aria-hidden="true">person_add</i>
                                    Add faculty
                                </a>
                            </div>

                            @if ($department->faculties->count())
                                <div class="admin-table-card">
                                    <div class="admin-table-scroll">
                                        <table class="admin-table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Photo</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Rank</th>
                                                    <th scope="col" class="admin-table__actions">Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($department->faculties as $faculty)
                                                    <tr>
                                                        <td>
                                                            @if ($faculty->photo)
                                                                <img src="{{ asset('storage/' . $faculty->photo) }}" alt=""
                                                                    width="48" height="48"
                                                                    style="object-fit:cover;border-radius:4px;border:1px solid var(--color-border);">
                                                            @else
                                                                —
                                                            @endif
                                                        </td>
                                                        <td class="admin-table__cell-title">
                                                            {{ $faculty->name }}
                                                            @if ((int) $department->head_faculty_id === (int) $faculty->id)
                                                                <span class="admin-badge" style="margin-left:0.35rem;">Program head</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $faculty->rank ?: '—' }}</td>
                                                        <td class="admin-table__actions">
                                                            <div class="admin-actions-row">
                                                                <a href="{{ route('admin.faculties.edit', $faculty->id) }}"
                                                                    class="admin-btn admin-btn--icon admin-btn--secondary"
                                                                    title="Edit" aria-label="Edit">
                                                                    <i class="material-icons" aria-hidden="true">edit</i>
                                                                </a>
                                                                <form action="{{ route('admin.faculties.destroy', $faculty->id) }}"
                                                                    method="POST" class="admin-inline-form"
                                                                    onsubmit="return confirm('Delete this faculty member?');">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="admin-btn admin-btn--icon admin-btn--danger"
                                                                        title="Delete" aria-label="Delete">
                                                                        <i class="material-icons" aria-hidden="true">delete</i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @else
                                <p class="admin-form__hint">No faculty listed for this department.</p>
                            @endif
                        </div>
                    </details>
                @empty
                    <p class="admin-form__hint">No departments yet. Add a course under the Courses offered tab first.</p>
                @endforelse
            </div>

            {{-- Board exam ratings --}}
            <div id="admin-college-board" class="uitc-tabs__panel" role="tabpanel"
                aria-labelledby="admin-college-tab-board" hidden>
                <div class="admin-form-card admin-form">
                    <form method="POST" action="{{ route('admin.college-pages.update', $college->id) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="section" value="board_exam_ratings">
                        <input type="hidden" name="tab" value="admin-college-board">

                        <p class="admin-form__hint" style="margin-bottom:var(--admin-space-4);">
                            Publish college-level licensure / board exam results shown on the public Board exam ratings tab.
                            Program-specific board notes can still live on each course’s Board performance field.
                        </p>

                        <div class="admin-form__group">
                            <label class="admin-label" for="board_exam_ratings">Board exam ratings</label>
                            <textarea name="board_exam_ratings" id="board_exam_ratings"
                                class="admin-textarea wysiwyg">{{ old('board_exam_ratings', $college->board_exam_ratings) }}</textarea>
                            @error('board_exam_ratings')
                                <span class="admin-form__error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="admin-form__actions">
                            <button type="submit" class="admin-btn admin-btn--primary">Save board exam ratings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var root = document.querySelector('[data-uitc-tabs]');
            if (!root) return;

            var buttons = root.querySelectorAll('[data-uitc-tab]');
            var panels = root.querySelectorAll('.uitc-tabs__panel');

            function activateTab(targetId) {
                var button = root.querySelector('[data-uitc-tab="' + targetId + '"]');
                if (!button) return;

                buttons.forEach(function(btn) {
                    btn.classList.remove('is-active');
                    btn.setAttribute('aria-selected', 'false');
                });

                panels.forEach(function(panel) {
                    panel.classList.remove('is-active');
                    panel.hidden = true;
                });

                button.classList.add('is-active');
                button.setAttribute('aria-selected', 'true');

                var panel = document.getElementById(targetId);
                if (panel) {
                    panel.classList.add('is-active');
                    panel.hidden = false;
                }
            }

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    var targetId = button.getAttribute('data-uitc-tab');
                    activateTab(targetId);

                    var url = new URL(window.location.href);
                    url.searchParams.set('tab', targetId);
                    window.history.replaceState({}, '', url);
                });
            });

            var params = new URLSearchParams(window.location.search);
            var tab = params.get('tab');
            if (tab) {
                activateTab(tab);
            }
        });
    </script>
@endsection
