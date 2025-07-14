@extends('layouts.app')

@section('content')
    <!-- Welcome Section with Executive Officials on the Right -->
    <div class="section" style="padding-top:2rem;">
        <div class="row"
            style="max-width:1200px; margin:0 auto; display:flex; justify-content:center; align-items:flex-start; flex-wrap:wrap;">
            <!-- Main Welcome Content -->
            <div class="col s12 m8 order-1 order-m-1" style="float:none;">
                <!-- <img src="{{ asset('images/tup-logo.png') }}" alt="TUP Visayas Logo" style="max-width:100px;"> -->
                <h2 style="color:#C41E3A; font-weight:700;">Welcome to TUP Visayas Campus</h2>
                <div style="border-top:3px solid #C41E3A; width:80px; margin:1rem 0;"></div>
                <p style="font-size:1.2rem; max-width:600px;">
                    Technological University of the Philippines – Visayas Campus is a leading institution for engineering
                    and technology education in the region, committed to academic excellence and nation-building.
                </p>
                <!-- Optional: Add a campus image or video here -->
                <div class="video-container" style="margin-top:1.5rem;">
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/qV02hsbTcEY"
                        title="TUP Visayas Campus" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
            <!-- Executive Officials -->
            <div class="col s12 m4 order-2 order-m-2" style="min-width:260px; max-width:380px; float:none;">
                <h5 style="color:#C41E3A; font-weight:600;">TUP - Visayas Campus Executive Officials</h5>
                <div style="border-top:3px solid #C41E3A; width:60px; margin-bottom:1.2rem;"></div>
                @foreach($officials_preview as $official)
                    <div class="official-card" style="margin-bottom:2rem; text-align:center;">
                        <img src="{{ $official->photo ? asset('storage/' . $official->photo) : 'https://via.placeholder.com/200x200' }}"
                            alt="{{ $official->name }}" class="responsive-img"
                            style="width:140px; height:140px; object-fit:cover; display:block; margin:0 auto 0.5rem auto;">
                        <span style="font-weight:700;">{{ $official->name }}</span><br>
                        <span style="font-size:0.95rem;">{{ $official->position }}</span><br>
                        <a href="{{ route('officials.show', $official->id) }}" class="red-text text-darken-2"
                            style="font-size:0.95rem;">View Full Profile</a>
                    </div>
                @endforeach
                <div class="center-align">
                    <a href="{{ route('officials') }}" class="btn red darken-2">View All Officials</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        @media (max-width: 992px) {
            .order-1 {
                order: 1 !important;
            }

            .order-2 {
                order: 2 !important;
            }
        }

        @media (max-width: 600px) {
            .order-1 {
                order: 1 !important;
            }

            .order-2 {
                order: 2 !important;
            }

            .official-card img {
                width: 100px !important;
                height: 100px !important;
            }

            .section h2 {
                font-size: 1.5rem !important;
            }
        }
    </style>

    <!-- TUP Campuses -->
    <div class="section">
        <h4 style="color:#C41E3A;">TUP Campuses in the Philippines</h4>
        <div class="row center-align">
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-manila.png') }}" alt="TUP Manila"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Manila</h6>
                        <p style="margin:0; font-size:0.95rem;">Manila Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-cavite.png') }}" alt="TUP Cavite"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Cavite</h6>
                        <p style="margin:0; font-size:0.95rem;">Cavite Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-taguig.png') }}" alt="TUP Taguig"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Taguig</h6>
                        <p style="margin:0; font-size:0.95rem;">Taguig Campus</p>
                    </div>
                </div>
            </div>
            <div class="col s12 m3">
                <div class="card-panel" style="padding:0;">
                    <img src="{{ asset('images/tup-visayas.png') }}" alt="TUP Visayas"
                        style="width:100%; height:120px; object-fit:cover; border-radius:6px 6px 0 0;">
                    <div style="padding:1rem;">
                        <h6 style="margin:0;">TUP Visayas</h6>
                        <p style="margin:0; font-size:0.95rem;">Visayas Campus</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Partners & Accreditations -->
    <div class="section center-align" style="margin-top:2rem;">
        <h5 style="color:#C41E3A;" class="center-align">Our Partners & Accreditations</h5>
        <div class="row" style="display: flex; justify-content: center; align-items: center; gap: 40px; flex-wrap: wrap;">
            <div class="center-align" style="flex: 0 0 auto;"><img src="{{ asset('images/ched-logo.png') }}" alt="CHED"
                    style="max-width:80px;"></div>
            <div class="center-align" style="flex: 0 0 auto;"><img src="{{ asset('images/iso-logo.png') }}" alt="ISO"
                    style="max-width:80px;"></div>
            <div class="center-align" style="flex: 0 0 auto;"><img src="{{ asset('images/TUV_Rheinland_Logo.png') }}"
                    alt="tuv" style="max-width:80px;"></div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var elems = document.querySelectorAll('.carousel');
            M.Carousel.init(elems, { fullWidth: true, indicators: true });
        });
    </script>
@endsection