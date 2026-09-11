@extends('layouts.app')

@section('title', 'TUP History - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'History of the Technological University of the Philippines — from Manila Trade School (1901) to TUP Visayas today.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="TUP History - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--about-history">
        <section class="acad-hero" aria-labelledby="history-hero-heading">
            <p class="acad-hero__badge">About TUP</p>
            <h1 id="history-hero-heading" class="acad-hero__title">TUP History</h1>
            <p class="acad-hero__lede">
                From the Manila Trade School (1901) to the Technological University of the Philippines today.
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#history-timeline">View timeline</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mission') }}">Mission &amp; Vision</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mandate') }}">Mandate</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.hymn') }}">Hymn</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('officials') }}">Officials</a>
            </div>
        </section>

        <section class="sit-section" id="history-timeline" aria-labelledby="history-timeline-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Institutional timeline</p>
                    <h2 id="history-timeline-heading" class="sit-section__title">Eras of TUP</h2>
                    <p class="sit-section__lede">
                        Key periods that shaped TUP — from trade school roots to a premier technological university.
                    </p>
                </header>

                <div class="history-timeline">
                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">Manila Trade School</h3>
                            <span class="history-era__period">1901&ndash;1910</span>
                        </header>
                        <div class="history-era__body">
                            <p>The Technological University of the Philippines was first established as the Manila Trade School in 1901 upon the enactment of Act No. 74 by the United States Philippine Commission for the instruction of the Filipinos on useful trades. Originally housed near Ateneo de Manila in Intramuros, MTS transferred to the Exposicion Regional de Filipinos in Calle Padre Faura. Six years later, the MTS transferred to the City Shops in Calle Arroceros.</p>
                            <p>Industrial courses which included carpentry, English, telegraphy, machine shop work, furniture making, wood carving, boat building, plumbing, blacksmithing, mechanical and architectural drawing were offered on the primary school level during this period because pupils at that time were already adults. They were studying certain trades which they intended to follow after leaving school.</p>
                        </div>
                    </article>

                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">Philippine School of Arts and Trades</h3>
                            <span class="history-era__period">1910&ndash;1959</span>
                        </header>
                        <div class="history-era__body">
                            <p>In 1910, the MTS was renamed as the Philippine School of Arts and Trades (PSAT). It started to offer intermediate grade courses. The primary school level was then phased out because the ages of pupils were younger now than in 1901. With the growing student population at that time, PSAT relocated in 1916 to a 36,000 square meter property as its new campus site under Lot 1 Block 1485 Cad. 13, Manila Cadastre, located in Ermita, Manila bounded on northeast by Calle San Marcelino; on southeast by Estero Balete; and on northwest by Ayala Boulevard. Since then, this became the site of the TUP Main campus.</p>
                            <p>In 1915, PSAT was authorized to offer a secondary level curriculum and in 1927, it was classified as a full secondary level school. The intermediate grades were completely abolished and new courses, practical electricity and marine engineering, were offered. In 1928, PSAT piloted the first two-year college courses for industrial teachers and skilled workers and, in 1934, it was formally organized. In 1937, PSAT was formally classified as a junior college with two departments: teacher education and technical education. In 1941, the school closed because of the Pacific War of World War II. After the war in 1945, PSAT reopened and accommodated (1949) Dr. Frederick Leasure, the first Fulbright exchange professor and a professor of industrial education. In 1951, PSAT was granted authority to offer a four-year degree leading to BS in Industrial Education. This was a first among schools.</p>
                        </div>
                    </article>

                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">Philippine College of Arts and Trades</h3>
                            <span class="history-era__period">1959&ndash;1978</span>
                        </header>
                        <div class="history-era__body">
                            <p>On June 17, 1959, PSAT was converted into the Philippine College of Arts and Trades (PCAT) pursuant to RA No. 2237 — the PCAT Charter. Under the said Charter, PCAT was mandated to offer courses in arts, industrial education and technology leading to baccalaureate and graduate degrees. This enabled the College to pioneer the offering of a graduate degree program in industrial education in the second semester of SY 1959-1960.</p>
                            <p>During this period, the tatak &ldquo;PCAT&rdquo; became well known throughout the country due to the quality and excellent training and education of the pioneering industrial and technology programs being offered for the Filipinos.</p>
                        </div>
                    </article>

                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">Technological University of the Philippines</h3>
                            <span class="history-era__period">1978&ndash;present</span>
                        </header>
                        <div class="history-era__body">
                            <p>After 19 years, PCAT was elevated and converted into what is now known as the Technological University of the Philippines (TUP) by virtue of Presidential Decree No. 1518 on June 11, 1978. The TUP Charter mandates that the University shall provide higher and advanced vocational, technical, industrial, technological, and professional education and training in the industries and technology, and practical arts leading to certificates, diplomas and degrees. It shall provide progressive leadership in applied research, developmental studies in technical, industrial and technological fields and production using indigenous materials, effect technology transfer in the countryside; and assist in the development of small and medium scale industries in identified growth-centers. (Sec. 2 PD 1518)</p>
                        </div>
                    </article>

                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">National Polytechnic System expansion</h3>
                            <span class="history-era__period">1978 onward</span>
                        </header>
                        <div class="history-era__body">
                            <p>When the National Government established projects pursuant to Presidential Decree No. 6-A, three (3) prototype technician institutes in the Philippines were established funded under Credit Agreement 349 PH with the World Bank, namely: Manila Technician Institute (MTI) at Taguig, Metro Manila (1977); Visayan Technician Institute (VTI) at Talisay, Negros Occidental (1977) and Iligan Institute of Technology (IIT) at Iligan City, and ten (10) Regional Manpower Training Centers of the National Manpower and Youth Council (NMYC now TESDA) in various parts of the country.</p>
                            <p>With the urgent need to integrate all programs and activities of the said state-supported institutions and in the advent of the conversion of PCAT to TUP to provide leadership in the education and manpower potential in vocational, technical, industrial, technological and professional skills through technological program of education, Former President Ferdinand E. Marcos issued Letter of Implementation (LOI) No. 79 on December 28, 1978 establishing a National Polytechnic System on Technical/Technician Education through the integration of all state-supported institutions in the Philippines.</p>
                            <p>LOI 79 provides that the National Polytechnic System shall be organized and established with the Technological University of the Philippines (TUP) as the apex of the system, and the three (3) prototype technician institutes, the ten (10) Regional Manpower Training Centers, as well as all other state-supported institutions engaged in similar program as component of the system. The MTI and VTI shall be maintained and operated under the administration and supervision of TUP; provided, however, that with respect to IIT, which shall be administratively under the Mindanao State University, TUP shall only exercise functional supervision over its technical/technician programs for purposes of coordination and effective operation of the system.</p>
                            <p>This arrangement, however, with respect to IIT did not materialize due to its full integration to the MSU System. But in the case of MTI and VTI, their lands, buildings, facilities, equipment, appropriations and qualified personnel were effectively transferred to TUP. And in 1985, the TUP Board of Regents officially renamed MTI and VTI as TUP Taguig and TUP Visayas, respectively.</p>
                            <p>In 1981, the University expanded further when the Board of Regents established the TUP Cavite Campus in Barangay Salitran IV, Dasmarinas City, Cavite and operational since 1982 to present. This Campus was opened to cater to the needs for technology education of the people in the CALABARZON area.</p>
                        </div>
                    </article>

                    <article class="history-era">
                        <header class="history-era__head">
                            <h3 class="history-era__title">Leadership through the years</h3>
                            <span class="history-era__period">1901&ndash;present</span>
                        </header>
                        <div class="history-era__body">
                            <p>Ronald P. Gleason was the first principal (1901-1904) of the trade school; J.J. Eaton was the first superintendent (1905-1906); and Gregorio J. Sevilla was the first Filipino Superintendent (1936-1939). Prof. Jose S. Roldan became the first president of PCAT (1959-1961) and Prof. Apolinario G. Apilado succeeded him as the second president (1962-1967). Dr. Jose R. Vergara was the third president of PCAT and the first president of TUP (1968-1988). He was succeeded by Dr. Frederick So. Pada, the second TUP president (1988-2000). Dr. Bernardo F. Adiviso served as third president (Aug. 1-16, 2000) followed by Dr. Fedeserio C. Camarao who became the fourth and centennial president (March 28, 2001&ndash;March 27, 2005). Dr. Godofredo E. Gallega served as the fifth president (October 10, 2005&ndash;October 9, 2009); Dr. Olympio V. Caparas is the sixth president (October 16, 2009 to April 2014); Dr. Adora S. Pili seventh and first woman president; and Dr. Jesus Rodrigo F. Torres eighth TUP president.</p>
                            <p>With more than a hundred years of existence since its establishment as MTS, TUP has indeed transformed its &ldquo;trade school&rdquo; image into a dynamic premier state university in the fields of industrial, technological and engineering education. Its mark of excellence is not only known locally but also internationally.</p>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="history-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="history-cta-heading" class="acad-cta__title">Continue exploring About TUP</h2>
                <p class="acad-cta__lede">
                    Read the university’s mission and vision, or meet campus officials.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('about.mission') }}">Mission &amp; Vision</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('officials') }}">Officials</a>
                </div>
            </div>
        </section>
    </div>
@endsection
