@extends('layouts.admin')

@section('admin_head')
    <style>
        .tabs .tab a.active {
            color: #fff !important;
            background: #C41E3A !important;
            border-radius: 6px 6px 0 0;
        }

        .tabs .tab a {
            color: #C41E3A;
            font-weight: 600;
        }
    </style>
@endsection

@section('admin_content')
    <div class="section" style="max-width:700px;margin:0 auto;">
        <h4 style="color:#C41E3A;font-weight:700;">Edit {{ strtoupper($college->college) }} Page</h4>
        <ul class="tabs">
            <li class="tab col s3"><a class="active" href="#tab-history">History</a></li>
            <li class="tab col s3"><a href="#tab-dept">Department & Faculty</a></li>
            <li class="tab col s3"><a href="#tab-org">Student Organization</a></li>
            <li class="tab col s3"><a href="#tab-courses">Courses Offered</a></li>
        </ul>
        <div id="tab-history" class="col s12" style="padding-top:2rem;">
            <form method="POST" action="{{ route('admin.college-pages.update', $college->id) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="file-field input-field">
                    <div class="btn orange">
                        <span>Cover Photo</span>
                        <input type="file" name="cover_photo" accept="image/*">
                    </div>
                    <div class="file-path-wrapper">
                        <input class="file-path validate" type="text" placeholder="Upload cover photo (optional)">
                    </div>
                    @if($college->cover_photo)
                        <div style="margin-top:10px;">
                            <img src="{{ asset('storage/' . $college->cover_photo) }}" alt="Cover Photo"
                                style="width:100%;max-width:400px;border-radius:8px;">
                        </div>
                    @endif
                </div>
                <div class="input-field">
                    <label for="history" class="active">History</label>
                    <textarea name="history" id="history"
                        class="materialize-textarea wysiwyg">{{ old('history', $college->history) }}</textarea>
                </div>
                <button type="submit" class="btn orange white-text">Update</button>
                <a href="{{ route('admin.college-pages.index') }}" class="btn grey white-text">Cancel</a>
            </form>
        </div>
        <div id="tab-dept" class="col s12" style="padding-top:2rem;">
            <ul class="collapsible popout">
                @foreach(\App\Models\Department::where('college_page_id', $college->id)->get() as $department)
                    <li>
                        <div class="collapsible-header" style="font-weight:600;font-size:1.1rem;">
                            {{ $department->name }}
                        </div>
                        <div class="collapsible-body">
                            <a href="{{ route('admin.faculties.create', ['department_id' => $department->id]) }}"
                                class="btn green white-text" style="margin-bottom:15px;">Add Faculty</a>
                            <table class="striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Photo</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($department->faculties as $faculty)
                                        <tr>
                                            <td>{{ $faculty->name }}</td>
                                            <td>{{ $faculty->position }}</td>
                                            <td>
                                                @if($faculty->photo)
                                                    <img src="{{ asset('storage/' . $faculty->photo) }}" alt="Faculty Photo"
                                                        style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                @else
                                                    N/A
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.faculties.edit', $faculty->id) }}"
                                                    class="btn orange btn-small white-text">Edit</a>
                                                <form action="{{ route('admin.faculties.destroy', $faculty->id) }}" method="POST"
                                                    style="display:inline-block;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn red btn-small white-text"
                                                        onclick="return confirm('Delete this faculty member?')">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
        <div id="tab-org" class="col s12" style="padding-top:2rem;">
            <form method="POST" action="{{ route('admin.college-pages.update', $college->id) }}">
                @csrf
                @method('PUT')
                <div class="input-field">
                    <label for="student_organization" class="active">Student Organization</label>
                    <textarea name="student_organization" id="student_organization"
                        class="materialize-textarea wysiwyg">{{ old('student_organization', $college->student_organization) }}</textarea>
                </div>
                <button type="submit" class="btn orange white-text">Update</button>
                <a href="{{ route('admin.college-pages.index') }}" class="btn grey white-text">Cancel</a>
            </form>
        </div>
        <div id="tab-courses" class="col s12" style="padding-top:2rem;">
            <div class="section" style="max-width:700px;margin:0 auto;">
                <h5 style="color:#C41E3A;font-weight:700;">Courses Offered</h5>
                <a href="{{ route('admin.courses.create', ['college_page_id' => $college->id]) }}"
                    class="btn green white-text" style="margin-bottom:15px;">Add Course</a>
                <table class="striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($college->courses as $course)
                            <tr>
                                <td>{{ $course->name }}</td>
                                <td>{{ $course->description }}</td>
                                <td>
                                    <a href="{{ route('admin.courses.edit', $course->id) }}"
                                        class="btn orange btn-small white-text">Edit</a>
                                    <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn red btn-small white-text"
                                            onclick="return confirm('Delete this course?')">Delete</button>
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

@section('admin_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.collapsible');
            M.Collapsible.init(elems);
        });
    </script>
@endsection