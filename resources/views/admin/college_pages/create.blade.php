@extends('layouts.app')

@section('content')
    <div class="row" style="margin-bottom:0;">
        <div class="col s12 m3 l2" style="padding:0;">
            @include('admin.sidebar')
        </div>
        <div class="col s12 m9 l10 offset-m3 offset-l2" style="margin-left:220px;">
            <div class="section" style="max-width:700px;margin:0 auto;">
                <h4 style="color:#C41E3A;font-weight:700;">Create College Page</h4>
                <form method="POST" action="{{ route('admin.college-pages.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="input-field">
                        <label for="college" class="active">College Key (e.g. coe, coac, coet)</label>
                        <input type="text" name="college" id="college" value="{{ old('college') }}" required>
                    </div>
                    <div class="file-field input-field">
                        <div class="btn orange">
                            <span>Cover Photo</span>
                            <input type="file" name="cover_photo" accept="image/*">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload cover photo (optional)">
                        </div>
                    </div>
                    <div class="input-field">
                        <label for="history" class="active">History</label>
                        <textarea name="history" id="history"
                            class="materialize-textarea wysiwyg">{{ old('history') }}</textarea>
                    </div>
                    <div class="input-field">
                        <label for="department_faculty" class="active">Department & Faculty</label>
                        <textarea name="department_faculty" id="department_faculty"
                            class="materialize-textarea wysiwyg">{{ old('department_faculty') }}</textarea>
                    </div>
                    <div class="input-field">
                        <label for="student_organization" class="active">Student Organization</label>
                        <textarea name="student_organization" id="student_organization"
                            class="materialize-textarea wysiwyg">{{ old('student_organization') }}</textarea>
                    </div>
                    <button type="submit" class="btn red white-text">Create</button>
                    <a href="{{ route('admin.college-pages.index') }}" class="btn grey white-text">Cancel</a>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: 'textarea.wysiwyg',
                    plugins: 'lists link image table code',
                    toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image table | code',
                    menubar: false,
                    height: 250
                });
            }
        });
    </script>
@endsection