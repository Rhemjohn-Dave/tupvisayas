@extends('layouts.app')

@section('title', 'Campus Tour - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'Explore TUP Visayas through an interactive campus tour — colleges, library, UITC labs, facilities, and student spaces on a live satellite map.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="Campus Tour - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/campus-tour/admin.jpg') }}">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="">
@endsection

@section('content')
    @php
        // Campus center (Wikipedia / Talisay City). Stop coordinates are approximate placeholders
        // clustered around the campus footprint and can be refined later with surveyed points.
        $campusCenter = ['lat' => 10.73932, 'lng' => 122.96961];
        $img = fn (string $file) => asset('images/campus-tour/' . $file);

        $stops = [
            [
                'id' => 'admin',
                'name' => 'Main Gate & Administration',
                'tagline' => 'Campus entrance and leadership offices',
                'description' => 'Start your visit at the main gate and administration precinct — home to campus leadership, visitor reception, accounting and cashier windows, and the institutional heart of TUP Visayas in Talisay City, Negros Occidental.',
                'photos' => [$img('admin.jpg'), $img('admin-2.jpg'), $img('admin-3.jpg')],
                'lat' => 10.739353908954087,
                'lng' => 122.97021271665079,
                'links' => [
                    ['label' => 'Office of the Director', 'url' => route('directors.corner')],
                    ['label' => 'Contact', 'url' => route('contact')],
                ],
            ],
            [
                'id' => 'coe',
                'name' => 'College of Engineering',
                'tagline' => 'Design, analysis, and professional practice',
                'description' => 'The College of Engineering hosts degree pathways in core engineering fields, with classrooms and laboratories for design, analysis, and board-exam preparation — including machine shops and welding bays.',
                'photos' => [$img('coe.jpg'), $img('coe-2.jpg'), $img('coe-3.jpg')],
                'lat' => 10.74037374131682,
                'lng' => 122.96943219383544,
                'links' => [
                    ['label' => 'Browse COE', 'url' => route('academics.coe')],
                    ['label' => 'Academics', 'url' => route('academics')],
                ],
            ],
            [
                'id' => 'coac',
                'name' => 'College of Automation and Control',
                'tagline' => 'Instrumentation, control, and industry systems',
                'description' => 'COAC focuses on industrial automation, instrumentation, and control systems — with electronics laboratories and research spaces that connect classroom theory to industry practice.',
                'photos' => [$img('coac.jpg'), $img('coac-2.jpg'), $img('coac-3.jpg')],
                'lat' => 10.740685336679022,
                'lng' => 122.97003517483098,
                'links' => [
                    ['label' => 'Browse COAC', 'url' => route('academics.coac')],
                    ['label' => 'Undergraduate programs', 'url' => route('academics.undergraduate')],
                ],
            ],
            [
                'id' => 'coet',
                'name' => 'College of Engineering Technology',
                'tagline' => 'Applied technology and digital pathways',
                'description' => 'COET delivers industry-ready programs in automotive, electromechanical, manufacturing, and related technologies — built around workshops and hands-on training centers.',
                'photos' => [$img('coet.jpg'), $img('coet-2.jpg'), $img('coet-3.jpg')],
                'lat' => 10.740756145147444,
                'lng' => 122.96979051237666,
                'links' => [
                    ['label' => 'Browse COET', 'url' => route('academics.coet')],
                    ['label' => 'Academics', 'url' => route('academics')],
                ],
            ],
            [
                'id' => 'library',
                'name' => 'Campus Library',
                'tagline' => 'Research, reading, and learning support',
                'description' => 'The campus library provides print and online resources, theses and reference collections, study tables, and research assistance led by registered librarians under Academic Affairs.',
                'photos' => [$img('library.jpg'), $img('library-2.jpg'), $img('library-3.jpg')],
                'lat' => 10.74000123082075,
                'lng' => 122.96930526815213,
                'links' => [
                    ['label' => 'Library page', 'url' => route('library')],
                ],
            ],
            [
                'id' => 'uitc',
                'name' => 'University IT Center',
                'tagline' => 'Digital campus, labs, and helpdesk',
                'description' => 'UITC powers campus connectivity, accounts, learning systems, and computer laboratories — the digital backbone of a technological university.',
                'photos' => [$img('uitc.jpg'), $img('uitc-2.jpg'), $img('uitc-3.jpg')],
                'lat' => 10.740297753202075,
                'lng' => 122.97007690020871,
                'links' => [
                    ['label' => 'UITC services', 'url' => route('technology')],
                    ['label' => 'Student ERS', 'url' => 'https://ers.tup.edu.ph/aims/students/', 'external' => true],
                ],
            ],
            [
                'id' => 'osa',
                'name' => 'Student Services / OSA',
                'tagline' => 'Student welfare and campus life',
                'description' => 'Student Affairs and related support offices coordinate assessment windows, campus transactions, organization activities, guidance pathways, and student welfare across campus life.',
                'photos' => [$img('osa.jpg'), $img('osa-2.jpg'), $img('osa-3.jpg')],
                'lat' => 10.740320113800921,
                'lng' => 122.97007310699239,
                'links' => [
                    ['label' => 'Student services', 'url' => route('student_services')],
                    ['label' => 'Enrollment procedure', 'url' => route('admissions.enrollment')],
                ],
            ],
            [
                'id' => 'canteen',
                'name' => 'Canteen & Snack Stalls',
                'tagline' => 'Meals and everyday campus dining',
                'description' => 'The campus canteen and snack stalls are where TUPViáns refuel between classes — from sit-down dining tables to quick-service windows for breads and snacks.',
                'photos' => [$img('canteen.jpg'), $img('canteen-2.jpg'), $img('canteen-3.jpg')],
                'lat' => 10.74012,
                'lng' => 122.96972,
                'links' => [
                    ['label' => 'Facilities overview', 'url' => route('facilities')],
                    ['label' => 'Student services', 'url' => route('student_services')],
                ],
            ],
            [
                'id' => 'clinic',
                'name' => 'University Clinic',
                'tagline' => 'Campus health and first response',
                'description' => 'The University Clinic supports student and employee wellness with on-campus medical consultation and health services along the main administrative corridor.',
                'photos' => [$img('clinic.jpg'), $img('clinic-2.jpg'), $img('clinic-3.jpg')],
                'lat' => 10.74022,
                'lng' => 122.96998,
                'links' => [
                    ['label' => 'Student services', 'url' => route('student_services')],
                    ['label' => 'Contact', 'url' => route('contact')],
                ],
            ],
            [
                'id' => 'radio',
                'name' => 'Campus Radio Station',
                'tagline' => 'Cong. Francisco “Kiko” Benitez TUP-V Radio',
                'description' => 'The Cong. Francisco “Kiko” Benitez TUP-V Campus Radio Station gives students a platform for broadcasting, campus announcements, and media practice.',
                'photos' => [$img('radio.jpg')],
                'lat' => 10.74048,
                'lng' => 122.96958,
                'links' => [
                    ['label' => 'News & events', 'url' => route('news_events')],
                    ['label' => 'Facilities overview', 'url' => route('facilities')],
                ],
            ],
            [
                'id' => 'meic',
                'name' => 'Metals & Engineering Innovation Center',
                'tagline' => 'DOST-partnered fabrication and R&D',
                'description' => 'MEIC is a DOST-partnered innovation hub for metals and engineering — housing modern fabrication equipment for prototyping, training, and regional industry support.',
                'photos' => [$img('meic.jpg'), $img('meic-2.jpg'), $img('meic-3.jpg')],
                'lat' => 10.74082,
                'lng' => 122.96948,
                'links' => [
                    ['label' => 'Browse COET', 'url' => route('academics.coet')],
                    ['label' => 'Facilities overview', 'url' => route('facilities')],
                ],
            ],
            [
                'id' => 'gym',
                'name' => 'Gymnasium & Multipurpose Precinct',
                'tagline' => 'Assemblies, sports, and major events',
                'description' => 'The gymnasium and multipurpose precinct host orientations, athletic activities, and large campus gatherings — including landmark events for incoming freshmen.',
                'photos' => [$img('gym.jpg'), $img('gym-2.jpg'), $img('gym-3.jpg')],
                'lat' => 10.740644342298083,
                'lng' => 122.97036708125705,
                'links' => [
                    ['label' => 'Facilities overview', 'url' => route('facilities')],
                    ['label' => 'News & events', 'url' => route('news_events')],
                ],
            ],
        ];

        $first = $stops[0];
        $firstPhoto = $first['photos'][0] ?? asset('images/tupvisayas.jpg');
    @endphp

    <div class="site-page site-page--campus-tour"
        data-campus-tour
        data-campus-center-lat="{{ $campusCenter['lat'] }}"
        data-campus-center-lng="{{ $campusCenter['lng'] }}">
        <section class="acad-hero" aria-labelledby="campus-tour-heading">
            <p class="acad-hero__badge">Explore the campus</p>
            <h1 id="campus-tour-heading" class="acad-hero__title">Interactive Campus Tour</h1>
            <p class="acad-hero__lede">
                Explore TUP Visayas on a live map — pan, zoom, and select campus stops to browse photos and learn what happens in each space.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#campus-tour-map">Open the map</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('facilities') }}">Facilities list</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('academics') }}">Academics</a>
            </div>
        </section>

        <section class="ctour-section" id="campus-tour-map" aria-labelledby="ctour-map-heading">
            <div class="ctour-section__inner">
                <header class="ctour-section__head">
                    <p class="ctour-eyebrow">Live campus map</p>
                    <h2 id="ctour-map-heading" class="ctour-section__title">Select a stop</h2>
                    <p class="ctour-section__lede">
                        Drag to pan, scroll or pinch to zoom, switch Satellite / Streets, then tap a numbered pin.
                        Open a stop to browse its photo gallery. Marker positions are approximate and can be refined later.
                    </p>
                </header>

                <div class="ctour-layout">
                    <div class="ctour-map-shell ctour-map-shell--leaflet">
                        <div id="campus-leaflet-map"
                            class="ctour-leaflet"
                            data-campus-map
                            role="application"
                            aria-label="Interactive TUP Visayas campus map"></div>
                    </div>

                    <aside class="ctour-panel" data-campus-panel aria-live="polite">
                        <figure class="ctour-panel__media">
                            <img data-campus-photo src="{{ $firstPhoto }}" alt="{{ $first['name'] }}" loading="lazy">
                        </figure>
                        <div class="ctour-panel__thumbs" data-campus-thumbs aria-label="Photos for this stop">
                            @foreach ($first['photos'] as $index => $photo)
                                <button type="button"
                                    class="ctour-panel__thumb {{ $index === 0 ? 'is-active' : '' }}"
                                    data-campus-thumb="{{ $photo }}"
                                    aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                                    <img src="{{ $photo }}" alt="" loading="lazy">
                                </button>
                            @endforeach
                        </div>
                        <p class="ctour-panel__eyebrow" data-campus-tagline>{{ $first['tagline'] }}</p>
                        <h3 class="ctour-panel__title" data-campus-name>{{ $first['name'] }}</h3>
                        <p class="ctour-panel__text" data-campus-description>{{ $first['description'] }}</p>
                        <div class="ctour-panel__links" data-campus-links>
                            @foreach ($first['links'] as $link)
                                <a class="acad-btn {{ $loop->first ? 'acad-btn--primary' : 'acad-btn--ghost' }}"
                                    href="{{ $link['url'] }}"
                                    @if (!empty($link['external'])) target="_blank" rel="noopener noreferrer" @endif>
                                    {{ $link['label'] }}
                                </a>
                            @endforeach
                        </div>
                    </aside>
                </div>

                <ol class="ctour-stop-list" aria-label="Campus tour stops">
                    @foreach ($stops as $index => $stop)
                        <li>
                            <button type="button"
                                class="ctour-stop-list__btn {{ $index === 0 ? 'is-active' : '' }}"
                                data-campus-stop="{{ $stop['id'] }}"
                                aria-pressed="{{ $index === 0 ? 'true' : 'false' }}">
                                <span class="ctour-stop-list__num">{{ $index + 1 }}</span>
                                <span class="ctour-stop-list__copy">
                                    <strong>{{ $stop['name'] }}</strong>
                                    <span>{{ $stop['tagline'] }}</span>
                                </span>
                            </button>
                        </li>
                    @endforeach
                </ol>
            </div>
        </section>

        <script type="application/json" data-campus-stops>
            {!! json_encode($stops, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
        </script>

        <section class="acad-cta" aria-labelledby="ctour-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="ctour-cta-heading" class="acad-cta__title">Ready to visit in person?</h2>
                <p class="acad-cta__lede">
                    Review campus facilities, explore academic programs, or reach the campus for scheduling a visit.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('facilities') }}">View facilities</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('admissions.enrollment') }}">Apply now</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('contact') }}">Contact us</a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ asset('js/campus-tour.js?v=' . time()) }}" defer></script>
@endsection
