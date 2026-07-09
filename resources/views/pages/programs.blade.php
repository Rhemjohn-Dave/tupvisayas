@extends('layouts.app')

@section('content')
    <div class="section">
        <h3>Academics</h3>
        <ul class="collapsible popout">
            <li>
                <div class="collapsible-header"><i class="material-icons">school</i>College of Engineering</div>
                <div class="collapsible-body">
                    <ul class="collection">
                        <li class="collection-item">
                            <span class="title"><b>Bachelor of Science in Mechanical Engineering</b></span>
                            <p>Prepares students for careers in mechanical design, manufacturing, and energy systems.</p>
                        </li>
                        <li class="collection-item">
                            <span class="title"><b>Bachelor of Science in Electrical Engineering</b></span>
                            <p>Focuses on electrical systems, power generation, and electronics.</p>
                        </li>
                        <!-- Add more engineering programs as needed -->
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">memory</i>College of Automation and Control</div>
                <div class="collapsible-body">
                    <ul class="collection">
                        <li class="collection-item">
                            <span class="title"><b>Bachelor of Science in Information Technology</b></span>
                            <p>Equips students with skills in software development, networking, and IT management.</p>
                        </li>
                        <!-- Add more automation and control programs as needed -->
                    </ul>
                </div>
            </li>
            <li>
                <div class="collapsible-header"><i class="material-icons">build</i>College of Engineering Technology</div>
                <div class="collapsible-body">
                    <ul class="collection">
                        <!-- Add engineering technology programs here -->
                        <li class="collection-item">
                            <span class="title"><b>Sample Engineering Technology Program</b></span>
                            <p>Description for the program.</p>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.collapsible');
            var instances = M.Collapsible.init(elems);
        });
    </script>
@endsection