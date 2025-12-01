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

        /* Courses Offered rows: logo left, info right */
        .course-list .course-row {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 16px 0;
            border-bottom: 1px solid #eee;
        }

        .course-list .course-row:last-child {
            border-bottom: 0;
        }

        .course-logo {
            width: 420px;
            height: 420px;
            border-radius: 10px;
            object-fit: contain;
            background: #fafafa;
            border: 1px solid #eee;
            flex: 0 0 120px;
        }

        .course-logo.placeholder {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #C41E3A;
            background: #fff6f7;
        }

        .course-info {
            flex: 1 1 auto;
        }

        .course-title {
            font-weight: 1000;
            font-size: 1.5rem;
            color: #333;
            line-height: 1.2;
            margin: 2px 0 6px 0;
        }

        .course-desc {
            color: #555;
            margin: 30px 20px 20px 10px;
            font-size: 1rem;
            font-weight: 500;
            line-height: 1.5;
            text-align: justify;
            text-justify: inter-word;

            text-justify-last: inter-word;


        }

        .course-info hr {
            border: none;
            border-top: 1px solid #222;
            /* Light gray line */
            margin: 10px 0;
            /* Vertical spacing */
        }

        /* Responsive adjustments */
        @media (max-width: 992px) {
            .course-logo {
                width: 96px;
                height: 96px;
                flex: 0 0 96px;
            }

            .course-title {
                font-size: 1.25rem;
            }

            .course-desc {
                margin: 16px 0 0 0;
            }
        }

        @media (max-width: 600px) {
            .course-list .course-row {
                flex-direction: column;
                align-items: center;
                gap: 12px;
                text-align: center;
            }

            .course-logo {
                width: 160px;
                height: 160px;
                flex: 0 0 auto;
                max-width: 100%;
            }

            .course-info {
                width: 100%;
            }

            .course-info hr {
                margin: 8px 0;
            }

            .course-title {
                font-size: 1.2rem;
                margin: 4px 0 6px 0;
            }

            .course-desc {
                margin: 8px 0 0 0;
                text-align: left;
            }
        }
    </style>
@endsection

@section('content')
    <div class="section">
        @if($collegePage->cover_photo)
            <div style="width:100%;height:420px;overflow:hidden;border-radius:12px;margin-bottom:2rem;">
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
                <div class="course-list">
                    @foreach($collegePage->courses as $course)
                        <div class="course-row">
                            @if($course->logo)
                                <img class="course-logo" src="{{ asset('storage/' . $course->logo) }}"
                                    alt="{{ $course->name }} Logo">
                            @else
                                @php
                                    $words = preg_split('/\s+/', trim($course->name));
                                    $initials = '';
                                    foreach ($words as $w) {
                                        if ($w !== '') {
                                            $initials .= strtoupper(mb_substr($w, 0, 1));
                                            if (strlen($initials) >= 2)
                                                break;
                                        }
                                    }
                                @endphp
                                <div class="course-logo placeholder">{{ $initials }}</div>
                            @endif
                            <div class="course-info">
                                <div class="course-title">{{ $course->name }}</div>
                                <hr>
                                @if($course->description)
                                    <p class="course-desc">{{ $course->description }}</p>
                                @endif
                                <div style="margin-top:1rem;">
                                    <a href="{{ route('accreditation.course.show', $course) }}"
                                        class="btn-small waves-effect waves-light red darken-2">
                                        View Accreditation
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
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