<div class="site-utility">
    <div class="site-utility__inner">
        <div class="site-utility__logos">
            <a href="https://www.gov.ph" target="_blank" rel="noopener noreferrer"
                title="Official Gazette of the Republic of the Philippines">
                <img src="{{ asset('images/gov-ph-logo.svg') }}" alt="gov.ph" width="80" height="22">
            </a>
            <a href="https://ched.gov.ph" target="_blank" rel="noopener noreferrer" title="Commission on Higher Education">
                <img src="{{ asset('images/ched-logo.png') }}" alt="CHED" width="60" height="22">
            </a>
        </div>
        <ul class="site-utility__links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('transparency_seal') }}">Transparency Seal</a></li>
            <li><a href="https://www.foi.gov.ph/agencies/tup/" target="_blank" rel="noopener noreferrer">Freedom of
                    Information</a></li>
            <li><a href="https://drive.google.com/file/d/1u_I6kqTajs8CYbA7dKqp3LqL4NgPxL6w/view?usp=drive_link"
                    target="_blank" rel="noopener noreferrer">Citizen's Charter</a></li>
            <li><a href="{{ route('jobs') }}">Careers</a></li>
            <li><a href="https://www.gov.ph/feedback" target="_blank" rel="noopener noreferrer">Feedback</a></li>
            <li><a href="https://www.gov.ph/contact" target="_blank" rel="noopener noreferrer">Contact Us</a></li>
            @guest
                <li><a href="{{ route('login') }}">Admin Login</a></li>
            @endguest
        </ul>
    </div>
</div>
