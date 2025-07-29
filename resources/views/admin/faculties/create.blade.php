@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="section" style="max-width:600px;margin:0 auto;">
                <h4 style="color:#C41E3A;font-weight:700;">Add Faculty to {{ $department->name }}</h4>
                <form method="POST" action="{{ route('admin.faculties.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="department_id" value="{{ $department->id }}">
                    <div class="input-field">
                        <label for="name" class="active">Faculty Name</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="input-field">
                        <label for="rank" class="active">Faculty Rank</label>
                        <input type="text" name="rank" id="rank" value="{{ old('rank') }}" required>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn orange">
                            <span>Photo</span>
                            <input type="file" name="photo" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload faculty photo (optional)">
                        </div>
                    </div>
                    <button type="submit" class="btn green white-text">Add Faculty</button>
                    <a href="{{ route('admin.college-pages.edit', $department->college_page_id) }}"
                        class="btn grey white-text">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection