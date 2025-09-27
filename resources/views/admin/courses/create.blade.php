@extends('layouts.admin')

@section('admin_content')
    <div class="section" style="max-width:600px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Add Course to {{ strtoupper($college->college) }}</h4>
        <form method="POST" action="{{ route('admin.courses.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="college_page_id" value="{{ $college->id }}">
            <div class="input-field">
                <label for="name" class="active">Course Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}" required>
            </div>
            <div class="input-field">
                <label for="description" class="active">Description</label>
                <textarea name="description" id="description"
                    class="materialize-textarea">{{ old('description') }}</textarea>
            </div>
            <div class="file-field input-field">
                <div class="btn orange">
                    <span>Logo</span>
                    <input type="file" name="logo" accept="image/*">
                </div>
                <div class="file-path-wrapper">
                    <input class="file-path validate" type="text" placeholder="Upload course logo (optional)">
                </div>
            </div>
            <button type="submit" class="btn green white-text">Add Course</button>
            <a href="{{ route('admin.college-pages.edit', $college->id) }}" class="btn grey white-text">Cancel</a>
        </form>
    </div>
@endsection