@extends('layouts.app')

@section('head')
    <style>
        .page-header {
            margin-bottom: 2.5rem;
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
        }
    </style>
@endsection

@section('content')
    <div class="section">
        <div class="page-header">
            <h3 class="page-title">Enrollment Procedure for Freshmen Students</h3>
            <p class="page-subtitle">TUP Visayas Admission Test (TUPSTAT) - Application for School Year 2026–2027</p>
        </div>

        <div class="procedure-section">
            <div
                style="background: #C41E3A; color: white; padding: 1rem; border-radius: 6px; margin-bottom: 1.5rem; text-align: center;">
                <strong style="font-size: 1.1rem;">Application is NOW OPEN!</strong>
            </div>
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

        <!-- ON THE DAY OF THE ADMISSION TEST -->
        <div class="procedure-section">
            <h3 style="color: #C41E3A; font-weight: 700; font-size: 1.5rem; margin-bottom: 1.5rem;">
                ON THE DAY OF THE ADMISSION TEST:
            </h3>
            <div class="info-box">
                <ul>
                    <li>Present a screenshot or printed copy of your application form.</li>
                    <li>Memorize your contact number, email address, and Applicant ID number as indicated on your proof of
                        registration.</li>
                    <li>Bring <strong>two (2) sharpened pencils</strong>.</li>
                    <li>Dress appropriately: <strong>no shorts, sleeveless tops, or slippers</strong>.</li>
                    <li><strong>Watches are not allowed</strong>.</li>
                    <li>Ensure that <strong>cellphones and other electronic devices are turned off</strong> upon entering
                        the venue.</li>
                    <li><strong>Arrive at least 30 minutes before</strong> your scheduled test time.</li>
                    <li>Walk-in applicants may be accommodated depending on available slots.</li>
                    <li><strong>Parents, guardians, and companions are not allowed</strong> to enter the testing venue.</li>
                </ul>
            </div>

            <div class="warning-note">
                <p style="margin: 0;">
                    <strong>Important:</strong> In accordance with the policy on universal access to education, <strong>NO
                        admission testing fee shall be collected</strong>.
                </p>
            </div>
        </div>
    </div>
@endsection