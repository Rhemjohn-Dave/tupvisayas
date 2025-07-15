@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="section" style="max-width:700px;margin:0 auto;">
                <h4 style="color:#C41E3A;font-weight:700;">Manage Categories</h4>
                <a href="{{ route('admin.categories.create') }}" class="btn red" style="margin-bottom:20px;">Add New
                    Category</a>
                @if(session('success'))
                    <div class="card-panel green lighten-4 green-text">{{ session('success') }}</div>
                @endif
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Slug</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection