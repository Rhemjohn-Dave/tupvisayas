<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__brand">
            <img src="{{ asset('images/tup-logo.png') }}" width="48" height="48" alt="TUP Visayas logo">
            <p class="site-footer__tagline">Technological University of the Philippines — Visayas campus. Excellence in
                technology and engineering education.</p>
        </div>
        <div class="site-footer__col">
            <h2>About</h2>
            <ul>
                <li><a href="{{ route('about.history') }}">History</a></li>
                <li><a href="{{ route('about.mission') }}">Mission &amp; Vision</a></li>
                <li><a href="{{ route('about.mandate') }}">Mandate</a></li>
                <li><a href="{{ route('officials') }}">Officials</a></li>
            </ul>
        </div>
        <div class="site-footer__col">
            <h2>Quick links</h2>
            <ul>
                <li><a href="{{ route('admissions.undergraduate') }}">Admissions</a></li>
                <li><a href="{{ route('academics') }}">Academics</a></li>
                <li><a href="{{ route('news_events') }}">News &amp; Events</a></li>
                <li><a href="{{ route('student_services') }}">Student services</a></li>
            </ul>
        </div>
        <div class="site-footer__col">
            <h2>Transparency</h2>
            <ul>
                <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
                <li><a href="https://www.foi.gov.ph/agencies/tup/" target="_blank" rel="noopener noreferrer">Freedom of
                        Information</a></li>
                <li><a href="{{ route('contact') }}">Contact</a></li>
                <li><a href="{{ route('jobs') }}">Careers</a></li>
            </ul>
        </div>
    </div>
    <div class="site-footer__bottom">
        <p>&copy; {{ date('Y') }} Technological University of the Philippines Visayas. All rights reserved.</p>
        <p>Developed by UITC TUPV</p>
    </div>
</footer>
