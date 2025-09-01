@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h3>Manage Officials</h3>
        <a href="{{ route('admin.officials.create') }}" class="btn red darken-2" style="margin-bottom:20px;">Add New
            Official</a>
        @if(session('success'))
            <div class="card-panel green lighten-4 green-text">{{ session('success') }}</div>
        @endif
        <table class="striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Order</th>
                    <th>Photo</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($officials as $official)
                    <tr>
                        <td>{{ $official->name }}</td>
                        <td>{{ $official->position }}</td>
                        <td>{{ $official->order }}</td>
                        <td>
                            @if($official->photo)
                                <img src="{{ asset('storage/' . $official->photo) }}" alt="{{ $official->name }}"
                                    style="width:80px; height:80px; object-fit:cover; border-radius:8px;">
                            @else
                                N/A
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.officials.edit', $official->id) }}" class="btn-small orange">Edit</a>
                            <form action="{{ route('admin.officials.destroy', $official->id) }}" method="POST"
                                style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small red"
                                    onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection