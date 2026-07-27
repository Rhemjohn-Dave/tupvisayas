@extends('layouts.admin')

@section('title', $user->id ? 'Admin — Edit user' : 'Admin — Add user')

@section('admin_content')
    <x-admin.page-header
        :title="$user->id ? 'Edit user' : 'Add user'"
        subtitle="Assign one or more roles. Each role controls what the user can post or manage after login.">
        <x-slot name="actions">
            <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn--ghost">
                <i class="material-icons" aria-hidden="true">arrow_back</i>
                Back to users
            </a>
        </x-slot>
    </x-admin.page-header>

    @if ($errors->any())
        <div class="admin-flash" role="alert" style="background:#fdeeee;color:#9e1b32;border:1px solid rgba(158,27,50,0.18);">
            <ul style="margin:0;padding-left:1.1rem;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="admin-form-card admin-form admin-form--narrow">
        <form action="{{ $user->id ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
            @csrf
            @if ($user->id)
                @method('PUT')
            @endif

            <div class="admin-form__group">
                <label class="admin-label" for="name">Name</label>
                <input class="admin-input" id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="email">Email</label>
                <input class="admin-input" id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
            </div>

            <div class="admin-form__group">
                <label class="admin-label" for="password">
                    Password{{ $user->id ? ' (leave blank to keep current)' : '' }}
                </label>
                <input class="admin-input" id="password" name="password" type="password" {{ $user->id ? '' : 'required' }}>
            </div>

            @php
                $selectedRoles = collect(old('roles', $user->exists ? $user->roles->pluck('name')->all() : []));
            @endphp

            <div class="admin-panel" style="margin:0 0 1.25rem;box-shadow:none;">
                <h3 class="admin-panel__title">Roles</h3>
                <p class="admin-panel__text">
                    Example: <strong>News Editor</strong> can only manage posts;
                    <strong>Procurement Officer</strong> can only manage bidding / PhilGEPS.
                </p>
                <div style="display:grid;gap:0.85rem;">
                    @foreach ($roles as $role)
                        <label class="admin-checkbox" for="role-{{ $role->id }}">
                            <input
                                type="checkbox"
                                id="role-{{ $role->id }}"
                                name="roles[]"
                                value="{{ $role->name }}"
                                {{ $selectedRoles->contains($role->name) ? 'checked' : '' }}>
                            <span>
                                <strong>{{ $role->name }}</strong>
                                <span class="admin-panel__text" style="margin:0.2rem 0 0;display:block;">
                                    {{ $role->permissions->pluck('name')->map(fn ($p) => \App\Support\CmsPermissions::labels()[$p] ?? $p)->implode(' · ') }}
                                </span>
                            </span>
                        </label>
                    @endforeach
                </div>
            </div>

            <div class="admin-form__actions">
                <button type="submit" class="admin-btn admin-btn--primary">
                    {{ $user->id ? 'Update user' : 'Save user' }}
                </button>
                <a href="{{ route('admin.users.index') }}" class="admin-btn admin-btn--ghost">Cancel</a>
            </div>
        </form>
    </div>
@endsection
