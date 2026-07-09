@extends('layouts.app')

@section('title', 'Assistant Director for Research and Extension - TUP Visayas')

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
                        </div>
                    </div>
                </section>
            </div>
        </div>

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
            @endif
        </section>
    </div>
@endsection

@section('scripts')
    <script>
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
