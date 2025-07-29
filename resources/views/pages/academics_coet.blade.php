@extends('layouts.app')

@section('content')
    <div class="section">
        <!-- Cover Photo -->
        <div style="width:100%;height:260px;overflow:hidden;border-radius:12px;margin-bottom:2rem;">
            <img src="{{ asset('images/coet-cover.jpg') }}" alt="College of Engineering Technology Cover"
                style="width:100%;height:100%;object-fit:cover;">
        </div>
        <!-- Tabs -->
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#coet-history">History</a></li>
                    <li class="tab col s3"><a href="#coet-courses">Courses Offered</a></li>
                    <li class="tab col s3"><a href="#coet-dept">Department & Faculty</a></li>
                    <li class="tab col s3"><a href="#coet-org">Student Organization</a></li>
                </ul>
            </div>
            <div id="coet-history" class="col s12" style="padding-top:2rem;">
                <h5>History</h5>
                <p>[Insert history of the College of Engineering Technology here]</p>
            </div>
            <div id="coet-courses" class="col s12" style="padding-top:2rem;">
                <h5>Courses Offered</h5>
                <ul class="collection">
                    <li class="collection-item"><b>Sample Engineering Technology Program</b></li>
                    <!-- Add more COET programs here -->
                </ul>
            </div>
            <div id="coet-dept" class="col s12" style="padding-top:2rem;">
                <h5>Department & Faculty</h5>
                <p>[Insert department and faculty information here]</p>
            </div>
            <div id="coet-org" class="col s12" style="padding-top:2rem;">
                <h5>Student Organization</h5>
                <p>[Insert student organization information here]</p>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);
        });
    </script>
@endsection