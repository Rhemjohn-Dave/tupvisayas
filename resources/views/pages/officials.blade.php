@extends('layouts.app')

@section('content')
    <div class="section">
        <h3>Administrative Officials</h3>
        <div class="row">
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/200x200" alt="Official 1">
                    </div>
                    <div class="card-content center-align">
                        <span class="card-title">Dr. Juan Dela Cruz</span>
                        <p>Campus Director</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m4">
                <div class="card">
                    <div class="card-image">
                        <img src="https://via.placeholder.com/200x200" alt="Official 2">
                    </div>
                    <div class="card-content center-align">
                        <span class="card-title">Engr. Maria Santos</span>
                        <p>Dean, College of Engineering</p>
                    </div>
                </div>
            </div>
            <!-- Add more officials as needed -->
        </div>
    </div>
@endsection