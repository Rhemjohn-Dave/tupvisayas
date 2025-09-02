@extends('layouts.app')

@section('title', 'University Information Technology Center - TUP Visayas')

@section('head')
    <style>
        .uitc-hero {
            background: linear-gradient(135deg, #C41E3A 0%, #8B1538 100%);
            color: white;
            padding: 2.5rem 0;
            margin-bottom: 2rem;
        }

        .uitc-hero h1 {
            font-size: 2.5rem;
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .uitc-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
        }

        .uitc-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .uitc-section h2 {
            color: #C41E3A;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #C41E3A;
            padding-bottom: 0.5rem;
        }

        .uitc-section h3 {
            color: #333;
            font-size: 1.3rem;
            font-weight: 600;
            margin: 1.5rem 0 1rem 0;
        }

        .service-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .service-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .service-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-color: #C41E3A;
        }

        .service-card h4 {
            color: #C41E3A;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .service-card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .service-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .service-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #C41E3A;
            color: white !important;
            text-decoration: none;
            border-radius: 4px;
            font-size: 0.85rem;
            transition: background 0.3s ease;
        }

        .service-link:hover {
            background: #8B1538;
            color: white !important;
        }

        .service-link i {
            font-size: 1rem;
        }

        .contact-info {
            background: #f8f9fa;
            border-left: 4px solid #C41E3A;
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .contact-info h4 {
            color: #C41E3A;
            margin-bottom: 1rem;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
        }

        .contact-info a {
            color: #C41E3A;
            text-decoration: none;
        }

        .contact-info a:hover {
            text-decoration: underline;
        }

        .org-chart {
            background: #f8f9fa;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 1rem 0;
        }

        .org-chart img {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
        }

        .tabs-container {
            margin-top: 2rem;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .org-chart-container {
            text-align: center;
            margin: 2rem 0;
        }

        .org-level {
            margin-bottom: 3rem;
        }

        .org-position {
            display: inline-block;
            text-align: center;
            margin: 0 1rem;
        }

        .org-photo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 1rem;
            border: 3px solid #8B1538;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .org-photo.director {
            width: 120px;
            height: 120px;
            border: 4px solid #C41E3A;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .org-photo.admin {
            width: 110px;
            height: 110px;
            border: 3px solid #8B1538;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        .org-photo.placeholder {
            background: #f0f0f0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .org-photo img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .org-photo.placeholder i {
            font-size: 2.5rem;
            color: #8B1538;
        }

        /* UITC page container width and tabs overrides */
        .uitc-container {
            max-width: 1400px;
            width: 95%;
            margin: 0 auto;
        }

        .uitc-container .tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .uitc-container .tabs .tab {
            flex: 1;
            min-width: 0;
        }

        .uitc-container .tabs .tab a {
            color: #C41E3A !important;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .uitc-container .tabs .tab a.active {
            color: #ffffff !important;
            background-color: #C41E3A !important;
        }

        .uitc-container .tabs .indicator {
            background-color: #C41E3A !important;
        }

        @media (max-width: 768px) {
            .uitc-hero h1 {
                font-size: 2rem;
            }

            .uitc-section {
                padding: 1.5rem;
            }

            .service-grid {
                grid-template-columns: 1fr;
            }

            .service-links {
                flex-direction: column;
            }

            .service-link {
                justify-content: center;
            }

            .org-position {
                margin: 0 0.5rem 1rem;
            }
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="uitc-hero">
        <div class="container">
            <div class="row" style="align-items: center;">
                <div class="col s12 m8">
                    <h1>University Information Technology Center</h1>
                    <p>Empowering students, faculty, and staff with cutting-edge technology solutions, secure connectivity,
                        and innovative platforms for learning and collaboration. We are committed to creating a
                        student-friendly digital campus that supports academic success and innovation.</p>
                </div>
                <div class="col s12 m4 center-align">
                    <i class="fa-solid fa-microchip"
                        style="font-size: 6rem; color: white; opacity: 0.9; margin-bottom: 1rem;"></i>
                    <p style="margin-top: 1rem; font-size: 0.9rem; opacity: 0.8;">Digital Excellence in Education</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container uitc-container">
        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s12 m2"><a class="active" href="#core-services">Core Services</a></li>
                        <li class="tab col s12 m2"><a href="#support-helpdesk">Support</a></li>
                        <li class="tab col s12 m2"><a href="#security-policies">Security</a></li>
                        <li class="tab col s12 m2"><a href="#student-resources">Student</a></li>
                        <li class="tab col s12 m2"><a href="#faculty-resources">Faculty</a></li>
                        <li class="tab col s12 m2"><a href="#org-chart">Org Chart</a></li>
                    </ul>
                </div>
            </div>

            <!-- Core Services Tab -->
            <div id="core-services" class="tab-content active">
                <section class="uitc-section">
                    <h2>Core Technology Services</h2>
                    <p>Comprehensive technology solutions designed to support every aspect of academic and administrative
                        operations.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="fa-solid fa-user-lock red-text"></i> Accounts & Access</h4>
                            <p>Secure student and staff accounts, password management, and access control systems.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-wifi red-text"></i> Network & Wi-Fi</h4>
                            <p>High-speed campus Wi-Fi coverage, VPN services, and robust network infrastructure.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-chalkboard-user red-text"></i> Learning Management System</h4>
                            <p>Advanced LMS platform for course management, online learning, and student engagement.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-screwdriver-wrench red-text"></i> Software & Tools</h4>
                            <p>Licensed software suites, productivity applications, and development tools for all users.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-laptop red-text"></i> Hardware & Devices</h4>
                            <p>Device lending programs, computer labs, printing services, and technical support.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-comments red-text"></i> Communication Tools</h4>
                            <p>Email systems, video conferencing, collaboration platforms, and messaging services.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-info-circle"></i>
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Support & Helpdesk Tab -->
            <div id="support-helpdesk" class="tab-content">
                <section class="uitc-section">
                    <h2>Support & Helpdesk</h2>
                    <p>Professional technical support and assistance to ensure seamless technology experience.</p>

                    <div class="row">
                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-headset red-text"></i> Contact Information</h4>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <i class="fa-solid fa-envelope red-text"></i>
                                        <a href="mailto:helpdesk@tupv.edu">visayas.uitc@tup.edu.ph</a>
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-phone red-text"></i>
                                        (033) 123-4567
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-map-marker-alt red-text"></i>
                                        UITC Office
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-clock red-text"></i> Service Hours</h4>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <b>Monday - Friday:</b> 8:00 AM - 5:00 PM
                                    </li>
                                    <li class="collection-item">
                                        <b>Saturday:</b> Closed
                                    </li>
                                    <li class="collection-item">
                                        <b>Sunday:</b> Closed
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-circle-question red-text"></i> FAQs</h4>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <i class="fa-solid fa-chevron-right red-text"></i>
                                        Password reset procedures
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-chevron-right red-text"></i>
                                        Campus Wi-Fi connection guide
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-chevron-right red-text"></i>
                                        LMS access from off-campus
                                    </li>
                                </ul>
                                <div class="service-links">
                                    <a href="#" class="service-link">
                                        <i class="fa-solid fa-list"></i>
                                        View All FAQs
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Security & Policies Tab -->
            <div id="security-policies" class="tab-content">
                <section class="uitc-section">
                    <h2>Security & Policies</h2>
                    <p>Protecting our digital environment with comprehensive security measures and clear policies.</p>

                    <div class="row">
                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-shield-halved red-text"></i> Cybersecurity Awareness</h4>
                                <p>Learn about best practices for protecting your digital identity and data.</p>
                                <div class="service-links">
                                    <a href="#" class="service-link">
                                        <i class="fa-solid fa-info-circle"></i>
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-file-shield red-text"></i> IT Policies</h4>
                                <p>Access comprehensive IT policies and guidelines for technology usage.</p>
                                <div class="service-links">
                                    <a href="#" class="service-link">
                                        <i class="fa-solid fa-info-circle"></i>
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>

                        <div class="col s12 m4">
                            <div class="service-card">
                                <h4><i class="fa-solid fa-key red-text"></i> Multi-Factor Authentication</h4>
                                <p>Set up and manage MFA for enhanced account security.</p>
                                <div class="service-links">
                                    <a href="#" class="service-link">
                                        <i class="fa-solid fa-info-circle"></i>
                                        Learn More
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Student Resources Tab -->
            <div id="student-resources" class="tab-content">
                <section class="uitc-section">
                    <h2>Student Digital Resources</h2>
                    <p>Essential digital tools and resources to enhance your academic experience.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="fa-solid fa-id-card red-text"></i> Digital ID</h4>
                            <p>Access your digital student identification and campus services.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-book red-text"></i> E-Library</h4>
                            <p>Comprehensive digital library resources and research databases.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-clipboard-list red-text"></i> Online Registration</h4>
                            <p>Streamlined course registration and academic planning tools.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-envelope red-text"></i> Student Email</h4>
                            <p>Professional email services with advanced features for students.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Faculty Resources Tab -->
            <div id="faculty-resources" class="tab-content">
                <section class="uitc-section">
                    <h2>Faculty Technology Resources</h2>
                    <p>Advanced technology tools and platforms to support teaching and research.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="fa-solid fa-chalkboard-user red-text"></i> LMS Management</h4>
                            <p>Course creation, content management, and student engagement tools.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-people-group red-text"></i> Collaboration Tools</h4>
                            <p>Team collaboration platforms and project management tools.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-cloud red-text"></i> Research Storage</h4>
                            <p>Secure cloud storage solutions for academic and research data.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="fa-solid fa-chart-line red-text"></i> Analytics Dashboard</h4>
                            <p>Data analytics and reporting tools for academic performance.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="fa-solid fa-external-link-alt"></i>
                                    Access Resource
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Organizational Chart Tab -->
            <div id="org-chart" class="tab-content">
                <section class="uitc-section">
                    <h2>UITC Organizational Structure</h2>
                    <p>The University Information Technology Center organizational chart showing our team structure and key
                        personnel.</p>

                    <div class="org-chart">
                        <div class="row">
                            <div class="col s12">
                                <div class="org-chart-container">
                                    <!-- Campus Director Level -->
                                    <div class="org-level">
                                        <div class="org-position">
                                            <div class="org-photo director">
                                                <img src="{{ asset('images/Malo-oy, Eric A-2154.jpg') }}" alt="Eric Malooy">
                                            </div>
                                            <h5 style="color: #C41E3A; margin: 0.5rem 0; font-weight: 600;">Dr. Eric A.
                                                Malo-oy
                                            </h5>
                                            <p style="color: #666; margin: 0; font-size: 0.9rem; font-weight: 500;">Campus
                                                Director</p>
                                        </div>
                                    </div>

                                    <!-- Connecting Line -->
                                    <div
                                        style="width: 4px; height: 40px; background: #C41E3A; margin: 0 auto 2rem; position: relative;">
                                        <div
                                            style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); width: 200px; height: 4px; background: #C41E3A;">
                                        </div>
                                    </div>

                                    <!-- UITC Administrator Level -->
                                    <div class="org-level">
                                        <div class="org-position">
                                            <div class="org-photo admin">
                                                <img src="{{ asset('images/faciolan-chris.jpg') }}"
                                                    alt="Christopher Faciolan">
                                            </div>
                                            <h5 style="color: #8B1538; margin: 0.5rem 0; font-weight: 600;">Engr.
                                                Christopher Faciolan, PECE</h5>
                                            <p style="color: #666; margin: 0; font-size: 0.9rem; font-weight: 500;">
                                                UITC Administrator</p>
                                        </div>
                                    </div>

                                    <!-- Connecting Line -->
                                    <div
                                        style="width: 4px; height: 40px; background: #8B1538; margin: 0 auto 2rem; position: relative;">
                                        <div
                                            style="position: absolute; top: 100%; left: 50%; transform: translateX(-50%); width: 200px; height: 4px; background: #8B1538;">
                                        </div>
                                    </div>

                                    <!-- Staff Level -->
                                    <div class="org-level"
                                        style="display: flex; justify-content: center; gap: 3rem; flex-wrap: wrap;">
                                        <!-- Jofred Tupan -->
                                        <div class="org-position">
                                            <div class="org-photo placeholder">
                                                <i class="fa-solid fa-user"></i>
                                            </div>
                                            <h6 style="color: #8B1538; margin: 0.5rem 0; font-weight: 600;">Jofred Tupan
                                            </h6>
                                            <p style="color: #666; margin: 0; font-size: 0.85rem;">UITC Staff</p>
                                        </div>

                                        <!-- Ricardo Suela -->
                                        <div class="org-position">
                                            <div class="org-photo">
                                                <img src="{{ asset('images/Suela, Ricardo F Jr-2211.jpg') }}"
                                                    alt="Ricardo Suela">
                                            </div>
                                            <h6 style="color: #8B1538; margin: 0.5rem 0; font-weight: 600;">Ricardo Suela
                                            </h6>
                                            <p style="color: #666; margin: 0; font-size: 0.85rem;">UITC Staff</p>
                                        </div>

                                        <!-- Engr. Rhemjohn Dave N. Pitong -->
                                        <div class="org-position">
                                            <div class="org-photo">
                                                <img src="{{ asset('images/Pitong, Rhemjohn Dave N-2902-copy.jpg') }}"
                                                    alt="Engr. Rhemjohn Dave N. Pitong">
                                            </div>
                                            <h6 style="color: #8B1538; margin: 0.5rem 0; font-weight: 600;">Engr. Rhemjohn
                                                Dave N. Pitong</h6>
                                            <p style="color: #666; margin: 0; font-size: 0.85rem;">Electronics Engineer</p>
                                        </div>
                                    </div>

                                    <!-- Additional Info -->
                                    <div
                                        style="margin-top: 3rem; padding: 1.5rem; background: #f8f9fa; border-radius: 8px; border-left: 4px solid #C41E3A;">
                                        <h6 style="color: #C41E3A; margin-bottom: 1rem;">
                                            <i class="fa-solid fa-info-circle"></i>
                                            UITC Team Information
                                        </h6>
                                        <div class="row">
                                            <div class="col s12 m6">
                                                <p style="margin: 0.5rem 0; color: #666;">
                                                    <strong>Office Location:</strong> UITC Office
                                                </p>
                                                <p style="margin: 0.5rem 0; color: #666;">
                                                    <strong>Contact:</strong> (033) 123-4567
                                                </p>
                                            </div>
                                            <div class="col s12 m6">
                                                <p style="margin: 0.5rem 0; color: #666;">
                                                    <strong>Email:</strong> tupv.uitc@tup.edu.ph
                                                </p>
                                                <p style="margin: 0.5rem 0; color: #666;">
                                                    <strong>Service Hours:</strong> 8:00 AM - 5:00 PM
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- Quick Access Section -->
        <section class="uitc-section">
            <h2>Quick Access Links</h2>
            <div class="row">
                <div class="col s12 m6 l3">
                    <a href="https://ers.tup.edu.ph/aims/students/" class="btn-large waves-effect waves-light red"
                        style="width:100%;margin-bottom:1rem;">
                        <i class="fa-solid fa-right-to-bracket left"></i>
                        Student ERS
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="https://ers.tup.edu.ph/aims/faculty/" class="btn-large waves-effect waves-light red"
                        style="width:100%;margin-bottom:1rem;">
                        <i class="fa-solid fa-envelope left"></i>
                        Faculty ERS
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="#" class="btn-large waves-effect waves-light red" style="width:100%;margin-bottom:1rem;">
                        <i class="fa-solid fa-chalkboard-user left"></i>
                        LMS
                    </a>
                </div>
                <div class="col s12 m6 l3">
                    <a href="#" class="btn-large waves-effect waves-light red" style="width:100%;margin-bottom:1rem;">
                        <i class="fa-solid fa-headset left"></i>
                        IT Helpdesk
                    </a>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Initialize Materialize tabs
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);

            // Custom tab functionality
            const tabs = document.querySelectorAll('.tabs a');
            const tabContents = document.querySelectorAll('.tab-content');

            tabs.forEach(tab => {
                tab.addEventListener('click', function (e) {
                    e.preventDefault();

                    // Remove active class from all tabs and contents
                    tabs.forEach(t => t.classList.remove('active'));
                    tabContents.forEach(content => content.classList.remove('active'));

                    // Add active class to clicked tab
                    this.classList.add('active');

                    // Show corresponding content
                    const targetId = this.getAttribute('href').substring(1);
                    document.getElementById(targetId).classList.add('active');
                });
            });
        });
    </script>
@endsection