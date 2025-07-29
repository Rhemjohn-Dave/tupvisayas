@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="section" style="max-width:600px;margin:0 auto;">
                <h4 style="color:#C41E3A;font-weight:700;">Add Course to {{ strtoupper($college->college) }}</h4>
                <form method="POST" action="{{ route('admin.courses.store') }}">
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
                    <button type="submit" class="btn green white-text">Add Course</button>
                    <a href="{{ route('admin.college-pages.edit', $college->id) }}" class="btn grey white-text">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection