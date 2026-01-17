@extends('layouts.app')

@section('head')
    <style>
        .enrollment-banner-image {
            width: 100%;
            max-height: 600px;
            object-fit: cover;
            margin-bottom: 2rem;
            display: block;
        }

        .admission-intro {
            margin-bottom: 2.5rem;
            padding: 3rem 2rem;
            background: linear-gradient(135deg, #C41E3A 0%, #8B1538 100%);
            border-radius: 0;
            display: flex;
            align-items: center;
            gap: 3rem;
            overflow: hidden;
            width: 100%;
        }

        .admission-intro-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            gap: 3rem;
        }

        .admission-intro-image {
            flex: 0 0 300px;
            position: relative;
        }

        .admission-intro-image img {
            width: 400px;
            height: 400px;
            border-radius: 50%;
            object-fit: cover;
            border: 8px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
            background: #C41E3A;
        }

        .admission-intro-content {
            flex: 1;
            color: white;
        }

        .admission-intro-content h2 {
            color: white;
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .admission-intro-content h2 .highlight {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 4px;
            margin-top: 0.5rem;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .admission-intro-content p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            text-align: justify;
        }

        .admission-intro-content p:last-child {
            margin-bottom: 0;
        }

        @media (max-width: 992px) {
            .admission-intro {
                padding: 2rem 1.5rem;
            }

            .admission-intro-wrapper {
                flex-direction: column;
                gap: 2rem;
            }

            .admission-intro-image {
                flex: 0 0 auto;
                order: 1;
            }

            .admission-intro-content {
                order: 2;
            }

            .admission-intro-image img {
                width: 250px;
                height: 250px;
            }

            .admission-intro-content h2 {
                font-size: 2rem;
            }
        }

        .page-title {
            color: #C41E3A;
            font-weight: 700;
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            color: #666;
            font-size: 1.1rem;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .enrollment-banner-image {
                max-height: 400px;
            }
        }

        .procedure-section {
            background: #fff;
            border-radius: 8px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .procedure-section h3 {
            color: #C41E3A;
            font-weight: 700;
            font-size: 1.5rem;
            margin-bottom: 1.5rem;
            padding-bottom: 0.75rem;
            border-bottom: 3px solid #C41E3A;
        }

        .step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 35px;
            height: 35px;
            background: #C41E3A;
            color: white;
            border-radius: 50%;
            font-weight: 700;
            font-size: 1.1rem;
            margin-right: 12px;
            flex-shrink: 0;
        }

        .step-header {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .step-title {
            color: #C41E3A;
            font-weight: 700;
            font-size: 1.3rem;
            margin: 0;
        }

        .step-content {
            margin-left: 47px;
            color: #333;
            line-height: 1.8;
        }

        .step-content ul {
            margin: 1rem 0;
            padding-left: 2rem;
        }

        .step-content li {
            margin-bottom: 0.75rem;
            color: #555;
        }

        .step-content strong {
            color: #C41E3A;
            font-weight: 600;
        }

        .highlight-box {
            background: #fff6f7;
            border-left: 4px solid #C41E3A;
            padding: 1.5rem;
            margin: 1.5rem 0;
            border-radius: 4px;
        }

        .highlight-box ul {
            margin: 0.5rem 0;
            padding-left: 2rem;
        }

        .highlight-box li {
            margin-bottom: 0.5rem;
        }

        .info-box {
            background: #f8f9fa;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1.5rem 0;
        }

        .info-box h4 {
            color: #C41E3A;
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .info-box ul {
            margin: 0.5rem 0;
            padding-left: 2rem;
        }

        .info-box li {
            margin-bottom: 0.75rem;
            color: #555;
        }

        .qr-link {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            color: #C41E3A;
            font-weight: 600;
            text-decoration: none;
            margin: 0.5rem 0;
            padding: 0.5rem 1rem;
            border: 2px solid #C41E3A;
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .qr-link:hover {
            background: #C41E3A;
            color: white;
        }

        .warning-note {
            background: #fff3cd;
            border-left: 4px solid #ffc107;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            border-radius: 4px;
            color: #856404;
        }

        .warning-note strong {
            color: #856404;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            margin: 1.5rem 0;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .schedule-table thead {
            background: #C41E3A;
            color: white;
        }

        .schedule-table thead th {
            padding: 1rem;
            text-align: left;
            font-weight: 700;
            font-size: 1rem;
        }

        .schedule-table tbody tr {
            border-bottom: 1px solid #e0e0e0;
            transition: background-color 0.2s ease;
        }

        .schedule-table tbody tr:hover {
            background-color: #fff6f7;
        }

        .schedule-table tbody tr:last-child {
            border-bottom: none;
        }

        .schedule-table tbody td {
            padding: 1rem;
            color: #333;
            vertical-align: top;
        }

        .schedule-table tbody td:first-child {
            font-weight: 600;
            color: #C41E3A;
            width: 15%;
        }

        .schedule-table tbody td:nth-child(2) {
            width: 15%;
        }

        .schedule-table tbody td:nth-child(3) {
            width: 20%;
        }

        .schedule-table tbody td:nth-child(4) {
            width: 50%;
            color: #666;
            font-size: 0.95rem;
        }

        .schedule-item-note {
            color: #ff6b00;
            font-style: italic;
            font-size: 0.9rem;
            margin-top: 0.25rem;
            font-weight: 600;
        }

        .schedule-note {
            background: #e3f2fd;
            border-left: 4px solid #2196f3;
            padding: 1rem 1.5rem;
            margin: 1.5rem 0;
            border-radius: 4px;
            color: #1565c0;
            font-size: 0.95rem;
        }

        @media (max-width: 768px) {
            .page-title {
                font-size: 1.75rem;
            }

            .step-header {
                flex-wrap: wrap;
            }

            .step-content {
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .procedure-section {
                padding: 1.5rem;
            }

            .schedule-table {
                font-size: 0.9rem;
            }

            .schedule-table thead th,
            .schedule-table tbody td {
                padding: 0.75rem 0.5rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Banner Image Section -->
    <div class="section" style="padding-top: 2rem; padding-bottom: 0;">
        <img src="{{ asset('images/admission-banner.jpg') }}"
            alt="TUP Visayas Admission Test S.Y 2026-2027 - Be a Haligi ng Bayan, Be a TUPVIAN"
            class="enrollment-banner-image"
            onerror="this.onerror=null; this.src='https://via.placeholder.com/1200x600/C41E3A/FFFFFF?text=TUP+Visayas+Admission+Test';">
    </div>

    <!-- Admission Introduction Section -->
    <div class="admission-intro">
        <div class="admission-intro-wrapper">
            <div class="admission-intro-image">
                <img src="{{ asset('images/admission-student.jpg') }}" alt="TUP Visayas Student"
                    onerror="this.onerror=null; this.src='https://via.placeholder.com/350x350/1565c0/FFFFFF?text=TUPV+Student';">
            </div>
            <div class="admission-intro-content">
                <h2>Be Haligi ng Bayan.<br><span class="highlight">Build Skills, Shape the Nation.</span></h2>

                <p>The Technological University of the Philippines Visayas (TUPV) admits a select number of freshmen each
                    academic year who demonstrate the potential to succeed in rigorous technological and professional
                    programs. The Undergraduate Admissions section provides comprehensive information on academic
                    preparation, application requirements, admission procedures, and frequently asked questions to guide
                    prospective students.</p>

                <p>Admission to the Technological University of the Philippines Visayas is a privilege. As a state
                    university committed to excellence, service, and nation-building, TUPV reserves the right to deny
                    admission or require the withdrawal of students whose conduct or presence is deemed inconsistent with
                    the University's mission, objectives, and regulations.</p>

                <p>Applicants who, in the judgment of the admissions committee, show the capacity to benefit from the
                    academic and technical programs of the University may be admitted. In evaluating applicants, due
                    consideration is given to previous scholastic records, aptitude and readiness for higher education,
                    character and conduct, recommendations, and the applicant's commitment to uphold the mission, vision,
                    core values, and policies of the Technological University of the Philippines Visayas.</p>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="section">

            <div class="procedure-section">
                <p style="color: #555; font-size: 1.05rem; line-height: 1.8;">
                    Kindly follow the steps below and read the instructions carefully:
                </p>
            </div>

            <!-- STEP 1 -->
            <div class="procedure-section">
                <div class="step-header">
                    <span class="step-number">1</span>
                    <h3 class="step-title">STEP 1</h3>
                </div>
                <div class="step-content">
                    <p>Visit <a href="https://ers.tup.edu.ph/aims/applicants/" target="_blank"
                            class="qr-link">ers.tup.edu.ph/aims/applicants/</a>, then click <strong>"Apply."</strong></p>
                </div>
            </div>

            <!-- STEP 2 -->
            <div class="procedure-section">
                <div class="step-header">
                    <span class="step-number">2</span>
                    <h3 class="step-title">STEP 2</h3>
                </div>
                <div class="step-content">
                    <p><strong>Complete the Profile Verification Form:</strong></p>
                    <ul>
                        <li>Select <strong>"Visayas Campus"</strong>, then click <strong>"Continue."</strong></li>
                        <li>Fill out all required information.</li>
                    </ul>

                    <div class="highlight-box">
                        <p style="margin-top: 0; font-weight: 600; color: #C41E3A;">Important reminders:</p>
                        <ul>
                            <li>Make sure to complete the <strong>Family Background</strong> and <strong>Educational
                                    Attainment</strong> sections.</li>
                            <li>Upload a low-resolution <strong>2x2 photo</strong> in <strong>.jpeg</strong> or
                                <strong>.jpg</strong> format.
                            </li>
                            <li>Skip the <strong>Employment Background</strong> section, but ensure that the <strong>Data
                                    Subject Consent Form</strong> is checked.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- STEP 3 -->
            <div class="procedure-section">
                <div class="step-header">
                    <span class="step-number">3</span>
                    <h3 class="step-title">STEP 3</h3>
                </div>
                <div class="step-content">
                    <p>Click the <strong>"Exam Schedule"</strong> button at the top of the page and select your preferred
                        Admission Test schedule.</p>
                </div>
            </div>

            <!-- STEP 4 -->
            <div class="procedure-section">
                <div class="step-header">
                    <span class="step-number">4</span>
                    <h3 class="step-title">STEP 4</h3>
                </div>
                <div class="step-content">
                    <p>Save a screenshot of your <strong>Account Details (USERNAME and PASSWORD)</strong> or print a copy of
                        your application form.</p>
                </div>
            </div>

            <!-- TESTING SCHEDULE -->
            <div class="procedure-section">
                <h3 style="color: #C41E3A; font-weight: 700; font-size: 1.5rem; margin-bottom: 1.5rem;">
                    ADMISSION TEST SCHEDULE
                </h3>
                <div style="overflow-x: auto;">
                    <table class="schedule-table">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Venue</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>JANUARY 22</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>JANUARY 23</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>JANUARY 24</td>
                                <td>8 AM<br>1 PM</td>
                                <td>TUP Visayas Gymnasium</td>
                                <td>Capt. Sabi, Brgy Zone 12, Talisay City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>JANUARY 28</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Negros Occidental High School<br><span class="schedule-item-note">Exclusive to their SHS
                                        students only</span></td>
                                <td>Araneta Street, Barangay 39, Bacolod City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>JANUARY 31</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Eva J. Montilla Farm School</td>
                                <td>Barangay Inayawan, Mun. of Cauayan, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>FEBRUARY 7</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Hinigaran National High School</td>
                                <td>Rizal Street., Brgy. III, Mun. of Hinigaran, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>FEBRUARY 11</td>
                                <td>8 AM</td>
                                <td>Bacolod City National High School<br><span class="schedule-item-note">Exclusive to their
                                        SHS
                                        students only</span></td>
                                <td>P. Hernandez Extension, Brgy. Taculing, Bacolod City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>FEBRUARY 13</td>
                                <td>8 AM</td>
                                <td>Don Bosco Technical Institute<br><span class="schedule-item-note">Exclusive to their SHS
                                        students only</span></td>
                                <td>Victorias Milling Company (VMC) Compound, Victorias City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>FEBRUARY 21</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Doña Hortencia Salas Benedicto National High School - SHS Building</td>
                                <td>Gurrea Street, Barangay 1, La Carlota City, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>FEBRUARY 24</td>
                                <td>8 AM</td>
                                <td>Pulupandan Municipal Auditorium</td>
                                <td>Municipality of Pulupandan, Negros Occidental</td>
                            </tr>
                            <tr>
                                <td>MARCH 7</td>
                                <td>8 AM<br>1 PM</td>
                                <td>Negros Women for Tomorrow Foundation / Dungganon - San Carlos City</td>
                                <td>Eco-Tourism Highway, Brgy. Palampas, San Carlos City</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="schedule-note">
                    <strong>Note:</strong> Additional test dates may be announced based on the number of applicants. Please
                    check the website or contact the Admissions Office for updates.
                </div>
            </div>

            <!-- ON THE DAY OF THE ADMISSION TEST -->
            <div class="procedure-section">
                <h3 style="color: #C41E3A; font-weight: 700; font-size: 1.5rem; margin-bottom: 1.5rem;">
                    ON THE DAY OF THE ADMISSION TEST:
                </h3>
                <div class="info-box">
                    <ul>
                        <li>Present a screenshot or printed copy of your application form.</li>
                        <li>Memorize your contact number, email address, and Applicant ID number as indicated on your proof
                            of
                            registration.</li>
                        <li>Bring <strong>two (2) sharpened pencils</strong>.</li>
                        <li>Dress appropriately: <strong>no shorts, sleeveless tops, or slippers</strong>.</li>
                        <li><strong>Watches are not allowed</strong>.</li>
                        <li>Ensure that <strong>cellphones and other electronic devices are turned off</strong> upon
                            entering
                            the venue.</li>
                        <li><strong>Arrive at least 30 minutes before</strong> your scheduled test time.</li>
                        <li>Walk-in applicants may be accommodated depending on available slots.</li>
                        <li><strong>Parents, guardians, and companions are not allowed</strong> to enter the testing venue.
                        </li>
                    </ul>
                </div>

                <div class="warning-note">
                    <p style="margin: 0;">
                        <strong>Important:</strong> In accordance with the policy on universal access to education,
                        <strong>NO
                            admission testing fee shall be collected</strong>.
                    </p>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection