@extends('layouts.app')

@section('content')
    <div class="section" style="max-width:500px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Add New Category</h4>
        <form method="POST" action="{{ route('admin.categories.store') }}">
            @csrf
            <div class="input-field">
                <label for="name" class="active">Category Name</label>
                <input type="text" name="name" id="name" required>
                @error('name')
                    <span class="red-text">{{ $message }}</span>
                @enderror
            </div>
            <button type="submit" class="btn red">Add Category</button>
            <a href="{{ route('admin.categories.index') }}" class="btn grey" style="color:#fff !important;">Cancel</a>
        </form>
    </div>
@endsection