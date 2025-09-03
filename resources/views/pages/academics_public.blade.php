@extends('layouts.app')

@section('head')
    <style>
        .tabs .tab a {
            color: #C41E3A;
            font-weight: 600;
        }

        .tabs .tab a:hover {
            color: #fff !important;
            background: #C41E3A !important;
            border-radius: 6px 6px 0 0;
        }

        .tabs .tab a.active {
            color: #fff !important;
            background: #C41E3A !important;
            border-radius: 6px 6px 0 0;
        }

        .tabs .indicator {
            background-color: #C41E3A;
        }
    </style>
@endsection

@section('content')
    <div class="section">
        @if($collegePage->cover_photo)
            <div style="width:100%;height:260px;overflow:hidden;border-radius:12px;margin-bottom:2rem;">
                <img src="{{ asset('storage/' . $collegePage->cover_photo) }}" alt="Cover Photo"
                    style="width:100%;height:100%;object-fit:cover;">
            </div>
        @endif
        <h3 style="color:#C41E3A;font-weight:700;">{{ ucwords(str_replace('_', ' ', $collegePage->college)) }}</h3>
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#history">History</a></li>
                    <li class="tab col s3"><a href="#courses">Courses Offered</a></li>
                    <li class="tab col s3"><a href="#dept">Department & Faculty</a></li>
                    <li class="tab col s3"><a href="#org">Student Organization</a></li>
                </ul>
            </div>
            <div id="history" class="col s12" style="padding-top:2rem;">
                {!! $collegePage->history !!}
            </div>
            <div id="courses" class="col s12" style="padding-top:2rem;">
                <ul class="collection">
                    @foreach($collegePage->courses as $course)
                        <li class="collection-item">
                            <b>{{ $course->name }}</b>
                            @if($course->description)
                                <p>{{ $course->description }}</p>
                            @endif
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="dept" class="col s12" style="padding-top:2rem;">
                <ul class="collapsible popout">
                    @foreach(\App\Models\Department::where('college_page_id', $collegePage->id)->get() as $department)
                        <li>
                            <div class="collapsible-header" style="font-weight:600;font-size:1.1rem;">
                                {{ $department->name }}
                            </div>
                            <div class="collapsible-body">
                                <table class="striped">
                                    <thead>
                                        <tr>
                                            <th>Photo</th>
                                            <th>Name</th>
                                            <th>Faculty Rank</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($department->faculties as $faculty)
                                            <tr>
                                                <td>
                                                    @if($faculty->photo)
                                                        <img src="{{ asset('storage/' . $faculty->photo) }}" alt="Faculty Photo"
                                                            style="width:60px;height:60px;object-fit:cover;border-radius:8px;">
                                                    @else
                                                        N/A
                                                    @endif
                                                </td>
                                                <td>{{ $faculty->name }}</td>
                                                <td>{{ $faculty->rank }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div id="org" class="col s12" style="padding-top:2rem;">
                {!! $collegePage->student_organization !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);
            var elems = document.querySelectorAll('.collapsible');
            M.Collapsible.init(elems);
        });
    </script>
@endsection