@extends('layouts.admin')

@section('title', 'Admin - Users')

@section('admin_content')
    <div class="row" style="align-items:center;">
        <div class="col s12 m8">
            <h5 class="red-text text-darken-2">Users</h5>
        </div>
        <div class="col s12 m4 right-align">
            <a href="{{ route('admin.users.create') }}" class="btn waves-effect waves-light white-text red">
                <i class="material-icons left">add</i> Add User
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
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th class="right-align">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users as $u)
                    <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ $u->is_admin ? 'Admin' : 'User' }}</td>
                        <td class="right-align">
                            <a href="{{ route('admin.users.edit', $u->id) }}" class="btn-small waves-effect">Edit</a>
                            <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" style="display:inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small red lighten-1 waves-effect"
                                    onclick="return confirm('Delete this user?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="center-align">No users found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="section">{{ $users->links() }}</div>

@endsection