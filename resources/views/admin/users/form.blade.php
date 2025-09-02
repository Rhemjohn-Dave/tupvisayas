@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('admin_content')
    <div class="section" style="max-width: 700px;">
        <h5 class="red-text text-darken-2">{{ $user->id ? 'Edit User' : 'Add User' }}</h5>

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

            <p>
                <label>
                    <input type="checkbox" name="is_admin" value="1" {{ old('is_admin', $user->is_admin ?? false) ? 'checked' : '' }} />
                    <span>Is Admin</span>
                </label>
            </p>

            <div class="section right-align">
                <a href="{{ route('admin.users.index') }}" class="btn-flat">Cancel</a>
                <button type="submit" class="btn waves-effect waves-light red">Save</button>
            </div>
        </form>
    </div>
@endsection