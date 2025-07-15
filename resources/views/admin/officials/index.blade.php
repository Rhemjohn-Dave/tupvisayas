@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
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
                                            style="max-width:50px;">
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.officials.edit', $official->id) }}"
                                        class="btn-small orange">Edit</a>
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
        </div>
    </div>
@endsection