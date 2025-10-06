@extends('layouts.app')

@section('title', 'Assistant Director for Research and Extension - TUP Visayas')

@section('head')
    <style>
        .adre-hero {
            background: linear-gradient(135deg, #C41E3A 0%, #8B1538 100%);
            color: white;
            padding: 2.5rem 0;
            margin-bottom: 2rem;
        }

        .adre-hero h1 {
            font-size: 2.5rem;
            color: white;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .adre-hero p {
            font-size: 1.1rem;
            opacity: 0.9;
            max-width: 600px;
        }

        .adre-section {
            margin-bottom: 3rem;
            padding: 2rem;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .adre-section h2 {
            color: #C41E3A;
            font-size: 1.8rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border-bottom: 3px solid #C41E3A;
            padding-bottom: 0.5rem;
        }

        .adre-section h3 {
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

        .tabs-container {
            margin-top: 2rem;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        .adre-container {
            max-width: 1400px;
            width: 95%;
            margin: 0 auto;
        }

        .adre-container .tabs {
            display: flex;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .adre-container .tabs .tab {
            flex: 1;
            min-width: 0;
        }

        .adre-container .tabs .tab a {
            color: #C41E3A !important;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .adre-container .tabs .tab a.active {
            color: #ffffff !important;
            background-color: #C41E3A !important;
        }

        .adre-container .tabs .indicator {
            background-color: #C41E3A !important;
        }

        .tiptto-motto {
            background: linear-gradient(135deg, #C41E3A 0%, #8B1538 100%);
            color: white;
            padding: 1rem;
            border-radius: 8px;
            text-align: center;
            margin: 1rem 0;
            font-style: italic;
            font-size: 1.1rem;
        }

        @media (max-width: 768px) {
            .adre-hero h1 {
                font-size: 2rem;
            }

            .adre-section {
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
        }
    </style>
@endsection

@section('content')
    <!-- Hero Section -->
    <section class="adre-hero">
        <div class="container">
            <div class="row" style="align-items: center;">
                <div class="col s12 m8">
                    <h1>Assistant Director for Research and Extension</h1>
                    <p>Leading innovation, research excellence, and community engagement through cutting-edge research
                        initiatives, technology transfer, and extension services that drive regional development and
                        academic advancement.</p>
                </div>
                <div class="col s12 m4 center-align">
                    <i class="material-icons"
                        style="font-size: 6rem; color: white; opacity: 0.9; margin-bottom: 1rem;">science</i>
                    <p style="margin-top: 1rem; font-size: 0.9rem; opacity: 0.8;">Research Excellence & Innovation</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container adre-container">
        <!-- Tabs Navigation -->
        <div class="tabs-container">
            <div class="row">
                <div class="col s12">
                    <ul class="tabs">
                        <li class="tab col s12 m3"><a class="active" href="#tiptto">TIPTTO</a></li>
                        <li class="tab col s12 m3"><a href="#research-programs">Research Programs</a></li>
                        <li class="tab col s12 m3"><a href="#extension-services">Extension Services</a></li>
                        <li class="tab col s12 m3"><a href="#contact-info">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- TIPTTO Tab -->
            <div id="tiptto" class="tab-content active">
                <section class="adre-section">
                    <h2>TUP Visayas Intellectual Property and Technology Transfer Office</h2>
                    <div class="tiptto-motto">
                        "Taking ideas into market"
                    </div>
                    <p>Transforming innovative research into market-ready solutions through comprehensive intellectual
                        property management and technology transfer services.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="material-icons red-text">transfer_within_a_station</i> Technology Transfer</h4>
                            <ul class="collection">
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">assessment</i>
                                    Technology Assessment
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">business</i>
                                    Business Plan/Model Layout
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">verified_user</i>
                                    Technology Licensing
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">trending_up</i>
                                    Promotion of Technology for Commercialization
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">people</i>
                                    Search for Business Partners and Essential Know-how
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">monitor</i>
                                    Technology and Competitor Monitoring
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">analytics</i>
                                    Market Analysis
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">home_work</i>
                                    Technology Business Incubation
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">compare</i>
                                    Benchmarking Activities
                                </li>
                            </ul>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">copyright</i> Intellectual Property</h4>

                            <h6 class="red-text" style="margin-top: 20px;">
                                <i class="material-icons tiny">school</i> Training
                            </h6>
                            <ul class="collection">
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">foundation</i>
                                    IP Foundation
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">search</i>
                                    IP Information Search
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">edit</i>
                                    Patent Drafting
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">attach_money</i>
                                    IP Valuation
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">store</i>
                                    IP Commercialization
                                </li>
                            </ul>

                            <h6 class="red-text" style="margin-top: 20px;">
                                <i class="material-icons tiny">assignment</i> IP Application
                            </h6>
                            <ul class="collection">
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">inventory</i>
                                    Patent
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">build</i>
                                    Utility Model
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">description</i>
                                    Copyright
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">branding_watermark</i>
                                    Trademark
                                </li>
                            </ul>

                            <h6 class="red-text" style="margin-top: 20px;">
                                <i class="material-icons tiny">settings</i> Other Services
                            </h6>
                            <ul class="collection">
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">attach_money</i>
                                    IP Valuation
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">manage_accounts</i>
                                    IP Management and Other IP related Services
                                </li>
                            </ul>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Research Programs Tab -->
            <div id="research-programs" class="tab-content">
                <section class="adre-section">
                    <h2>Research Programs</h2>
                    <p>Comprehensive research initiatives that drive innovation and contribute to regional development.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="material-icons red-text">biotech</i> Biotechnology Research</h4>
                            <p>Advanced research in biotechnology applications for agriculture, healthcare, and
                                environmental sustainability.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">engineering</i> Engineering Innovation</h4>
                            <p>Cutting-edge engineering research focusing on sustainable technologies and industrial
                                applications.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">computer</i> Information Technology</h4>
                            <p>Research in emerging technologies, artificial intelligence, and digital transformation
                                solutions.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">eco</i> Environmental Studies</h4>
                            <p>Research initiatives addressing environmental challenges and sustainable development goals.
                            </p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Extension Services Tab -->
            <div id="extension-services" class="tab-content">
                <section class="adre-section">
                    <h2>Extension Services</h2>
                    <p>Community engagement and knowledge transfer programs that extend our research impact to the broader
                        community.</p>

                    <div class="service-grid">
                        <div class="service-card">
                            <h4><i class="material-icons red-text">agriculture</i> Agricultural Extension</h4>
                            <p>Technology transfer and training programs for farmers and agricultural communities.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">business</i> Entrepreneurship Development</h4>
                            <p>Supporting local entrepreneurs and small businesses through training and technology transfer.
                            </p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">school</i> Educational Outreach</h4>
                            <p>STEM education programs and workshops for schools and educational institutions.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>

                        <div class="service-card">
                            <h4><i class="material-icons red-text">health_and_safety</i> Community Health</h4>
                            <p>Health-related research and community health improvement programs.</p>
                            <div class="service-links">
                                <a href="#" class="service-link">
                                    <i class="material-icons">info</i>
                                    Learn More
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Contact Information Tab -->
            <div id="contact-info" class="tab-content">
                <section class="adre-section">
                    <h2>Contact Information</h2>
                    <p>Get in touch with the Assistant Director for Research and Extension office.</p>

                    <div class="row">
                        <div class="col s12 m6">
                            <div class="contact-info">
                                <h4><i class="material-icons red-text">location_on</i> Office Location</h4>
                                <p><strong>Assistant Director for Research and Extension</strong></p>
                                <p>TUP Visayas Campus<br>Miagao, Iloilo</p>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="contact-info">
                                <h4><i class="material-icons red-text">contact_phone</i> Contact Details</h4>
                                <p><strong>Email:</strong> <a href="mailto:adre@tupv.edu.ph">adre@tupv.edu.ph</a></p>
                                <p><strong>Phone:</strong> (033) 315-8134</p>
                                <p><strong>Office Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <!-- TIPTTO Products Blog Section -->
        <section class="adre-section">
            <h2>TIPTTO Products & Innovations</h2>
            <p>Discover the latest innovations and products developed through our technology transfer and intellectual
                property services.</p>

            @auth
                @if(auth()->user()->is_admin)
                    <div class="right-align" style="margin-bottom: 10px;">
                        <a href="{{ route('admin.tiptto_posts.create') }}" class="btn red white-text">
                            <i class="material-icons left">add</i>
                            Create New TIPTTO Post
                        </a>
                    </div>
                @endif
            @endauth

            @if($posts->count() > 0)
                <div class="row">
                    @foreach($posts as $post)
                        <div class="col s12 m6 l4">
                            <div class="card hoverable">
                                @if($post->featured_image)
                                    <div class="card-image">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}">
                                    </div>
                                @endif
                                <div class="card-content">
                                    <span class="card-title">{{ $post->title }}</span>
                                    <p>{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 150) }}</p>
                                </div>
                                <div class="card-action">
                                    <a href="{{ route('tiptto.post.show', $post->id) }}" class="red-text">
                                        Read More <i class="material-icons tiny">arrow_forward</i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="center-align" style="margin-top: 30px;">
                    {{ $posts->links() }}
                </div>
            @else
                <div class="center-align" style="padding: 40px 0;">
                    <i class="material-icons large grey-text" style="margin-bottom: 20px;">inventory_2</i>
                    <h5 class="grey-text">No products available yet</h5>
                    <p class="grey-text">Check back soon for exciting innovations and products!</p>
                </div>
            @endif
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