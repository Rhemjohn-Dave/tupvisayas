<footer class="site-footer">
    <div class="site-footer__inner">
        <div class="site-footer__brand">
            <img src="{{ asset('images/tup-logo.png') }}" width="48" height="48" alt="TUP Visayas logo">
            <p class="site-footer__tagline">Technological University of the Philippines — Visayas campus. Excellence in
                technology and engineering education.</p>
            <div class="site-footer__logos" aria-label="Partner logos">
                <a href="https://www.gov.ph" target="_blank" rel="noopener noreferrer"
                    title="Official Gazette of the Republic of the Philippines">
                    <img src="{{ asset('images/gov-ph-logo.svg') }}" alt="Official Gazette / gov.ph" width="88"
                        height="28">
                </a>
                <a href="https://ched.gov.ph" target="_blank" rel="noopener noreferrer"
                    title="Commission on Higher Education">
                    <img src="{{ asset('images/ched-logo.png') }}" alt="CHED" width="72" height="28">
                </a>
            </div>
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
                <li><a href="{{ route('admissions.enrollment') }}">Admissions</a></li>
                <li><a href="{{ route('academics') }}">Academics</a></li>
                <li><a href="{{ route('news_events') }}">News &amp; Events</a></li>
                <li><a href="{{ route('student_services') }}">Student services</a></li>
            </ul>
        </div>
        <div class="site-footer__col">
            <h2>Transparency</h2>
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
                <li><a href="https://www.foi.gov.ph/agencies/tup/" target="_blank" rel="noopener noreferrer">Freedom of
                        Information</a></li>
                <li><a href="https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link"
                        target="_blank" rel="noopener noreferrer">Citizen's Charter</a></li>
                <li><a href="{{ route('jobs') }}">Careers</a></li>
                <li><a href="https://www.gov.ph/feedback" target="_blank" rel="noopener noreferrer">Feedback</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>
                @guest
                    <li><a href="{{ route('login') }}">Admin Login</a></li>
                @endguest
            </ul>
        </div>
    </div>
    <div class="site-footer__bottom">
        <p>&copy; {{ date('Y') }} Technological University of the Philippines Visayas. All rights reserved.</p>
        <p>
            <a href="{{ route('privacy.notice') }}">Privacy Notice (RA 10173)</a>
            · Developed by UITC TUPV
        </p>
    </div>
</footer>
