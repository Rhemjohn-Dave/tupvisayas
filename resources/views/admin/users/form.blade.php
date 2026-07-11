@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('admin_content')
    <div class="section">
        <h4 style="color:#C41E3A; font-weight:700;">{{ $user->id ? 'Edit User' : 'Add User' }}</h4>
        <p class="grey-text text-darken-1" style="margin-top:0;">
            Assign one or more roles. Each role controls what the user can post or manage after login.
        </p>

        @if ($errors->any())
            <div class="card-panel red lighten-4 red-text text-darken-4">
                <ul style="margin:0;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ $user->id ? route('admin.users.update', $user->id) : route('admin.users.store') }}" method="POST">
            @csrf
            @if($user->id)
                @method('PUT')
            @endif

            <div class="input-field">
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}" required>
                <label for="name">Name</label>
            </div>

            <div class="input-field">
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}" required>
                <label for="email">Email</label>
            </div>

            <div class="input-field">
                <input id="password" name="password" type="password" {{ $user->id ? '' : 'required' }}>
                <label for="password">Password {{ $user->id ? '(leave blank to keep current)' : '' }}</label>
            </div>

            @php
                $selectedRoles = collect(old('roles', $user->exists ? $user->roles->pluck('name')->all() : []));
            @endphp

            <fieldset style="border:1px solid #ddd; padding:1rem 1.25rem; margin:1.25rem 0;">
                <legend style="padding:0 0.5rem; font-weight:700; color:#C41E3A;">Roles</legend>
                <p class="grey-text text-darken-1" style="margin-top:0; font-size:0.9rem;">
                    Example: <strong>News Editor</strong> can only manage posts;
                    <strong>Procurement Officer</strong> can only manage bidding / PhilGEPS.
                </p>
                @foreach ($roles as $role)
                    <p>
                        <label>
                            <input type="checkbox"
                                class="filled-in"
                                name="roles[]"
                                value="{{ $role->name }}"
                                {{ $selectedRoles->contains($role->name) ? 'checked' : '' }} />
                            <span>
                                <strong>{{ $role->name }}</strong>
                                <span class="grey-text text-darken-1" style="display:block; font-size:0.85rem; margin-left:1.75rem;">
                                    {{ $role->permissions->pluck('name')->map(fn ($p) => \App\Support\CmsPermissions::labels()[$p] ?? $p)->implode(' · ') }}
                                </span>
                            </span>
                        </label>
                    </p>
                @endforeach
            </fieldset>

            <button type="submit" class="btn waves-effect waves-light"
                style="background-color:#C41E3A;">{{ $user->id ? 'Update User' : 'Save User' }}</button>
            <a href="{{ route('admin.users.index') }}" class="btn waves-effect waves-light grey">Cancel</a>
        </form>
    </div>
@endsection
