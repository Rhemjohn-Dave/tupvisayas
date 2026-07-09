@extends('layouts.app')

@section('content')
<<<<<<< HEAD
    <div class="section site-page site-page--contact">
        <h1 class="site-page-title site-page-title--center">Contact us</h1>
        <p class="site-page-intro">Reach TUP Visayas for admissions, campus services, and general inquiries.</p>

        <div class="contact-grid">
            <section class="contact-details" aria-labelledby="campus-info-heading">
                <h2 id="campus-info-heading" class="site-section-title">Campus information</h2>
                <dl class="contact-list">
                    <div class="contact-list__item">
                        <dt>Address</dt>
                        <dd>Capt. Sabi Street, Brgy. Zone 12, Talisay City, Negros Occidental 6115</dd>
                    </div>
                    <div class="contact-list__item">
                        <dt>Telephone</dt>
                        <dd><a href="tel:+63344953480">(034) 495-3480</a></dd>
                    </div>
                    <div class="contact-list__item">
                        <dt>Website</dt>
                        <dd><a href="https://www.tupvisayas.edu.ph/" target="_blank" rel="noopener noreferrer">www.tupvisayas.edu.ph</a></dd>
                    </div>
                </dl>

                <h2 class="site-section-title">Key offices</h2>
                <ul class="contact-offices">
                    <li>
                        <strong>Admissions</strong>
                        <span>See the <a href="{{ route('admissions.enrollment') }}">enrollment procedure</a> page for application steps and test schedules.</span>
                    </li>
                    <li>
                        <strong>Transparency</strong>
                        <span><a href="mailto:transparency@tupv.edu.ph">transparency@tupv.edu.ph</a></span>
                    </li>
                    <li>
                        <strong>University IT Center</strong>
                        <span><a href="mailto:visayas.uitc@tup.edu.ph">visayas.uitc@tup.edu.ph</a></span>
                    </li>
                </ul>

                <p class="contact-note">For official government inquiries, you may also visit the links on the utility bar above (Transparency Seal, FOI, Citizen&rsquo;s Charter).</p>
            </section>

            <section class="contact-map" aria-labelledby="location-heading">
                <h2 id="location-heading" class="site-section-title">Location</h2>
                <div class="site-embed contact-map__embed">
                    <iframe
                        src="https://maps.google.com/maps?q=Technological+University+of+the+Philippines+Visayas,+Capitan+Sabi+Street,+Talisay+City,+Negros+Occidental&amp;t=&amp;z=15&amp;ie=UTF8&amp;iwloc=&amp;output=embed"
                        title="TUP Visayas campus map"
                        allowfullscreen
                        loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <p class="contact-map__link">
                    <a href="https://maps.google.com/?q=Technological+University+of+the+Philippines+Visayas,+Talisay+City,+Negros+Occidental"
                        target="_blank" rel="noopener noreferrer">Open in Google Maps</a>
                </p>
            </section>
        </div>
    </div>
@endsection
=======
    <div class="section">
        <h3>Contact Us</h3>
        <div class="row">
            <div class="col s12 m6">
                <form action="#" method="POST">
                    @csrf
                    <div class="input-field">
                        <input id="name" name="name" type="text" required>
                        <label for="name">Name</label>
                    </div>
                    <div class="input-field">
                        <input id="email" name="email" type="email" required>
                        <label for="email">Email</label>
                    </div>
                    <div class="input-field">
                        <textarea id="message" name="message" class="materialize-textarea" required></textarea>
                        <label for="message">Message</label>
                    </div>
                    <button type="submit" class="btn waves-effect waves-light">Send Message</button>
                </form>
            </div>
            <div class="col s12 m6">
                <div class="video-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3930.0000000000005!2d123.00000000000001!3d10.000000000000002!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2sTUP%20Visayas!5e0!3m2!1sen!2sph!4v00000000000!5m2!1sen!2sph"
                        width="100%" height="300" frameborder="0" style="border:0" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>
@endsection
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
