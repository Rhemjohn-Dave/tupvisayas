@extends('layouts.admin')

@section('admin_content')
    <div class="container">
        <h3>Add New Official</h3>
        <form action="{{ route('admin.officials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-field">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="input-field">
                <label for="position">Position</label>
                <input type="text" name="position" id="position" value="{{ old('position') }}" required>
            </div>
            <div class="input-field">
                <label for="order">Order</label>
                <input type="number" name="order" id="order" value="{{ old('order', 0) }}">
            </div>
            <div class="file-field input-field">
                <div class="btn">
                    <span>Photo</span>
                    <input type="file" name="photo" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text">
                </div>
            </div>
            <button type="submit" class="btn">Create Official</button>
            <a href="{{ route('admin.officials.index') }}" class="btn grey">Cancel</a>
        </form>
    </div>
@endsection
