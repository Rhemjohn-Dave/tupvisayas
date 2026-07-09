@extends('layouts.app')

@section('content')
    <div class="section">
        <h3>Campus Facilities</h3>
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/300x200" alt="Facility 1">
                        <span class="card-title">Library</span>
                    </div>
                    <div class="card-content">
                        <p>Modern library with digital and print resources.</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/300x200" alt="Facility 2">
                        <span class="card-title">Engineering Labs</span>
                    </div>
                    <div class="card-content">
                        <p>State-of-the-art laboratories for hands-on learning.</p>
                    </div>
                </div>
            </div>
            <!-- Add more facilities as needed -->
        </div>
    </div>
@endsection