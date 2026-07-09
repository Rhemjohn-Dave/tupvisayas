@extends('layouts.app')

@section('main_class', 'site-main--full')

@section('content')
    <div class="site-page site-page--enrollment">
        <figure class="enrollment-banner">
            <img src="{{ asset('images/admission-banner.jpg') }}"
                alt="TUP Visayas admission test — Be a Haligi ng Bayan, Be a TUPVIAN" loading="eager">
        </figure>

        <div class="enrollment-inner">
            <h1 class="site-page-title site-page-title--center">Enrollment procedure</h1>
            <p class="site-page-intro">Freshmen admission application and testing guidelines for TUP Visayas.</p>

            <section class="enrollment-about" aria-labelledby="enrollment-about-heading">
                <div class="enrollment-about__content">
                    <h2 id="enrollment-about-heading" class="enrollment-about__title">Be Haligi ng Bayan. Build skills, shape the nation.</h2>
                    <p>The Technological University of the Philippines Visayas (TUPV) admits a select number of freshmen each academic year who demonstrate the potential to succeed in rigorous technological and professional programs. This page provides information on application requirements, admission procedures, and testing schedules.</p>
                    <p>Admission to TUP Visayas is a privilege. As a state university committed to excellence, service, and nation-building, TUPV reserves the right to deny admission or require the withdrawal of students whose conduct or presence is deemed inconsistent with the University&rsquo;s mission, objectives, and regulations.</p>
                    <p>Applicants who show the capacity to benefit from the academic and technical programs of the University may be admitted. Due consideration is given to scholastic records, aptitude and readiness for higher education, character and conduct, recommendations, and commitment to the mission, vision, core values, and policies of TUP Visayas.</p>
                </div>
                <figure class="enrollment-about__media">
                    <img src="{{ asset('images/admission-student.jpg') }}" alt="TUP Visayas student" loading="lazy">
                </figure>
            </section>

            <p class="enrollment-lead">Follow the steps below and read the instructions carefully.</p>

            <article class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">1</span>
                    <h2 class="enrollment-step__title">Apply online</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Visit <a href="https://ers.tup.edu.ph/aims/applicants/" target="_blank" rel="noopener noreferrer">ers.tup.edu.ph/aims/applicants/</a>, then click <strong>Apply</strong>.</p>
                </div>
            </article>

            <article class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">2</span>
                    <h2 class="enrollment-step__title">Complete the profile verification form</h2>
                </header>
                <div class="enrollment-step__body">
                    <ul>
                        <li>Select <strong>Visayas Campus</strong>, then click <strong>Continue</strong>.</li>
                        <li>Fill out all required information.</li>
                    </ul>
                    <aside class="enrollment-callout">
                        <p class="enrollment-callout__title">Important reminders</p>
                        <ul>
                            <li>Complete the <strong>Family Background</strong> and <strong>Educational Attainment</strong> sections.</li>
                            <li>Upload a low-resolution <strong>2&times;2 photo</strong> in <strong>.jpeg</strong> or <strong>.jpg</strong> format.</li>
                            <li>Skip the <strong>Employment Background</strong> section, but ensure the <strong>Data Subject Consent Form</strong> is checked.</li>
                        </ul>
                    </aside>
                </div>
            </article>

            <article class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">3</span>
                    <h2 class="enrollment-step__title">Select exam schedule</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Click the <strong>Exam Schedule</strong> button at the top of the page and select your preferred admission test schedule.</p>
                </div>
            </article>

            <article class="enrollment-step">
                <header class="enrollment-step__head">
                    <span class="enrollment-step__num" aria-hidden="true">4</span>
                    <h2 class="enrollment-step__title">Save your account details</h2>
                </header>
                <div class="enrollment-step__body">
                    <p>Save a screenshot of your <strong>Account Details (USERNAME and PASSWORD)</strong> or print a copy of your application form.</p>
                </div>
            </article>

            <section class="enrollment-block" aria-labelledby="schedule-heading">
                <h2 id="schedule-heading" class="site-section-title">Admission test schedule</h2>
                <div class="site-table-scroll">
                    <table class="enrollment-table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Time</th>
                                <th scope="col">Venue</th>
                                <th scope="col">Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>January 22</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>January 23</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>January 24</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>January 28</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Negros Occidental High School<br><span class="enrollment-table__note">Exclusive to their SHS students only</span></td>
                                <td>Araneta Street, Barangay 39, Bacolod City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>January 31</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Eva J. Montilla Farm School</td>
                                <td>Barangay Inayawan, Mun. of Cauayan, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>February 7</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Hinigaran National High School</td>
                                <td>Rizal Street, Brgy. III, Mun. of Hinigaran, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>February 11</td>
                                <td>8 AM</td>
                                <td>Bacolod City National High School<br><span class="enrollment-table__note">Exclusive to their SHS students only</span></td>
                                <td>P. Hernandez Extension, Brgy. Taculing, Bacolod City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>February 13</td>
                                <td>8 AM</td>
                                <td>Don Bosco Technical Institute<br><span class="enrollment-table__note">Exclusive to their SHS students only</span></td>
                                <td>Victorias Milling Company (VMC) Compound, Victorias City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>February 21</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Do&ntilde;a Hortencia Salas Benedicto National High School — SHS Building</td>
                                <td>Gurrea Street, Barangay 1, La Carlota City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>February 24</td>
                                <td>8 AM</td>
                                <td>Pulupandan Municipal Auditorium</td>
                                <td>Municipality of Pulupandan, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>March 7</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Negros Women for Tomorrow Foundation / Dungganon — San Carlos City</td>
                                <td>Eco-Tourism Highway, Brgy. Palampas, San Carlos City</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <p class="enrollment-note">Additional test dates may be announced based on the number of applicants. Please check the website or contact the Admissions Office for updates.</p>
            </section>

            <section class="enrollment-block" aria-labelledby="test-day-heading">
                <h2 id="test-day-heading" class="site-section-title">On the day of the admission test</h2>
                <ul class="enrollment-checklist">
                    <li>Present a screenshot or printed copy of your application form.</li>
                    <li>Memorize your contact number, email address, and Applicant ID number as indicated on your proof of registration.</li>
                    <li>Bring <strong>two (2) sharpened pencils</strong>.</li>
                    <li>Dress appropriately: <strong>no shorts, sleeveless tops, or slippers</strong>.</li>
                    <li><strong>Watches are not allowed</strong>.</li>
                    <li>Ensure that <strong>cellphones and other electronic devices are turned off</strong> upon entering the venue.</li>
                    <li><strong>Arrive at least 30 minutes before</strong> your scheduled test time.</li>
                    <li>Walk-in applicants may be accommodated depending on available slots.</li>
                    <li><strong>Parents, guardians, and companions are not allowed</strong> to enter the testing venue.</li>
                </ul>
                <p class="enrollment-notice"><strong>Important:</strong> In accordance with the policy on universal access to education, <strong>no admission testing fee shall be collected</strong>.</p>
            </section>
        </div>
    </div>
@endsection
