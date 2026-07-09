@extends('layouts.app')

@section('title', 'Assistant Director for Research and Extension - TUP Visayas')

<<<<<<< HEAD
@section('content')
    <div class="section site-page site-page--adre">
        <h1 class="site-page-title site-page-title--center">Assistant Director for Research and Extension</h1>
        <p class="site-page-intro">The ADRE division leads research excellence, technology transfer, and extension services that support regional development and academic growth at TUP Visayas.</p>

        <div class="uitc-tabs" data-uitc-tabs>
            <div class="uitc-tabs__nav" role="tablist" aria-label="ADRE sections">
                <button type="button" class="uitc-tabs__btn is-active" role="tab" aria-selected="true"
                    aria-controls="adre-panel-tiptto" id="adre-tab-tiptto" data-uitc-tab="adre-panel-tiptto">TIPTTO</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="adre-panel-research" id="adre-tab-research" data-uitc-tab="adre-panel-research">Research</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="adre-panel-extension" id="adre-tab-extension" data-uitc-tab="adre-panel-extension">Extension</button>
                <button type="button" class="uitc-tabs__btn" role="tab" aria-selected="false"
                    aria-controls="adre-panel-contact" id="adre-tab-contact" data-uitc-tab="adre-panel-contact">Contact</button>
            </div>

            <div id="adre-panel-tiptto" class="uitc-tabs__panel is-active" role="tabpanel" aria-labelledby="adre-tab-tiptto">
                <section class="uitc-block" aria-labelledby="adre-tiptto-heading">
                    <h2 id="adre-tiptto-heading" class="site-section-title">TUP Visayas Intellectual Property and Technology Transfer Office</h2>
                    <blockquote class="adre-motto">Empowering innovators through IP and technology transfer</blockquote>
                    <p class="uitc-block__intro">The TIPTTO serves as the university hub for protecting intellectual property, fostering innovation, and facilitating technology transfer from research to real-world application.</p>

                    <div class="uitc-grid">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">swap_horiz</i></span>
                            <h3 class="mission-card__title">Technology transfer</h3>
                            <ul class="mission-list">
                                <li>Technology assessment</li>
                                <li>Business plan and model layout</li>
                                <li>Technology licensing</li>
                                <li>Promotion of technology for commercialization</li>
                                <li>Search for business partners and essential know-how</li>
                                <li>Technology and competitor monitoring</li>
                                <li>Market analysis</li>
                                <li>Technology business incubation</li>
                                <li>Benchmarking activities</li>
                            </ul>
                        </article>

                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">copyright</i></span>
                            <h3 class="mission-card__title">Intellectual property</h3>

                            <h4 class="adre-subtitle">Training</h4>
                            <ul class="mission-list adre-list--compact">
                                <li>IP foundation course</li>
                                <li>IP information search</li>
                                <li>Patent drafting</li>
                                <li>IP valuation</li>
                                <li>Technology licensing agreement</li>
                                <li>IP commercialization</li>
                            </ul>

                            <h4 class="adre-subtitle">IP application</h4>
                            <ul class="mission-list adre-list--compact">
                                <li>Patent</li>
                                <li>Utility model</li>
                                <li>Copyright</li>
                                <li>Trademark</li>
                            </ul>

                            <h4 class="adre-subtitle">Other services</h4>
                            <ul class="mission-list adre-list--compact">
                                <li>IP policy drafting</li>
                                <li>IP management and consultation</li>
                                <li>IP pitching for investors</li>
                            </ul>
                        </article>
                    </div>
                </section>
            </div>

            <div id="adre-panel-research" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="adre-tab-research" hidden>
                <section class="uitc-block" aria-labelledby="adre-research-heading">
                    <h2 id="adre-research-heading" class="site-section-title">Research programs</h2>
                    <p class="uitc-block__intro">Research initiatives that drive innovation and contribute to regional development.</p>
                    <div class="uitc-grid uitc-grid--two">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">biotech</i></span>
                            <h3 class="mission-card__title">Biotechnology research</h3>
                            <p class="mission-card__text">Research in biotechnology applications for agriculture, healthcare, and environmental sustainability.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">precision_manufacturing</i></span>
                            <h3 class="mission-card__title">Engineering innovation</h3>
                            <p class="mission-card__text">Engineering research focused on sustainable technologies and industrial applications.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">computer</i></span>
                            <h3 class="mission-card__title">Information technology</h3>
                            <p class="mission-card__text">Research in emerging technologies, artificial intelligence, and digital transformation.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">eco</i></span>
                            <h3 class="mission-card__title">Environmental studies</h3>
                            <p class="mission-card__text">Research addressing environmental challenges and sustainable development goals.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="adre-panel-extension" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="adre-tab-extension" hidden>
                <section class="uitc-block" aria-labelledby="adre-extension-heading">
                    <h2 id="adre-extension-heading" class="site-section-title">Extension services</h2>
                    <p class="uitc-block__intro">Community engagement and knowledge transfer programs that extend research impact to the broader community.</p>
                    <div class="uitc-grid uitc-grid--two">
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">agriculture</i></span>
                            <h3 class="mission-card__title">Agricultural extension</h3>
                            <p class="mission-card__text">Technology transfer and training programs for farmers and agricultural communities.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">storefront</i></span>
                            <h3 class="mission-card__title">Entrepreneurship development</h3>
                            <p class="mission-card__text">Supporting local entrepreneurs and small businesses through training and technology transfer.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">school</i></span>
                            <h3 class="mission-card__title">Educational outreach</h3>
                            <p class="mission-card__text">STEM education programs and workshops for schools and educational institutions.</p>
                        </article>
                        <article class="mission-card uitc-service-card">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">health_and_safety</i></span>
                            <h3 class="mission-card__title">Community health</h3>
                            <p class="mission-card__text">Health-related research and community health improvement programs.</p>
                        </article>
                    </div>
                </section>
            </div>

            <div id="adre-panel-contact" class="uitc-tabs__panel" role="tabpanel" aria-labelledby="adre-tab-contact" hidden>
                <section class="uitc-block" aria-labelledby="adre-contact-heading">
                    <h2 id="adre-contact-heading" class="site-section-title">Contact information</h2>
                    <div class="uitc-support-grid uitc-support-grid--two">
                        <div class="uitc-info">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">location_on</i></span>
                            <h3 class="uitc-info__title">Office location</h3>
                            <dl class="contact-list">
                                <div class="contact-list__item">
                                    <dt>Office</dt>
                                    <dd>Assistant Director for Research and Extension, TUP Visayas, Talisay City, Negros Occidental</dd>
                                </div>
                            </dl>
                        </div>
                        <div class="uitc-info">
                            <span class="uitc-service-card__icon" aria-hidden="true"><i class="material-icons">contact_mail</i></span>
                            <h3 class="uitc-info__title">Contact details</h3>
                            <dl class="contact-list">
                                <div class="contact-list__item">
                                    <dt>Email</dt>
                                    <dd><a href="mailto:adre@tupv.edu.ph">adre@tupv.edu.ph</a></dd>
                                </div>
                                <div class="contact-list__item">
                                    <dt>Office hours</dt>
                                    <dd>Monday to Friday — 8:00 AM to 5:00 PM</dd>
                                </div>
                            </dl>
=======
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
                    <h1>Assistant Director for Research and Extension (ADRE)</h1>
                    <p>The ADRE Division spearheads innovation, research excellence, and community engagement by leading
                        initiatives in research, technology transfer and extension services that promote regional
                        development and academic growth.</p>
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
                        "Empowering Innovators through IP and Technology Transfer"
                    </div>
                    <p>The TIPTTO serves as the university's hub for protecting intellectual roperty, fostering innovation,
                        and facilitating the transfer and commercialization of technologies from research to real-world
                        application and commercialization.</p>

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
                                    IP Foundation Course
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
                                    <ul class="collection">
                                        <li class="collection-item">
                                            <i class="material-icons tiny red-text">attach_money</i>
                                            Technology Licensing Agreement
                                        </li>
                                    </ul>
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
                                    IP Policy Drafting
                                </li>
                                <li class="collection-item">
                                    <i class="material-icons tiny red-text">manage_accounts</i>
                                    IP Management and Consultation
                                    <ul class="collection">
                                        <li class="collection-item">
                                            <i class="material-icons tiny red-text">attach_money</i>
                                            IP Pitching for Investors
                                        </li>
                                    </ul>
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
                                <p>TUP Visayas Campus<br>Talisay City, Negros Occidental</p>
                            </div>
                        </div>

                        <div class="col s12 m6">
                            <div class="contact-info">
                                <h4><i class="material-icons red-text">contact_phone</i> Contact Details</h4>
                                <p><strong>Email:</strong> <a href="mailto:adre@tupv.edu.ph">adre@tupv.edu.ph</a></p>
                                <p><strong>Phone:</strong> </p>
                                <p><strong>Office Hours:</strong> Monday - Friday, 8:00 AM - 5:00 PM</p>
                            </div>
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
                        </div>
                    </div>
                </section>
            </div>
        </div>

<<<<<<< HEAD
        <section class="adre-products" aria-labelledby="adre-products-heading">
            <h2 id="adre-products-heading" class="site-section-title">TUPV technologies</h2>
            <p class="uitc-block__intro">Latest technological innovations and research outputs from TUP Visayas.</p>

            @auth
                @if (auth()->user()->is_admin)
                    <p class="adre-admin-link">
                        <a href="{{ route('admin.tiptto_posts.create') }}" class="site-cta">Create new TIPTTO post</a>
                    </p>
                @endif
            @endauth

            @if ($posts->count())
                <div class="adre-posts">
                    @foreach ($posts as $post)
                        <a class="news-item{{ $post->featured_image ? '' : ' news-item--no-media' }}"
                            href="{{ route('tiptto.post.show', $post->slug) }}">
                            @if ($post->featured_image)
                                <div class="news-item__media">
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" loading="lazy">
                                </div>
                            @endif
                            <div class="news-item__body">
                                <div class="news-item__meta">
                                    <span class="news-item__badge">TIPTTO</span>
                                    <time datetime="{{ ($post->published_at ?? $post->created_at)->toDateString() }}">{{ ($post->published_at ?? $post->created_at)->format('M j, Y') }}</time>
                                </div>
                                <h3 class="news-item__title">{{ $post->title }}</h3>
                                <p class="news-item__excerpt">{{ $post->excerpt ?: \Illuminate\Support\Str::limit(strip_tags($post->content), 160) }}</p>
                                <span class="news-item__link">Read more</span>
                            </div>
                        </a>
                    @endforeach
                </div>

                @if ($posts->hasPages())
                    <nav class="procurement-pagination" aria-label="TIPTTO posts pagination">
                        {{ $posts->links() }}
                    </nav>
                @endif
            @else
                <p class="adre-empty">No technologies are listed at this time. Please check back later.</p>
=======
        <!-- TIPTTO Products Blog Section -->
        <section class="adre-section">
            <h2>TUPV Technologies</h2>
            <p>Discover the latest technological innovations owned by TUP Visayas
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
                                    <a href="{{ route('tiptto.post.show', $post->slug) }}" class="red-text">
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
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
            @endif
        </section>
    </div>
@endsection

@section('scripts')
    <script>
<<<<<<< HEAD
        document.addEventListener('DOMContentLoaded', function() {
            var root = document.querySelector('[data-uitc-tabs]');
            if (!root) return;

            var buttons = root.querySelectorAll('[data-uitc-tab]');
            var panels = root.querySelectorAll('.uitc-tabs__panel');

            buttons.forEach(function(button) {
                button.addEventListener('click', function() {
                    activateTab(button.getAttribute('data-uitc-tab'));
                });
            });

            function activateTab(targetId) {
                var button = root.querySelector('[data-uitc-tab="' + targetId + '"]');
                if (!button) return;

                buttons.forEach(function(btn) {
                    btn.classList.remove('is-active');
                    btn.setAttribute('aria-selected', 'false');
                });

                panels.forEach(function(panel) {
                    panel.classList.remove('is-active');
                    panel.hidden = true;
                });

                button.classList.add('is-active');
                button.setAttribute('aria-selected', 'true');

                var panel = document.getElementById(targetId);
                if (panel) {
                    panel.classList.add('is-active');
                    panel.hidden = false;
                }
            }

            if (window.location.hash) {
                activateTab(window.location.hash.substring(1));
            }
        });
    </script>
@endsection
=======
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
>>>>>>> bcfd8bf21e0e5e2ff67aba160986ac94d71a47ff
