@extends('layouts.app')

@section('title', 'The TUP Mandate - TUP Visayas')

@section('main_class', 'site-main--full')

@section('head')
    @php
        $metaDescription = 'TUP Mandate under Presidential Decree No. 1518 — legal basis, key result areas, organizational outcomes, and full decree text.';
    @endphp
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:title" content="The TUP Mandate - TUP Visayas">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:image" content="{{ asset('images/tup-logo.png') }}">
@endsection

@section('content')
    <div class="site-page site-page--about-mandate">
        <section class="acad-hero" aria-labelledby="mandate-hero-heading">
            <p class="acad-hero__badge">About TUP</p>
            <h1 id="mandate-hero-heading" class="acad-hero__title">The TUP Mandate</h1>
            <p class="acad-hero__lede">
                Legal basis and organizational outcomes under Presidential Decree No. 1518 (June 11, 1978).
            </p>
            <div class="acad-hero__actions">
                <a class="acad-btn acad-btn--primary" href="#mandate-summary">PD 1518 summary</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.history') }}">History</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.mission') }}">Mission &amp; Vision</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('about.hymn') }}">Hymn</a>
                <a class="acad-btn acad-btn--ghost" href="{{ route('officials') }}">Officials</a>
            </div>
        </section>

        <section class="sit-section" id="mandate-summary" aria-labelledby="mandate-summary-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Charter</p>
                    <h2 id="mandate-summary-heading" class="sit-section__title">Presidential Decree No. 1518</h2>
                </header>
                <article class="about-highlight">
                    <p class="about-highlight__text">
                        The Technological University of the Philippines is mandated to provide higher and advanced vocational, technical, industrial, technological and professional education and training in the industries and technology, and in practical arts leading to certificates, diplomas, and degrees; to provide progressive leadership in applied research, developmental studies in technical, industrial and technological fields and production using indigenous materials, effect technology transfer in the countryside; and to provide expertise in the development of small and medium scale industries in identified growth-centers.
                    </p>
                </article>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="mandate-kra" aria-labelledby="kra-heading">
            <div class="sit-section__inner">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Framework</p>
                    <h2 id="kra-heading" class="sit-section__title">Key result areas</h2>
                </header>
                <div class="about-highlight-grid about-highlight-grid--three">
                    <article class="about-highlight">
                        <h3 class="about-highlight__title">Key result areas</h3>
                        <p class="about-highlight__text">Poverty reduction and empowerment of the poor and vulnerable.</p>
                    </article>
                    <article class="about-highlight">
                        <h3 class="about-highlight__title">Sector outcome</h3>
                        <p class="about-highlight__text">Enhanced knowledge and skills, attitudes and values of Filipinos to lead productive lives.</p>
                    </article>
                    <article class="about-highlight">
                        <h3 class="about-highlight__title">Organizational outcomes</h3>
                        <p class="about-highlight__text">Relevant and quality tertiary education ensured to achieve inclusive growth.</p>
                    </article>
                </div>
            </div>
        </section>

        <section class="sit-section" id="mandate-outcomes" aria-labelledby="outcomes-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Results</p>
                    <h2 id="outcomes-heading" class="sit-section__title">Organizational outcomes</h2>
                </header>
                <ol class="about-ordered-list">
                    <li>Relevant and quality tertiary education ensured to achieve inclusive growth.</li>
                    <li>Access of deserving but poor students to quality tertiary education increased.</li>
                    <li>Higher education research improved to promote economic productivity and innovation.</li>
                    <li>Community engagement increased.</li>
                </ol>
            </div>
        </section>

        <section class="sit-section sit-section--muted" id="mandate-decree" aria-labelledby="decree-heading">
            <div class="sit-section__inner sit-section__inner--narrow">
                <header class="sit-section__head">
                    <p class="sit-eyebrow">Full text</p>
                    <h2 id="decree-heading" class="sit-section__title">Presidential Decree No. 1518</h2>
                </header>

                <div class="mandate-decree">
                    <header class="mandate-decree__header">
                        <p class="mandate-decree__kicker">Malaca&ntilde;ang, Manila</p>
                        <h3 class="mandate-decree__doc-title">Presidential Decree No. 1518</h3>
                        <p class="mandate-decree__subtitle">Converting the Philippine College of Arts and Trades into the Technological University of the Philippines, defining its objectives, organizational structure and functions, and expanding its programs</p>
                    </header>

                    <div class="mandate-decree__body site-prose">
                        <p><strong>WHEREAS,</strong> the Constitution of the Philippines directs the State to establish a complete, adequate and integrated system of education relevant to the goals of national development and prescribes that all educational institutions shall aim to develop scientific, technological and vocational efficiency;</p>
                        <p><strong>WHEREAS,</strong> it has been declared a policy of the government under Presidential Decree No. 6-A, otherwise known as the Educational Development Decree of 1972, to reorient the educational system toward an accelerated national economic growth and meaningful social development;</p>
                        <p><strong>WHEREAS,</strong> the Presidential Commission to Survey Philippine Education (PCSPE) recommended that high priority be given to the provision of technical and vocational education and retraining programs in order to meet current and projected needs for trained manpower in a developing society;</p>
                        <p><strong>WHEREAS,</strong> to attain the development of vocational, scientific and technological efficiency necessary for national economic growth and meaningful social development, it is desirable that the education and training of the manpower potential in vocational, technical, industrial, technological and professional skills be approached through the technological program of education;</p>
                        <p><strong>WHEREAS,</strong> the Philippine College of Arts and Trades as a premier institution in technological education has demonstrated its capability to provide the necessary leadership in the field of technological education;</p>
                        <p><strong>NOW, THEREFORE, I, FERDINAND E. MARCOS,</strong> President of the Philippines, by virtue of the powers vested in me by the Constitution, do hereby decree and order:</p>

                        <h4 class="mandate-decree__section">Section 1.</h4>
                        <p>The Philippine College of Arts and Trades is hereby converted into the Technological University of the Philippines.</p>

                        <h4 class="mandate-decree__section">Section 2.</h4>
                        <p>The University shall provide higher and advanced vocational, technical, industrial, technological and professional education and training in industries and technology, and in practical arts leading to certificates, diplomas and degrees; to provide progressive leadership in applied research, developmental studies in technical, industrial and technological fields and production using indigenous materials, effect technology transfer in the countryside; and assist in the development of small and medium scale industries in identified growth-centers.</p>

                        <h4 class="mandate-decree__section">Section 3.</h4>
                        <p>The governing body of the University shall be the Board of Regents of the Technological University of the Philippines which shall be composed of the following:</p>
                        <ul class="mandate-decree__list">
                            <li>Minister of Education and Culture, Chairman</li>
                            <li>President of the University, Vice-Chairman</li>
                            <li>Representative of the National Economic and Development Authority (NEDA), Member</li>
                            <li>Two (2) prominent citizens who have distinguished themselves in the professions or fields or specialization of the University, one representing the alumni association of the University, the other chosen from prominent citizens of Metro Manila, to be appointed by the President of the Philippines upon recommendation of the Minister of Education and Culture, Members.</li>
                        </ul>
                        <p>The first group of appointive regents shall serve for two (2) years and four (4) years, respectively. Thereafter, the appointees shall hold office for a term of four (4) years. In case of permanent vacancy, the appointee shall hold office for the unexpired term only.</p>
                        <p>In the absence of the Minister of Education and Culture, the Minister shall authorize a representative, preferably the Deputy Minister concerned and at the least a director, to sit in the meetings of the board: Provided, however, that during these meetings the President of the University shall preside a Vice-Chairman of the Board.</p>

                        <h4 class="mandate-decree__section">Section 4.</h4>
                        <p>The Board of Regents of the University shall exercise policy-making functions in accordance with the general policies, plans, and programs on education as may be formulated by the National Board of Education and the Minister of Education and Culture and the general policies, plans, and programs on national and regional development as may be issued by the National Economic and Development Authority (NEDA). The Minister of Education and Culture as Chairman of the Board of Regents shall see to it that the general educational policies, plans, and programs as formulated and promulgated are adopted and observed by the University.</p>

                        <h4 class="mandate-decree__section">Section 5.</h4>
                        <p>Subject to the provisions of Section 4 hereof, the Board of Regents shall have the following specific powers and duties in addition to the general powers as provided in Section Thirteen of Act Numbered Fourteen Hundred and Fifty-Nine, as amended, otherwise known as the Corporation Law:</p>
                        <ul class="mandate-decree__list">
                            <li>To enact for the government of the University such rules and regulations not contrary to law, as may be necessary to carry out the purpose and functions of the University.</li>
                            <li>To receive and appropriate to the ends specified by law such sums as may be provided for the support of the University.</li>
                            <li>To import duty-free essential commodities and materials for advanced educational or technological programs as an exception to existing laws, provided such commodities or materials are not available locally; and to receive in trust legacies, gifts, and donations of real and personal property of all kinds, to administer the same for the benefit of the University or for aid to any student in accordance with the directions and instructions of the donor, and in default thereof, in such manner as the Board of Regents may in its discretion determine.</li>
                            <li>To approve the curricula and rules and discipline drawn by the Administrative and Academic Councils as hereinafter provided.</li>
                            <li>To confer degrees upon successful candidates for graduation, to award honorary degrees upon persons in recognition of learning, public service, statesmanship or eminence in any field of specialization of the University and to authorize the President of the University to award certificates for completion on non-degree programs.</li>
                            <li>To confirm appointments of the vice president, deans, directors, registrars, heads of departments, professors and other officials and employees of the University made by the President; to fix their compensation, hours of service, and such other duties and conditions as the Board of Regents may promulgate, in accordance with the provisions of existing laws; to remove them for cause after investigation and hearing.</li>
                            <li>To establish chairs in the University and to provide fellowships for qualified faculty members and scholarships to deserving students.</li>
                            <li>To fix tuition fees and such other necessary school charges as the Board of Regents may deem proper to impose. Such fees and charges, including other incomes generated by the University shall constitute a special trust fund for the exclusive use of the University, any provisions of existing laws to the contrary notwithstanding.</li>
                            <li>To authorize the construction or repair of its buildings, machineries, equipment and other facilities and the purchase of necessary supplies, materials, and equipment, any provision of law to the contrary notwithstanding: provided, however, that the funds for the purpose shall come from the authorized appropriation of the University.</li>
                        </ul>

                        <h4 class="mandate-decree__section">Section 15.</h4>
                        <p>The Minister of Education and Culture is hereby directed to take steps as are necessary for the immediate implementation of this Decree.</p>

                        <h4 class="mandate-decree__section">Section 16.</h4>
                        <p>All buildings, equipment and facilities of and all parcels of land occupied by the Philippine College of Arts and Trades bounded by Ayala Boulevard, San Marcelino Street and Estero de Balete including the site and building of the Research and Training Center of the Department of Education and Culture shall be transferred to the University: Provided, That an additional ten hectares shall be proclaimed out of government reservation for the expansion and location of the new University site.</p>

                        <h4 class="mandate-decree__section">Section 17.</h4>
                        <p>Such additional amount as may be necessary for the operations and expansion of the University is hereby authorized to be appropriated under the General Appropriations Law.</p>

                        <h4 class="mandate-decree__section">Section 18.</h4>
                        <p>In order not to interrupt the smooth functioning of the institution, all faculty and personnel of the college shall be absorbed by the University with the incumbent president as the first President of the University and other officers of administration to occupy the equivalent positions as provided for in this Decree.</p>

                        <h4 class="mandate-decree__section">Section 19.</h4>
                        <p>All laws, decrees, orders, rules and regulations or parts thereof inconsistent with the provisions of this Decree are hereby repealed or modified accordingly.</p>

                        <h4 class="mandate-decree__section">Section 20.</h4>
                        <p>This Decree shall take effect immediately.</p>

                        <p class="mandate-decree__signed">Done in the City of Manila, this 11th day of June, in the year of Our Lord, nineteen hundred and seventy-eight.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="acad-cta" aria-labelledby="mandate-cta-heading">
            <div class="acad-cta__inner">
                <h2 id="mandate-cta-heading" class="acad-cta__title">More About TUP</h2>
                <p class="acad-cta__lede">
                    Listen to the TUP Hymn, or review transparency documents for the Visayas campus.
                </p>
                <div class="acad-cta__actions">
                    <a class="acad-btn acad-btn--on-dark" href="{{ route('about.hymn') }}">The TUP Hymn</a>
                    <a class="acad-btn acad-btn--outline-light" href="{{ route('transparency_seal') }}">Transparency Seal</a>
                </div>
            </div>
        </section>
    </div>
@endsection
