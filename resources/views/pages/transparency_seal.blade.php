@extends('layouts.app')

@section('title', 'Transparency Seal - TUP Visayas')

@section('head')
    <style>
        .transparency-hero {
            background: linear-gradient(135deg, #C41E3A 0%, #8B1538 100%);
            color: white;
            padding: 3rem 0;
            margin-bottom: 2rem;
        }

        .transparency-hero h1 {
            font-size: 2.5rem;
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .transparency-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
        }

        .transparency-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .transparency-section h2 {
            color: #C41E3A;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #C41E3A;
            padding-bottom: 0.5rem;
        }

        .transparency-section h3 {
            color: #333;
            font-size: 1.3rem;
            font-weight: 600;
            margin: 1.5rem 0 1rem 0;
        }

        .document-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 1.5rem;
            margin-top: 1rem;
        }

        .document-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 1.5rem;
            transition: all 0.3s ease;
        }

        .document-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border-color: #C41E3A;
        }

        .document-card h4 {
            color: #C41E3A;
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .document-card p {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }

        .document-links {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .document-link {
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

        .document-link:hover {
            background: #8B1538;
            color: white !important;
        }

        .document-link i {
            font-size: 1rem;
        }

        .status-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            text-transform: uppercase;
        }

        .status-compliant {
            background: #d4edda;
            color: #155724;
        }

        .status-pending {
            background: #fff3cd;
            color: #856404;
        }

        .status-updated {
            background: #cce5ff;
            color: #004085;
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

        .last-updated {
            background: #e9ecef;
            padding: 1rem;
            border-radius: 4px;
            margin-top: 1rem;
            font-size: 0.9rem;
            color: #666;
        }

        @media (max-width: 768px) {
            .transparency-hero h1 {
                font-size: 2rem;
            }

            .transparency-section {
                padding: 1.5rem;
            }

            .document-grid {
                grid-template-columns: 1fr;
            }

            .document-links {
                flex-direction: column;
            }

            .document-link {
                justify-content: center;
            }
        }

        .accessibility-features {
            background: #f0f8ff;
            border: 1px solid #b3d9ff;
            border-radius: 8px;
            padding: 1.5rem;
            margin: 2rem 0;
        }

        .accessibility-features h3 {
            color: #0066cc;
            margin-bottom: 1rem;
        }

        .accessibility-list {
            list-style: none;
            padding: 0;
        }

        .accessibility-list li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e6f3ff;
        }

        .accessibility-list li:last-child {
            border-bottom: none;
        }

        .accessibility-list li::before {
            content: "✓";
            color: #0066cc;
            font-weight: bold;
            margin-right: 0.5rem;
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="transparency-hero">
        <div class="container">
            <h1>Transparency Seal</h1>
            <p>The Technological University of the Philippines Visayas is committed to transparency and accountability in
                all its operations. This page provides access to important documents and information as required by the
                Philippine government's transparency initiatives.</p>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container">
        <!-- Agency Profile and Mandate -->
        <section class="transparency-section" id="agency-profile">
            <h2>Agency Profile and Mandate</h2>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Agency Profile</h4>
                    <p>Comprehensive information about TUP Visayas, including our history, mission, vision, and core values.
                    </p>
                    <div class="document-links">
                        <a href="{{ route('about.mission') }}" class="document-link">
                            <i class="material-icons">description</i>
                            View Profile
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Organizational Structure</h4>
                    <p>Current organizational chart showing the university's administrative structure and key personnel.</p>
                    <div class="document-links">
                        <a href="{{ route('officials') }}" class="document-link">
                            <i class="material-icons">account_tree</i>
                            View Structure
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>University Mandate</h4>
                    <p>Legal basis and authority for the establishment and operation of TUP Visayas.</p>
                    <div class="document-links">
                        <a href="{{ route('about.mandate') }}" class="document-link">
                            <i class="material-icons">gavel</i>
                            View Mandate
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Financial Documents -->
        <section class="transparency-section" id="financial-documents">
            <h2>Approved Budget and Corresponding Targets</h2>
            <h3>Budget Documents</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Annual Budget <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Fiscal Year 2024 approved budget and financial plan.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Annual Budget <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Fiscal Year 2024 approved budget and financial plan.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Budget Execution Documents <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Monthly and quarterly budget execution reports.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <h3>Financial Reports</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Statement of Allotments, Obligations and Balances <span
                            class="status-badge status-compliant">Updated</span></h4>
                    <p>Quarterly SAOB reports showing budget utilization.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Q1 2024
                        </a>
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Q2 2024
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Financial Statements <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Annual audited financial statements and reports.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            FY 2023
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Performance Documents -->
        <section class="transparency-section" id="performance-documents">
            <h2>Performance Documents</h2>

            <h3>Performance Targets and Accomplishments</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Annual Performance Report <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Comprehensive report on university performance and achievements.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Performance Commitment and Review Form <span class="status-badge status-compliant">Updated</span>
                    </h4>
                    <p>PCFR documents showing performance targets and actual accomplishments.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <h3>Programs and Projects</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Major Programs and Projects <span class="status-badge status-compliant">Updated</span></h4>
                    <p>List and status of major programs, projects, and activities.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Procurement Documents -->
        <section class="transparency-section" id="procurement-documents">
            <h2>Procurement Documents</h2>

            <h3>Annual Procurement Plan</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Annual Procurement Plan <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Comprehensive procurement plan for the current fiscal year.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>Procurement Monitoring Report <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Monthly and quarterly procurement monitoring reports.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
            </div>

            <h3>Bidding Documents</h3>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Invitation to Bid <span class="status-badge status-updated">Current</span></h4>
                    <p>Current bidding opportunities and requirements.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            View Bids
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Citizen's Charter -->
        <section class="transparency-section" id="citizens-charter">
            <h2>Citizen's Charter</h2>
            <div class="document-grid">
                <div class="document-card">
                    <h4>Citizen's Charter <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Comprehensive guide to university services, requirements, and procedures.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                        <a href="#" class="document-link">
                            <i class="material-icons">language</i>
                            View Online
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Freedom of Information -->
        <section class="transparency-section" id="freedom-of-information">
            <h2>Freedom of Information</h2>
            <div class="document-grid">
                <div class="document-card">
                    <h4>FOI Manual <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Manual on Freedom of Information implementation and procedures.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download PDF
                        </a>
                    </div>
                </div>
                <div class="document-card">
                    <h4>FOI Request Form <span class="status-badge status-compliant">Updated</span></h4>
                    <p>Standard form for submitting Freedom of Information requests.</p>
                    <div class="document-links">
                        <a href="#" class="document-link">
                            <i class="material-icons">picture_as_pdf</i>
                            Download Form
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Information -->
        <section class="transparency-section" id="contact-information">
            <h2>Contact Information</h2>
            <div class="contact-info">
                <h4>Transparency and Accountability Office</h4>
                <p><strong>Address:</strong> TUP Visayas, Talisay City, Negros Occidental</p>
                <p><strong>Email:</strong> <a href="mailto:transparency@tupv.edu.ph">transparency@tupv.edu.ph</a></p>
                <p><strong>Phone:</strong> <a href="tel:+63343412345">(034) 341-2345</a></p>
                <p><strong>Office Hours:</strong> Monday to Friday, 8:00 AM - 5:00 PM</p>
            </div>
        </section>

        <!-- Accessibility Features -->
        <section class="accessibility-features">
            <h3>Accessibility Features</h3>
            <ul class="accessibility-list">
                <li>High contrast color scheme for better visibility</li>
                <li>Semantic HTML structure for screen readers</li>
                <li>Keyboard navigation support</li>
                <li>Alt text for all images</li>
                <li>Responsive design for all device sizes</li>
                <li>Clear typography and spacing</li>
                <li>Downloadable documents in accessible formats</li>
            </ul>
        </section>

        <!-- Last Updated -->
        <div class="last-updated">
            <strong>Last Updated:</strong> {{ date('F d, Y') }} |
            <strong>Next Review:</strong> {{ date('F d, Y', strtotime('+6 months')) }}
        </div>
    </div>
@endsection