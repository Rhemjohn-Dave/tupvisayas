@extends('layouts.admin')

@section('admin_content')
    <div class="section" style="max-width:700px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Manage Academics Pages</h4>
        <a href="{{ route('admin.college-pages.create') }}" class="btn red white-text" style="margin-bottom:20px;">Create
            College Page</a>
        @if(session('success'))
            <div class="card-panel green lighten-4 green-text">{{ session('success') }}</div>
        @endif
        <table class="striped">
            <thead>
                <tr>
                    <th>College</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($colleges as $college)
                    <tr>
                        <td style="text-transform:uppercase;font-weight:600;">{{ strtoupper($college->college) }}</td>
                        <td>
                            <a href="{{ route('admin.college-pages.edit', $college->id) }}"
                                class="btn orange white-text">Edit</a>
                            <form action="{{ route('admin.college-pages.destroy', $college->id) }}" method="POST"
                                style="display:inline-block;margin-left:6px;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn red white-text"
                                    onclick="return confirm('Delete this college page?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection