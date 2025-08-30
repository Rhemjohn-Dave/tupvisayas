@extends('layouts.app')

@section('title', 'Technology & Information Center')

@section('content')
    <div class="section">
        <!-- Cover Photo -->
        <div style="width:100%;height:260px;overflow:hidden;border-radius:12px;margin-bottom:2rem;">
            <img src="{{ asset('images/tup-logo.png') }}" alt="University Information Technology Center Cover"
                style="width:100%;height:100%;object-fit:cover;background:linear-gradient(135deg, #C41E3A 0%, #8B0000 100%);display:flex;align-items:center;justify-content:center;">
            <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center;color:white;">
                <i class="fa-solid fa-microchip" style="font-size:4rem;margin-bottom:1rem;"></i>
                <h3 style="margin:0;font-size:2rem;">University Information Technology Center</h3>
                <p style="margin:0.5rem 0 0 0;opacity:0.9;">Empowering Digital Excellence in Education</p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a class="active" href="#uitc-services">Core Services</a></li>
                    <li class="tab col s3"><a href="#uitc-support">Support & Helpdesk</a></li>
                    <li class="tab col s3"><a href="#uitc-security">Security & Policies</a></li>
                    <li class="tab col s3"><a href="#uitc-resources">Resources</a></li>
                </ul>
            </div>

            <!-- Core Services Tab -->
            <div id="uitc-services" class="col s12" style="padding-top:2rem;">
                <h5>Core Services</h5>
                <p>Comprehensive technology solutions designed to support every aspect of academic and administrative
                    operations.</p>

                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-user-lock red-text"></i>
                                    Accounts & Access
                                </span>
                                <p>Secure student and staff accounts, password management, and access control systems.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-wifi red-text"></i>
                                    Network & Wi-Fi
                                </span>
                                <p>High-speed campus Wi-Fi coverage, VPN services, and robust network infrastructure.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-chalkboard-user red-text"></i>
                                    Learning Management System
                                </span>
                                <p>Advanced LMS platform for course management, online learning, and student engagement.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-screwdriver-wrench red-text"></i>
                                    Software & Tools
                                </span>
                                <p>Licensed software suites, productivity applications, and development tools for all users.
                                </p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-laptop red-text"></i>
                                    Hardware & Devices
                                </span>
                                <p>Device lending programs, computer labs, printing services, and technical support.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-comments red-text"></i>
                                    Communication Tools
                                </span>
                                <p>Email systems, video conferencing, collaboration platforms, and messaging services.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Support & Helpdesk Tab -->
            <div id="uitc-support" class="col s12" style="padding-top:2rem;">
                <h5>Support & Helpdesk</h5>
                <p>Professional technical support and assistance to ensure seamless technology experience.</p>

                <div class="row">
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-headset red-text"></i>
                                    Contact Information
                                </span>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <i class="fa-solid fa-envelope red-text"></i>
                                        <a href="mailto:helpdesk@tupv.edu">helpdesk@tupv.edu</a>
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-phone red-text"></i>
                                        (033) 123-4567
                                    </li>
                                    <li class="collection-item">
                                        <i class="fa-solid fa-map-marker-alt red-text"></i>
                                        ICT Office, Admin Building
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-clock red-text"></i>
                                    Service Hours
                                </span>
                                <ul class="collection">
                                    <li class="collection-item">
                                        <b>Monday - Friday:</b> 8:00 AM - 5:00 PM
                                    </li>
                                    <li class="collection-item">
                                        <b>Saturday:</b> 8:00 AM - 12:00 PM
                                    </li>
                                    <li class="collection-item">
                                        <b>Sunday:</b> Closed
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-circle-question red-text"></i>
                                    Frequently Asked Questions
                                </span>
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
                                <div class="card-action">
                                    <a href="#" class="red-text">View All FAQs</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Security & Policies Tab -->
            <div id="uitc-security" class="col s12" style="padding-top:2rem;">
                <h5>Security & Policies</h5>
                <p>Protecting our digital environment with comprehensive security measures and clear policies.</p>

                <div class="row">
                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-shield-halved red-text"></i>
                                    Cybersecurity Awareness
                                </span>
                                <p>Learn about best practices for protecting your digital identity and data.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-file-shield red-text"></i>
                                    IT Policies
                                </span>
                                <p>Access comprehensive IT policies and guidelines for technology usage.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-key red-text"></i>
                                    Multi-Factor Authentication
                                </span>
                                <p>Set up and manage MFA for enhanced account security.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Learn More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Resources Tab -->
            <div id="uitc-resources" class="col s12" style="padding-top:2rem;">
                <h5>Student & Faculty Resources</h5>
                <p>Essential digital tools and resources to enhance your academic and professional experience.</p>

                <div class="row">
                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-id-card red-text"></i>
                                    Digital ID
                                </span>
                                <p>Access your digital student/faculty identification and campus services.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-book red-text"></i>
                                    E-Library
                                </span>
                                <p>Comprehensive digital library resources and research databases.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-clipboard-list red-text"></i>
                                    Online Registration
                                </span>
                                <p>Streamlined course registration and academic planning tools.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-people-group red-text"></i>
                                    Collaboration Tools
                                </span>
                                <p>Team collaboration platforms and project management tools.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-envelope red-text"></i>
                                    University Email
                                </span>
                                <p>Professional email services with advanced features.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>

                    <div class="col s12 m6 l4">
                        <div class="card">
                            <div class="card-content">
                                <span class="card-title">
                                    <i class="fa-solid fa-cloud red-text"></i>
                                    Cloud Storage
                                </span>
                                <p>Secure cloud storage solutions for academic and research data.</p>
                            </div>
                            <div class="card-action">
                                <a href="#" class="red-text">Access Resource</a>
                            </div>
                        </div>
                    </div>
                </div>

                <h5 style="margin-top:3rem;">Quick Access Links</h5>
                <div class="row">
                    <div class="col s12 m6 l3">
                        <a href="#" class="btn-large waves-effect waves-light red" style="width:100%;margin-bottom:1rem;">
                            <i class="fa-solid fa-right-to-bracket left"></i>
                            Student Portal
                        </a>
                    </div>
                    <div class="col s12 m6 l3">
                        <a href="#" class="btn-large waves-effect waves-light red" style="width:100%;margin-bottom:1rem;">
                            <i class="fa-solid fa-envelope left"></i>
                            Email
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
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var el = document.querySelectorAll('.tabs');
            M.Tabs.init(el);
        });
    </script>
@endsection