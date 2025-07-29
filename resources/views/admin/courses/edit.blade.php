@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="section" style="max-width:600px;margin:0 auto;">
                <h4 style="color:#C41E3A;font-weight:700;">Edit Course ({{ strtoupper($college->college) }})</h4>
                <form method="POST" action="{{ route('admin.courses.update', $course->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="input-field">
                        <label for="name" class="active">Course Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $course->name) }}" required>
                    </div>
                    <div class="input-field">
                        <label for="description" class="active">Description</label>
                        <textarea name="description" id="description"
                            class="materialize-textarea">{{ old('description', $course->description) }}</textarea>
                    </div>
                    <button type="submit" class="btn orange white-text">Update Course</button>
                    <a href="{{ route('admin.college-pages.edit', $college->id) }}" class="btn grey white-text">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection