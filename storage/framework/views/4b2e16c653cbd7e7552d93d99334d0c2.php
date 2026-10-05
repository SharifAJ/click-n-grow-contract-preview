<?php if (isset($component)) { $__componentOriginal69dc84650370d1d4dc1b42d016d7226b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b = $attributes; } ?>
<?php $component = App\View\Components\GuestLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('guest-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\GuestLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['contract_var' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('contract_page')]); ?>

    <section class="contract-home-hero">
        <img class="contract-home-hero__image" src="<?php echo e(asset('images/home_banner.png')); ?>"
            alt="Farmer holding fresh herbs in a green field" fetchpriority="high">
        <div class="contract-home-hero__wash" aria-hidden="true"></div>
        <div class="contract-home-hero__content">
            <p class="contract-home-hero__eyebrow">From Farm to Future</p>
            <h1 class="contract-home-hero__title">Empowering Herbal Farming, Empowering India's Farmers</h1>
            <p class="contract-home-hero__intro">We support you at every step - from crop selection to cultivation,
                harvest, quality assessment, processing, raw material supply and beyond.</p>
            <div class="contract-home-hero__actions">
                <a class="contract-home-hero__button contract-home-hero__button--primary" href="#enquiry-form-section">
                    Register as a Farmer <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a class="contract-home-hero__button contract-home-hero__button--secondary" href="#enquiry-form-section">
                    Buy Herbal Raw Materials <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
        <p class="contract-home-hero__note" aria-label="Sustainable farming, healthier tomorrow">
            Sustainable<br>Farming.<br>Healthier<br>Tomorrow.
        </p>
        <div class="contract-home-hero__stats" aria-label="Click-N-Grow at a glance">
            <div class="contract-home-hero__stat">
                <span class="contract-home-hero__icon"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                <span><strong>500+</strong><small>Farmers</small></span>
            </div>
            <div class="contract-home-hero__stat">
                <span class="contract-home-hero__icon"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                <span><strong>1,000+</strong><small>Acres</small></span>
            </div>
            <div class="contract-home-hero__stat">
                <span class="contract-home-hero__icon"><i class="fas fa-location-dot" aria-hidden="true"></i></span>
                <span><strong>10+</strong><small>States</small></span>
            </div>
            <div class="contract-home-hero__stat">
                <span class="contract-home-hero__icon"><i class="fas fa-leaf" aria-hidden="true"></i></span>
                <span><strong>14+</strong><small>Herbal Crops</small></span>
            </div>
        </div>
    </section>

    <section class="audience-section" id="audiences" aria-labelledby="audience-heading">
        <div class="audience-section__header">
            <h2 id="audience-heading">We Serve Four Audiences</h2>
            <a href="#enquiry-form-section">Explore Our Opportunities <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>

        <div class="audience-section__grid">
            <article class="audience-card">
                <div class="audience-card__media">
                    <img src="<?php echo e(asset('images/farmer.jpg')); ?>" alt="Farmer tending crops in a green field" loading="lazy">
                    <span class="audience-card__badge"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                </div>
                <div class="audience-card__body">
                    <h3>Farmers / FPOs</h3>
                    <p>Know what you can grow, with investment, field support and buyback.</p>
                    <a href="#enquiry-form-section">Learn More <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>

            <article class="audience-card">
                <div class="audience-card__media">
                    <img src="<?php echo e(asset('images/farmer-happy.jpg')); ?>" alt="Farmer holding a crate of fresh produce" loading="lazy">
                    <span class="audience-card__badge"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></span>
                </div>
                <div class="audience-card__body">
                    <h3>Raw-Material Buyers / Herbal Companies</h3>
                    <p>Access high-quality raw materials with dependable sourcing.</p>
                    <a href="#enquiry-form-section">Enquire Now <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>

            <article class="audience-card">
                <div class="audience-card__media">
                    <img src="<?php echo e(asset('images/Buyback Support.jpeg')); ?>" alt="Hands working together to support a young plant" loading="lazy">
                    <span class="audience-card__badge"><i class="fas fa-people-group" aria-hidden="true"></i></span>
                </div>
                <div class="audience-card__body">
                    <h3>Business Associates</h3>
                    <p>Join as a working partner representing your area.</p>
                    <a href="#enquiry-form-section">Partner With Us <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>

            <article class="audience-card">
                <div class="audience-card__media">
                    <img src="<?php echo e(asset('images/CTA.jpg')); ?>" alt="Young plants growing from coins in cultivated soil" loading="lazy">
                    <span class="audience-card__badge"><i class="fas fa-chart-line" aria-hidden="true"></i></span>
                </div>
                <div class="audience-card__body">
                    <h3>Investors</h3>
                    <p>Invest in the growing herbal farming industry.</p>
                    <a href="#enquiry-form-section">Explore Investm<i class="fas fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </article>
        </div>
    </section>

    <section class="journey-section" aria-labelledby="journey-heading">
        <header class="journey-section__header">
            <h2 id="journey-heading">From Farm to Future</h2>
            <p>Our end-to-end model connects farmers to the herbal industry with complete support.</p>
        </header>

        <div class="journey-track-wrap">
            <ol class="journey-track" aria-label="Farm-to-herbal-industry process">
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/lang and soil.jpg')); ?>" alt="Cultivated field" loading="lazy">
                    <span>Crop<br>Selection</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/Quality Input Supply.jpg')); ?>" alt="Farmer tending a field" loading="lazy">
                    <span>Cultivation</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/farmer.jpg')); ?>" alt="Farmer growing herbs" loading="lazy">
                    <span>Raw Support<br>for Cultivation</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/farmer-happy.jpg')); ?>" alt="Farmer with harvested produce" loading="lazy">
                    <span>Harvest</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/Cultivation Advisory.jpg')); ?>" alt="Crop assessment in a greenhouse" loading="lazy">
                    <span>Quality<br>Assessment</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/Corporates.jpeg')); ?>" alt="Agricultural materials being assessed" loading="lazy">
                    <span>Processing /<br>Grading</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/FPOs.jpg')); ?>" alt="Farmer producer organization and its produce" loading="lazy">
                    <span>Raw Material<br>Supply</span>
                </li>
                <li class="journey-step">
                    <img src="<?php echo e(asset('images/yeild.jpg')); ?>" alt="Mature crop ready for market" loading="lazy">
                    <span>Herbal<br>Industry</span>
                </li>
            </ol>
        </div>

        <div class="journey-support">
            <h3>We also support growers with brand building and unit establishment</h3>
            <div class="journey-track-wrap">
                <ol class="journey-track journey-track--support" aria-label="Grower brand-building process">
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                        <span>Crop<br>Selection</span>
                    </li>
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-leaf" aria-hidden="true"></i></span>
                        <span>Cultivation</span>
                    </li>
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-people-group" aria-hidden="true"></i></span>
                        <span>Field Support<br>for Cultivation</span>
                    </li>
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-wheat-awn" aria-hidden="true"></i></span>
                        <span>Harvest</span>
                    </li>
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-handshake" aria-hidden="true"></i></span>
                        <span>Consultancy for<br>Brand Unit Establishment</span>
                    </li>
                    <li class="journey-step">
                        <span class="journey-step__icon"><i class="fas fa-store" aria-hidden="true"></i></span>
                        <span>Brand Building<br>for Grower</span>
                    </li>
                </ol>
            </div>
        </div>
    </section>

    <section class="why-choose-section" aria-labelledby="why-choose-heading">
        <style>
            .why-choose-section {
                padding: 26px max(4%, calc((100% - 1240px) / 2)) 30px;
                background: #ffffff;
                font-family: "Nunito Sans", sans-serif;
            }

            .why-choose-section__header {
                display: flex;
                align-items: center;
                justify-content: space-between;
                gap: 16px;
                margin: 0 0 14px;
            }

            .why-choose-section__header h2 {
                margin: 0;
                color: #1d3023;
                font-size: 22px;
                font-weight: 900;
                line-height: 1.2;
                letter-spacing: 0;
            }

            .why-choose-section__header a {
                display: inline-flex;
                flex: 0 0 auto;
                align-items: center;
                gap: 6px;
                color: #397540;
                font-size: 11px;
                font-weight: 800;
                text-decoration: none;
            }

            .why-choose-section__header a i {
                font-size: 9px;
            }

            .why-choose-section__list {
                display: grid;
                width: 100%;
                grid-template-columns: repeat(3, minmax(0, 1fr));
                gap: 10px;
                padding: 0;
                margin: 0;
            }

            .why-choose-item {
                display: flex;
                min-width: 0;
                min-height: 68px;
                align-items: center;
                gap: 10px;
                padding: 9px 10px;
                border: 1px solid #e6ebe5;
                border-radius: 7px;
                background: #ffffff;
                box-shadow: 0 2px 8px rgba(28, 55, 33, 0.035);
            }

            .why-choose-item__icon {
                display: grid;
                width: 32px;
                height: 32px;
                flex: 0 0 32px;
                place-items: center;
                border-radius: 50%;
                background: #edf4e7;
                color: #4d812f;
                font-size: 13px;
                line-height: 1;
            }

            .why-choose-item__content {
                min-width: 0;
            }

            .why-choose-item__content h3 {
                margin: 0 0 3px;
                color: #26372a;
                font-size: 12px;
                font-weight: 850;
                line-height: 1.2;
                letter-spacing: 0;
            }

            .why-choose-item__content p {
                margin: 0;
                color: #657267;
                font-size: 10px;
                line-height: 1.35;
            }

            @media (max-width: 760px) {
                .why-choose-section {
                    padding: 24px 24px 28px;
                }

                .why-choose-section__list {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                }
            }

            @media (max-width: 520px) {
                .why-choose-section {
                    padding: 22px 18px 26px;
                }

                .why-choose-section__header {
                    align-items: flex-start;
                }

                .why-choose-section__header h2 {
                    font-size: 20px;
                }

                .why-choose-section__header a {
                    gap: 4px;
                    font-size: 10px;
                }

                .why-choose-section__list {
                    grid-template-columns: 1fr;
                }

                .why-choose-item {
                    min-height: 64px;
                }
            }
        </style>
        <div class="why-choose-section__header">
            <h2 id="why-choose-heading">Why Choose Click-N-Grow</h2>
            <a href="#about-section">Learn More About Us <i class="fas fa-arrow-right" aria-hidden="true"></i></a>
        </div>

        <div class="why-choose-section__list" aria-label="Why Choose Click-N-Grow benefits">
            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-user-tie" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Expert Agronomy Support</h3>
                    <p>Guidance on crop selection, cultivation and best practices.</p>
                </div>
            </article>

            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-seedling" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Field Support for Cultivation</h3>
                    <p>On-ground support from our experts.</p>
                </div>
            </article>

            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Quality Inputs &amp; Planting Material</h3>
                    <p>Access to quality nursery and planting material.</p>
                </div>
            </article>

            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-briefcase" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Market Linkage / Buyback</h3>
                    <p>Reliable market access and buyback support.</p>
                </div>
            </article>

            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-shield-alt" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Quality &amp; Traceability</h3>
                    <p>Focus on quality, growing and full traceability.</p>
                </div>
            </article>

            <article class="why-choose-item">
                <div class="why-choose-item__icon"><i class="fas fa-globe" aria-hidden="true"></i></div>
                <div class="why-choose-item__content">
                    <h3>Pan India Operations</h3>
                    <p>Working with a network across multiple regions.</p>
                </div>
            </article>
        </div>
    </section>

    <section class="india-presence-section" aria-labelledby="india-presence-heading">
        <style>
            .india-presence-section {
                position: relative;
                isolation: isolate;
                overflow: hidden;
                background: #edf3e9;
            }

            .india-presence-section__inner {
                display: grid;
                min-height: 260px;
                grid-template-columns: minmax(0, 1fr) 270px;
                align-items: center;
                gap: clamp(32px, 5vw, 72px);
                padding: 28px max(5%, calc((100% - 1240px) / 2));
                background: linear-gradient(90deg, rgba(248, 251, 244, 0.98) 0%, rgba(248, 251, 244, 0.92) 38%, rgba(248, 251, 244, 0.32) 72%, rgba(248, 251, 244, 0.12) 100%),
                    url('<?php echo e(asset('images/sec_bg.png')); ?>') center center / cover no-repeat;
            }

            .india-presence-section__content {
                position: relative;
                z-index: 1;
                width: 100%;
                max-width: 760px;
            }

            .india-presence-section__eyebrow {
                display: flex;
                align-items: center;
                gap: 8px;
                margin: 0 0 9px;
                color: #4d7740;
                font-size: 10px;
                font-weight: 900;
                line-height: 1.2;
                text-transform: uppercase;
            }

            .india-presence-section__eyebrow::before {
                width: 18px;
                height: 2px;
                background: #75a256;
                content: "";
            }

            .india-presence-section__header {
                margin: 0 0 20px;
            }

            .india-presence-section__header h2 {
                margin: 0;
                color: #173522;
                font-size: 31px;
                font-weight: 900;
                line-height: 1.1;
                letter-spacing: 0;
            }

            .india-presence-section__description {
                max-width: 480px;
                margin: 8px 0 0;
                color: #526354;
                font-size: 14px;
                font-weight: 600;
                line-height: 1.45;
            }

            .india-presence-section__stats {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
                gap: 12px 14px;
                width: 100%;
            }

            .india-presence-stat {
                display: flex;
                min-width: 0;
                align-items: center;
                gap: 10px;
                min-height: 66px;
                padding: 10px 12px;
                border: 1px solid rgba(45, 83, 44, 0.1);
                border-radius: 8px;
                background: rgba(255, 255, 255, 0.58);
                backdrop-filter: blur(5px);
            }

            .india-presence-stat__icon {
                display: grid;
                width: 42px;
                height: 42px;
                flex: 0 0 42px;
                place-items: center;
                border-radius: 50%;
                background: rgba(255, 255, 255, 0.88);
                box-shadow: 0 5px 15px rgba(31, 62, 35, 0.11);
                color: #3f742d;
                font-size: 17px;
            }

            .india-presence-stat__value {
                display: flex;
                min-width: 0;
                flex-direction: column;
                gap: 3px;
            }

            .india-presence-stat__value strong {
                color: #1c3423;
                font-size: 23px;
                font-weight: 900;
                line-height: 1;
            }

            .india-presence-stat__value small {
                color: #536657;
                font-size: 12px;
                font-weight: 700;
                line-height: 1.25;
            }

            .india-presence-section__callout {
                position: relative;
                z-index: 1;
                display: flex;
                align-items: flex-start;
                gap: 12px;
                width: 100%;
                padding: 17px;
                border: 1px solid rgba(255, 255, 255, 0.8);
                border-radius: 8px;
                background: rgba(250, 252, 245, 0.9);
                box-shadow: 0 12px 30px rgba(28, 57, 32, 0.16);
                backdrop-filter: blur(8px);
            }

            .india-presence-section__callout-icon {
                display: grid;
                width: 38px;
                height: 38px;
                flex: 0 0 38px;
                place-items: center;
                border-radius: 50%;
                background: #e4efda;
                color: #3f742d;
                font-size: 16px;
            }

            .india-presence-section__callout-copy {
                min-width: 0;
            }

            .india-presence-section__callout-label {
                display: block;
                margin: 1px 0 5px;
                color: #4f7742;
                font-size: 10px;
                font-weight: 900;
                line-height: 1.2;
                text-transform: uppercase;
            }

            .india-presence-section__tagline {
                margin: 0;
                color: #293e2e;
                font-size: 14px;
                font-weight: 750;
                line-height: 1.4;
            }

            @media (max-width: 600px) {
                .india-presence-section__inner {
                    min-height: 0;
                    grid-template-columns: minmax(0, 1fr);
                    gap: 14px;
                    padding: 20px 16px;
                    background: linear-gradient(155deg, rgba(246, 249, 242, 0.97) 0%, rgba(241, 247, 235, 0.94) 58%, rgba(226, 239, 220, 0.9) 100%),
                        url('<?php echo e(asset('images/sec_bg.png')); ?>') 66% center / cover no-repeat;
                }

                .india-presence-section__content {
                    width: 100%;
                }

                .india-presence-section__header {
                    margin-bottom: 13px;
                }

                .india-presence-section__eyebrow {
                    margin-bottom: 6px;
                    font-size: 9px;
                }

                .india-presence-section__header h2 {
                    font-size: 22px;
                    line-height: 1.12;
                }

                .india-presence-section__description {
                    margin-top: 5px;
                    font-size: 12px;
                    line-height: 1.35;
                }

                .india-presence-section__stats {
                    width: 100%;
                    gap: 8px;
                }

                .india-presence-stat {
                    min-height: 58px;
                    gap: 8px;
                    padding: 8px;
                    border-color: rgba(45, 83, 44, 0.12);
                    border-radius: 6px;
                    background: rgba(255, 255, 255, 0.88);
                    box-shadow: 0 3px 10px rgba(31, 62, 35, 0.06);
                }

                .india-presence-stat__icon {
                    width: 32px;
                    height: 32px;
                    flex-basis: 32px;
                    font-size: 13px;
                }

                .india-presence-stat__value strong {
                    font-size: 20px;
                }

                .india-presence-stat__value small {
                    font-size: 11px;
                }

                .india-presence-section__callout {
                    max-width: none;
                    align-items: center;
                    gap: 10px;
                    padding: 12px;
                    border-color: rgba(255, 255, 255, 0.9);
                    background: rgba(255, 255, 255, 0.86);
                    box-shadow: 0 5px 14px rgba(28, 57, 32, 0.09);
                }

                .india-presence-section__callout-icon {
                    width: 32px;
                    height: 32px;
                    flex-basis: 32px;
                    font-size: 13px;
                }

                .india-presence-section__callout-label {
                    margin-bottom: 3px;
                    font-size: 9px;
                }

                .india-presence-section__tagline {
                    font-size: 12px;
                    line-height: 1.3;
                }
            }

            @media (min-width: 601px) and (max-width: 760px) {
                .india-presence-section__inner {
                    min-height: 0;
                    grid-template-columns: minmax(0, 1fr);
                    gap: 22px;
                    background: linear-gradient(180deg, rgba(248, 251, 244, 0.96) 0%, rgba(248, 251, 244, 0.88) 54%, rgba(248, 251, 244, 0.5) 100%),
                        url('<?php echo e(asset('images/sec_bg.png')); ?>') center center / cover no-repeat;
                }

                .india-presence-section__callout {
                    max-width: 420px;
                }
            }
        </style>
        <div class="india-presence-section__inner">
            <div class="india-presence-section__content">
                <div class="india-presence-section__header">
                    <p class="india-presence-section__eyebrow">A growing national network</p>
                    <h2 id="india-presence-heading">Our Presence Across India</h2>
                    <p class="india-presence-section__description">Building a strong network of herbal farmers across the country.</p>
                </div>

                <div class="india-presence-section__stats" aria-label="Company presence statistics">
                    <div class="india-presence-stat">
                        <span class="india-presence-stat__icon"><i class="fas fa-user-tie" aria-hidden="true"></i></span>
                        <div class="india-presence-stat__value">
                            <strong>500+</strong>
                            <small>Farmers</small>
                        </div>
                    </div>

                    <div class="india-presence-stat">
                        <span class="india-presence-stat__icon"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                        <div class="india-presence-stat__value">
                            <strong>1,000+</strong>
                            <small>Acres</small>
                        </div>
                    </div>

                    <div class="india-presence-stat">
                        <span class="india-presence-stat__icon"><i class="fas fa-location-dot" aria-hidden="true"></i></span>
                        <div class="india-presence-stat__value">
                            <strong>10+</strong>
                            <small>States</small>
                        </div>
                    </div>

                    <div class="india-presence-stat">
                        <span class="india-presence-stat__icon"><i class="fas fa-leaf" aria-hidden="true"></i></span>
                        <div class="india-presence-stat__value">
                            <strong>14+</strong>
                            <small>Herbal Crops</small>
                        </div>
                    </div>
                </div>
            </div>

            <aside class="india-presence-section__callout" aria-label="Expanding herbal farming opportunities across India">
                <span class="india-presence-section__callout-icon"><i class="fas fa-map-location-dot" aria-hidden="true"></i></span>
                <div class="india-presence-section__callout-copy">
                    <span class="india-presence-section__callout-label">Growing together</span>
                    <p class="india-presence-section__tagline">Expanding herbal farming opportunities across India.</p>
                </div>
            </aside>
        </div>
    </section>

    <section class="raw-material-section" aria-labelledby="raw-material-heading">
        <style>
            .raw-material-section {
                background: #fff;
                border-top: 1px solid #e9eee7;
            }

            .raw-material-section__inner {
                max-width: 1440px;
                margin: 0 auto;
                padding: 22px max(4%, calc((100% - 1320px) / 2)) 26px;
            }

            .raw-material-section__header {
                display: flex;
                align-items: flex-start;
                justify-content: space-between;
                gap: 24px;
                margin-bottom: 16px;
            }

            .raw-material-section__heading h2 {
                margin: 0;
                color: #1c3023;
                font-size: 25px;
                font-weight: 900;
                line-height: 1.15;
                letter-spacing: 0;
            }

            .raw-material-section__heading p {
                margin: 5px 0 0;
                color: #5e6b61;
                font-size: 13px;
                line-height: 1.4;
            }

            .raw-material-section__trade-link {
                display: inline-flex;
                flex: 0 0 auto;
                align-items: center;
                gap: 7px;
                margin-top: 3px;
                color: #28733c;
                font-size: 11px;
                font-weight: 850;
                text-decoration: none;
            }

            .raw-material-section__trade-link i {
                font-size: 9px;
                transition: transform .18s ease;
            }

            .raw-material-section__trade-link:hover i {
                transform: translateX(3px);
            }

            .raw-material-section__body {
                display: grid;
                grid-template-columns: minmax(0, 1fr) 250px;
                align-items: stretch;
                gap: 18px;
            }

            .raw-material-section__steps {
                display: grid;
                grid-template-columns: repeat(7, minmax(0, 1fr));
                gap: 10px;
                padding: 0;
                margin: 0;
                list-style: none;
            }

            .raw-material-step {
                min-width: 0;
                text-align: center;
            }

            .raw-material-step img {
                display: block;
                width: 100%;
                aspect-ratio: 1.45 / 1;
                border: 1px solid #e1e8df;
                border-radius: 5px;
                object-fit: cover;
            }

            .raw-material-step span {
                display: block;
                min-height: 28px;
                margin-top: 6px;
                color: #26342a;
                font-size: 10px;
                font-weight: 800;
                line-height: 1.25;
            }

            .raw-material-section__cta {
                display: flex;
                min-width: 0;
                flex-direction: column;
                align-items: flex-start;
                justify-content: center;
                padding: 17px;
                border-radius: 7px;
                background: #185b34;
                color: #fff;
            }

            .raw-material-section__cta-label {
                margin: 0 0 4px;
                color: #d6ead3;
                font-size: 10px;
                font-weight: 700;
                line-height: 1.25;
            }

            .raw-material-section__cta h3 {
                margin: 0 0 14px;
                color: #fff;
                font-size: 17px;
                font-weight: 900;
                line-height: 1.2;
                letter-spacing: 0;
            }

            .raw-material-section__button {
                display: inline-flex;
                min-height: 34px;
                align-items: center;
                justify-content: center;
                gap: 8px;
                padding: 0 12px;
                border-radius: 4px;
                background: #fff;
                color: #214c30;
                font-size: 10px;
                font-weight: 850;
                line-height: 1.2;
                text-align: center;
                text-decoration: none;
                transition: background-color .18s ease, transform .18s ease;
            }

            .raw-material-section__button:hover {
                transform: translateY(-1px);
                background: #eff6eb;
            }

            .raw-material-section__button i {
                font-size: 9px;
            }

            @media (max-width: 900px) {
                .raw-material-section__body {
                    grid-template-columns: minmax(0, 1fr);
                }

                .raw-material-section__steps {
                    grid-template-columns: repeat(4, minmax(0, 1fr));
                    row-gap: 14px;
                }

                .raw-material-section__cta {
                    display: grid;
                    grid-template-columns: minmax(0, 1fr) auto;
                    align-items: center;
                    gap: 0 18px;
                }

                .raw-material-section__cta-label,
                .raw-material-section__cta h3 {
                    grid-column: 1;
                }

                .raw-material-section__cta h3 {
                    margin-bottom: 0;
                }

                .raw-material-section__button {
                    grid-column: 2;
                    grid-row: 1 / span 2;
                }
            }

            @media (max-width: 520px) {
                .raw-material-section__inner {
                    padding: 22px 18px 24px;
                }

                .raw-material-section__header {
                    align-items: flex-start;
                    gap: 10px;
                }

                .raw-material-section__heading h2 {
                    font-size: 22px;
                }

                .raw-material-section__heading p {
                    font-size: 12px;
                }

                .raw-material-section__trade-link {
                    gap: 4px;
                    font-size: 10px;
                }

                .raw-material-section__steps {
                    grid-template-columns: repeat(2, minmax(0, 1fr));
                    gap: 12px 10px;
                }

                .raw-material-step img {
                    aspect-ratio: 1.7 / 1;
                }

                .raw-material-section__cta {
                    display: flex;
                    align-items: flex-start;
                    gap: 0;
                    padding: 16px;
                }

                .raw-material-section__cta h3 {
                    margin-bottom: 12px;
                }

                .raw-material-section__button {
                    width: 100%;
                }
            }
        </style>
        <div class="raw-material-section__inner">
            <header class="raw-material-section__header">
                <div class="raw-material-section__heading">
                    <h2 id="raw-material-heading">Raw Material Supply Capabilities</h2>
                    <p>Supplying high-quality herbal raw materials to herbal, nutraceutical and Ayurvedic industries.</p>
                </div>
                <a class="raw-material-section__trade-link" href="#enquiry-form-section">
                    Trading &amp; Export <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </header>

            <div class="raw-material-section__body">
                <ol class="raw-material-section__steps" aria-label="Raw material supply process">
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/farmer.jpg')); ?>" alt="Farmer working in a cultivated field" loading="lazy">
                        <span>Farmer<br>Network</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/unused/slider_3.jpg')); ?>" alt="Farmer checking a crop in the field" loading="lazy">
                        <span>Sourcing &amp;<br>Collection</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/Cultivation Advisory.jpg')); ?>" alt="Hands examining soil and crop quality" loading="lazy">
                        <span>Quality<br>Verification</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/Farmers-reap-beGULIVRB2.3.jpg.jpg')); ?>" alt="Herbal crop growers working together in a field" loading="lazy">
                        <span>Aggregation</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/yeild.jpg')); ?>" alt="Mature crop ready for processing and grading" loading="lazy">
                        <span>Processing /<br>Grading</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/farmer-happy.jpg')); ?>" alt="Freshly harvested produce packed for transport" loading="lazy">
                        <span>Packaging</span>
                    </li>
                    <li class="raw-material-step">
                        <img src="<?php echo e(asset('images/Quality Input Supply.jpg')); ?>" alt="Herbal crops growing across a large farm field" loading="lazy">
                        <span>Bulk Supply</span>
                    </li>
                </ol>

                <aside class="raw-material-section__cta">
                    <p class="raw-material-section__cta-label">Looking to source</p>
                    <h3>herbal raw materials?</h3>
                    <a class="raw-material-section__button" href="#enquiry-form-section">
                        Submit Bulk Purchase Enquiry <i class="fas fa-arrow-right" aria-hidden="true"></i>
                    </a>
                </aside>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <div class="mt-16 text-center" id="about-section">
        <h2 class="text-3xl font-bold text-[#3d693c] mb-4"><?php echo e(__('messages.contract_about_title')); ?></h2>
        <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
    </div>

    <div class="grid max-w-6xl grid-cols-1 gap-8 px-4 mx-auto mt-12 md:grid-cols-2">
        <div class="text-[#3d693c]">
            <h3 class="mb-4 text-2xl font-bold"><?php echo e(__('messages.contract_what_title')); ?></h3>
            <p class="mb-6 text-[#828892]">
                <?php echo e(__('messages.contract_what_desc')); ?>

            </p>
            <h3 class="mb-4 text-2xl font-bold"><?php echo e(__('messages.contract_why_title')); ?></h3>
            <p class="text-[#828892]">
                <?php echo e(__('messages.contract_why_desc')); ?>

            </p>
        </div>
        <div class="bg-[#f0fdf4] p-6 rounded-lg shadow-lg">
            <h3 class="text-2xl font-bold text-[#3d693c] mb-4"><?php echo e(__('messages.contract_who_title')); ?></h3>
            <ul class="pl-6 list-disc">
                <br>
                <li class="text-[#828892] marker:text-green-500"><?php echo e(__('messages.contract_who_item1')); ?></li>
                <br>
                <li class="text-[#828892] marker:text-green-500"><?php echo e(__('messages.contract_who_item2')); ?></li>
                <br>
                <li class="text-[#828892] marker:text-green-500"><?php echo e(__('messages.contract_who_item3')); ?></li>
                <br>
                <li class="text-[#828892] marker:text-green-500"><?php echo e(__('messages.contract_who_item4')); ?></li>
            </ul>
        </div>
    </div>

    <!-- How It Works Section -->
    <div class="bg-gray-100 ">
        <div class="mt-16 text-center">
            <br>
            <h2 class="text-3xl font-bold text-[#3d693c] mb-4"><?php echo e(__('messages.contract_how_title')); ?></h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
        </div>
        <br>

        <!-- Cards Grid -->
        <div class="grid max-w-6xl grid-cols-1 gap-6 px-4 mx-auto sm:grid-cols-2 lg:grid-cols-4">
            <?php if (isset($component)) { $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $attributes; } ?>
<?php $component = App\View\Components\ModelCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/lang and soil.jpg')).'','heading' => ''.e(__('messages.contract_step1_title')).'','paragraph' => ''.e(__('messages.contract_step1_desc')).'','step' => ' '.e(__('messages.contract_step1_label')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $attributes = $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $component = $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $attributes; } ?>
<?php $component = App\View\Components\ModelCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/Quality Input Supply.jpg')).'','heading' => ''.e(__('messages.contract_step2_title')).'','paragraph' => ''.e(__('messages.contract_step2_desc')).'','step' => ''.e(__('messages.contract_step2_label')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $attributes = $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $component = $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $attributes; } ?>
<?php $component = App\View\Components\ModelCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/Cultivation Advisory.jpg')).'','heading' => ''.e(__('messages.contract_step3_title')).'','paragraph' => ''.e(__('messages.contract_step3_desc')).'','step' => ''.e(__('messages.contract_step3_label')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $attributes = $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $component = $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6 = $attributes; } ?>
<?php $component = App\View\Components\ModelCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/Buyback Support.jpeg')).'','heading' => ''.e(__('messages.contract_step4_title')).'','paragraph' => ''.e(__('messages.contract_step4_desc')).'','step' => ''.e(__('messages.contract_step4_label')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $attributes = $__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__attributesOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6)): ?>
<?php $component = $__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6; ?>
<?php unset($__componentOriginal35c7ebd8e59f976ac24b340a2ddbb2f6); ?>
<?php endif; ?>
        </div>
    </div>



    
    <section class="py-16" x-data>
        <div class="container max-w-6xl px-4 mx-auto">
            <div class="mt-16 text-center">
                <h2 class="text-3xl font-bold text-[#3d693c] mb-4">
                    <?php echo e(__('messages.contract_crops_title')); ?>

                </h2>
                <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
                <br>
            </div>

            <!-- Crop Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                <?php $__currentLoopData = $datas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div x-data="{ showModal: false }"
                        class="bg-[#f1fdf2] w-full rounded-xl p-6 shadow-md hover:shadow-lg transition duration-300 border-l-4 border-[#264d1f] flex flex-col justify-between">

                        <!-- Card Header -->
                        <div class="flex items-center mb-2 space-x-3">
                            <?php if($data->icon): ?>
                                <span class="text-xl"><?php echo $data->icon; ?></span>
                            <?php endif; ?>
                            <h3 class="text-lg font-semibold text-[#2b501e]"><?php echo e($data->name); ?></h3>
                        </div>

                        <!-- Card Description -->
                        <p class="mb-4 text-sm text-gray-700"><?php echo e($data->description); ?></p>

                        <!-- Sowing Months -->
                        <?php if(!empty($data->sowing_months)): ?>
                            <p class="mb-4 text-xs font-semibold text-green-700">
                                Sowing Months:
                                <span class="font-normal text-gray-500 whitespace-normal">
                                    <?php
                                        $months = $data->sowing_months;
                                        if (is_string($months)) {
                                            $months = json_decode($months, true);
                                        }
                                        if (is_array($months)) {
                                            echo implode(', ', $months);
                                        } else {
                                            echo $data->sowing_months;
                                        }
                                    ?>
                                </span>
                            </p>
                        <?php endif; ?>

                        <!-- View Details Button -->
                        <button @click="showModal = true" class="text-sm font-semibold text-[#2b501e] hover:underline">
                            <?php echo e(__('messages.contract_crops_view_details')); ?>

                        </button>

                        <!-- Modal -->
                        <div x-show="showModal" x-transition.opacity
                            class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
                            style="display: none;" @click.self="showModal = false">
                            <div
                                class="bg-white rounded-xl w-full max-w-md shadow-xl relative overflow-y-auto max-h-[90vh] p-6">

                                <!-- Close Button -->
                                <button class="absolute text-2xl text-gray-500 top-2 right-3 hover:text-red-600"
                                    @click="showModal = false">&times;</button>

                                <!-- Modal Header -->
                                <div class="flex items-center mb-4 space-x-3">
                                    <?php if($data->icon): ?>
                                        <span class="text-2xl"><?php echo $data->icon; ?></span>
                                    <?php endif; ?>
                                    <h3 class="text-xl font-semibold text-green-800"><?php echo e($data->name); ?> Details</h3>
                                </div>

                                <!-- ✅ Add this code here to display images -->
                                <?php
                                    $images = json_decode($data->images) ?? [];
                                ?>

                                <?php if(!empty($images)): ?>
                                    <div class="grid grid-cols-2 gap-3 mb-4">
                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <img src="<?php echo e(asset('storage/' . $img)); ?>" alt="<?php echo e($data->name); ?>"
                                                class="object-cover w-full h-24 border border-gray-300 rounded">
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                                <!-- Modal Details -->
                                <p class="mb-4 text-sm text-gray-700"><?php echo e($data->details); ?></p>

                                <!-- PDFs -->
                                <div class="flex justify-center gap-4 mt-6">
                                    <?php if($data->pdf_en): ?>
                                        <a href="<?php echo e(asset('storage/' . $data->pdf_en)); ?>" target="_blank"
                                            class="px-5 py-2 font-semibold text-white transition bg-green-800 rounded-lg shadow hover:bg-green-900">
                                            <?php echo e(__('messages.contract_crops_pdf_en')); ?>

                                        </a>
                                    <?php endif; ?>
                                    <?php if($data->pdf_hi): ?>
                                        <a href="<?php echo e(asset('storage/' . $data->pdf_hi)); ?>" target="_blank"
                                            class="px-5 py-2 font-semibold text-white transition bg-green-800 rounded-lg shadow hover:bg-green-900">
                                            <?php echo e(__('messages.contract_crops_pdf_hi')); ?>

                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </section>

    <script src="//unpkg.com/alpinejs" defer></script>


    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>


    <!-- Who Can Partner with Us -->
    <div class="bg-gray-100">
        <div class="mt-16 text-center">
            <br>
            <h2 class="text-3xl font-bold text-[#3d693c] mb-4"> <?php echo e(__('messages.contract_who_can_partner_title')); ?>

            </h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
        </div>
        <br>

        <!-- Cards Grid -->
        <div class="grid max-w-6xl grid-cols-1 gap-6 px-4 mx-auto sm:grid-cols-2 lg:grid-cols-4">
            <?php if (isset($component)) { $__componentOriginalda21fd33773d147929ea7848d03a750a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda21fd33773d147929ea7848d03a750a = $attributes; } ?>
<?php $component = App\View\Components\ModelCard2::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard2::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/farmer.jpg')).'','heading' => ''.e(__('messages.contract_partner_farmers_title')).'','paragraph' => ''.e(__('messages.contract_partner_farmers_desc')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $attributes = $__attributesOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__attributesOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $component = $__componentOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__componentOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalda21fd33773d147929ea7848d03a750a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda21fd33773d147929ea7848d03a750a = $attributes; } ?>
<?php $component = App\View\Components\ModelCard2::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard2::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/FPOs.jpg')).'','heading' => ''.e(__('messages.contract_partner_fpos_title')).'','paragraph' => ''.e(__('messages.contract_partner_fpos_desc')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $attributes = $__attributesOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__attributesOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $component = $__componentOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__componentOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalda21fd33773d147929ea7848d03a750a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda21fd33773d147929ea7848d03a750a = $attributes; } ?>
<?php $component = App\View\Components\ModelCard2::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard2::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/NGOs.jpeg')).'','heading' => ''.e(__('messages.contract_partner_ngos_title')).'','paragraph' => ''.e(__('messages.contract_partner_ngos_desc')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $attributes = $__attributesOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__attributesOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $component = $__componentOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__componentOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>

            <?php if (isset($component)) { $__componentOriginalda21fd33773d147929ea7848d03a750a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalda21fd33773d147929ea7848d03a750a = $attributes; } ?>
<?php $component = App\View\Components\ModelCard2::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('model-card2'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ModelCard2::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['backgroundImage' => ''.e(asset('images/Corporates.jpeg')).'','heading' => ''.e(__('messages.contract_partner_corporates_title')).'','paragraph' => ''.e(__('messages.contract_partner_corporates_desc')).'']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $attributes = $__attributesOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__attributesOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalda21fd33773d147929ea7848d03a750a)): ?>
<?php $component = $__componentOriginalda21fd33773d147929ea7848d03a750a; ?>
<?php unset($__componentOriginalda21fd33773d147929ea7848d03a750a); ?>
<?php endif; ?>
        </div>

    </div>



    <!-- Why Choose Click-N-Grow? -->
    <div class="bg-white">
        <div class="mt-16 text-center">
            <br>
            <h2 class="text-3xl font-bold text-[#3d693c] mb-4"><?php echo e(__('messages.why_choose')); ?></h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
        </div>

        <section class="py-12 bg-white">
            <div class="max-w-6xl px-4 mx-auto">
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2l4-4m1.382-6.382A2.25 2.25 0 0117.25 4.5H6.75a2.25 2.25 0 01-2.132-1.882M12 2v2m6.364 1.636l-1.414 1.414M21 12h-2M3 12H1m4.636 6.364l1.414-1.414M12 22v-2m6.364-1.636l-1.414-1.414" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.exp_years')); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.exp_desc')); ?></p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7M13 16V8M9 12h6" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.agronomy_support')); ?>

                            </h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.agronomy_desc')); ?></p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <!-- Seed Icon (Farming input supply) -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 2a10 10 0 00-3.293 19.42c.508.092.707-.227.707-.505 0-.25-.01-1.082-.015-1.962-2.873.623-3.482-1.385-3.482-1.385-.463-1.178-1.13-1.492-1.13-1.492-.923-.63.07-.617.07-.617 1.02.071 1.557 1.048 1.557 1.048.908 1.555 2.384 1.106 2.965.846.092-.658.355-1.107.645-1.362-2.29-.26-4.698-1.145-4.698-5.096 0-1.125.403-2.045 1.063-2.765-.106-.26-.46-1.303.1-2.72 0 0 .864-.275 2.828 1.051A9.91 9.91 0 0112 6.844a9.912 9.912 0 012.574.346c1.964-1.326 2.826-1.051 2.826-1.051.562 1.417.208 2.46.102 2.72.662.72 1.06 1.64 1.06 2.765 0 3.96-2.41 4.832-4.705 5.085.365.313.69.928.69 1.872 0 1.35-.012 2.438-.012 2.77 0 .28.196.602.712.5A10 10 0 0012 2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.input_supply')); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.input_desc')); ?></p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 20l-5.447-2.724A2 2 0 013 15.382V5.618a2 2 0 011.553-1.946L9 2m0 0l6 3m-6-3v18m6-15l5.447 2.724A2 2 0 0121 8.618v9.764a2 2 0 01-1.553 1.946L15 22m0 0V4" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.state_ops')); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.state_ops_desc')); ?></p>
                            </p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <!-- Calendar Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3M16 7V3M4 11h16M4 19h16M4 11v8a2 2 0 002 2h12a2 2 0 002-2v-8M4 7h16a2 2 0 012 2v2H2V9a2 2 0 012-2z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.monthly_visits')); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.monthly_visits_desc')); ?></p>
                        </div>
                    </div>

                    <!-- Item -->
                    <div class="flex items-start space-x-4">
                        <div class="p-2 text-green-800 bg-green-300 rounded-full">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="font-semibold text-green-900 text-md"><?php echo e(__('messages.buyback')); ?></h4>
                            <p class="text-sm text-gray-600"><?php echo e(__('messages.buyback_desc')); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


    <!-- Success Stories -->
    <div class="bg-green-100" x-data="testimonialSlider()" x-init="initAutoScroll()">
        <div class="mt-16 text-center">
            <br>
            <h2 class="text-3xl font-bold text-[#3d693c] mb-4"><?php echo e(__('messages.success_stories')); ?></h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
        </div>
        <p class="mb-8 text-center text-gray-600"></p>

        <section class="py-12">
            <div class="max-w-6xl px-4 mx-auto">
                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <template x-for="(testimonial, index) in visibleTestimonials" :key="index">
                        <div class="p-6 transition bg-white shadow-md rounded-xl hover:shadow-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mb-4 text-gray-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 8h10M7 12h4m1 8a9 9 0 110-18 9 9 0 010 18z" />
                            </svg>
                            <p class="mb-6 italic text-gray-700" x-text="testimonial.message"></p>
                            <div class="flex items-center space-x-3">
                                <div class="flex items-center justify-center w-10 h-10 font-semibold text-white bg-green-800 rounded-full"
                                    x-text="testimonial.initials"></div>
                                <div>
                                    <p class="font-semibold text-green-800" x-text="testimonial.name"></p>
                                    <p class="text-sm text-gray-500" x-text="testimonial.location"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- More Stories link -->
                <!-- <div class="mt-8 text-center">
                    <a href="#" class="font-medium text-green-900 hover:underline">More Stories →</a>
                </div> -->
            </div>
        </section>
    </div>

    <script>
        function testimonialSlider() {
            return {
                testimonials: [{
                        name: 'Sangrambhai Devakia',
                        location: 'Vadodara, Gujarat',
                        message: 'With Click-N-Grow, I transitioned into cultivating Shatavari and Kalmegh. Their support in land preparation, crop management, and buyback gave me the confidence to scale up. It’s a reliable partnership for any farmer willing to try medicinal crops.',
                        initials: 'SD'
                    },
                    {
                        name: 'Shokin Dhakad',
                        location: 'Itarsi, Madhya Pradesh',
                        message: 'Medicinal farming was completely new to me. Click-N-Grow’s team made the onboarding easy—from soil testing to planting and market assurance. I now grow Ashwagandha, Akarkara, and Safed Musli with full confidence in their guidance.',
                        initials: 'SD'
                    },
                    {
                        name: 'Anil Neshti',
                        location: 'Bellari, Karnataka',
                        message: 'I’ve been in farming for decades, but Click-N-Grow’s approach to Yellow Shatavari and Tulsi cultivation gave me better profits with less hassle. Their training and scientific input support is top-notch.',
                        initials: 'AN'
                    },
                    {
                        name: 'Sher Singh Shekhawat',
                        location: 'Jodhpur, Rajasthan',
                        message: 'Rajasthan’s climate can be tough, but Click-N-Grow helped me identify suitable crops like Ashwagandha and Amla. Their consistent field advisory and post-harvest support made all the difference.',
                        initials: 'SS'
                    },
                    {
                        name: 'Sumit Chanda',
                        location: 'Murtizapur, Maharashtra',
                        message: 'Click-N-Grow helped me switch from conventional farming to Yellow Shatavari and Stevia. Their end-to-end guidance, from cultivation to marketing, helped me realize better income from smaller land parcels.',
                        initials: 'SC'
                    },
                    {
                        name: 'Pankaj Dharme',
                        location: 'Akot, Maharashtra',
                        message: 'Medicinal farming was a risk I wasn’t sure about—until Click-N-Grow came in with their expert team and assured buyback. Safed Musli and Pippali cultivation are now mainstays on my farm.',
                        initials: 'PD'
                    },
                    {
                        name: 'Saurabh Jayale',
                        location: 'Akot, Maharashtra',
                        message: 'Click-N-Grow’s transparent system and frequent monitoring gave me a new sense of professionalism in farming. Moringa and Safed Musli both have been high-value crops under their model.',
                        initials: 'SJ'
                    },
                    {
                        name: 'Ankit Kale',
                        location: 'Achalpur, Maharashtra',
                        message: 'I started with just 2 acres of Safed Musli, and Click-N-Grow made sure every step was well-guided. From agronomy to procurement—they handled it all responsibly.',
                        initials: 'AK'
                    },
                    {
                        name: 'Abinash Ghosh',
                        location: 'Bhadrak, Odisha',
                        message: 'Even from Odisha, I received timely virtual support, updates, and crop planning assistance. Moringa cultivation with Click-N-Grow has been a smooth and promising experience.',
                        initials: 'AG'
                    },
                    {
                        name: 'Akash Madame',
                        location: 'Yavatmal, Maharashtra',
                        message: 'I wanted to try something new on my land and chose Moringa. Thanks to Click-N-Grow’s technical advice and input support, the crop thrived, and so did my income.',
                        initials: 'AM'
                    },
                    {
                        name: 'Vineel Chandra',
                        location: 'Vangoor, Telangana',
                        message: 'I’ve tried various crops in the past, but Click-N-Grow’s structured farming model stood out. Their tailored crop plans for Akarkara, Moringa, and Yellow Shatavari helped optimize my farm’s output.',
                        initials: 'VC'
                    },
                    {
                        name: 'Vivek Agrawal',
                        location: 'Kolad, Maharashtra',
                        message: 'Shatavari farming became easy to manage once Click-N-Grow stepped in with their scientific input schedule, soil improvement recommendations, and continuous support.',
                        initials: 'VA'
                    },
                    {
                        name: 'Sriraman P.V.',
                        location: 'Thiruvannamalai, Tamil Nadu',
                        message: 'As part of our NGO’s farming initiative, we partnered with Click-N-Grow to grow Moringa, Stevia, and Kalmegh. Their community-based model and crop planning helped generate livelihood sustainably.',
                        initials: 'SP'
                    },
                    {
                        name: 'Shrikant Bhutekar',
                        location: 'Dharashiv, Maharashtra',
                        message: 'Safed Musli farming gave me better profits and less price fluctuation than traditional crops. Credit goes to Click-N-Grow for their field team’s regular visits and support.',
                        initials: 'SB'
                    },
                    {
                        name: 'Sri Ram Chandra Mission',
                        location: 'North Delhi',
                        message: 'Our community took up medicinal farming as a pilot, and Click-N-Grow supported us throughout—crop inputs, technical sessions, and marketing tie-ups. We now see this as a long-term social initiative.',
                        initials: 'SR'
                    },
                    {
                        name: 'Sumit Oza',
                        location: 'Bikaner, Rajasthan',
                        message: 'Despite the dry climate of Bikaner, the crops selected with Click-N-Grow—Ashwagandha and Kalmegh—have given encouraging results. Their agronomy and marketing support made the venture profitable.',
                        initials: 'SO'
                    }
                ],
                currentIndex: 0,
                visibleTestimonials: [],
                initAutoScroll() {
                    this.updateVisible();
                    setInterval(() => {
                        this.currentIndex = (this.currentIndex + 2) % this.testimonials.length;
                        this.updateVisible();
                    }, 5000);
                },
                updateVisible() {
                    this.visibleTestimonials = this.testimonials.slice(this.currentIndex, this.currentIndex + 2);
                    if (this.visibleTestimonials.length < 2 && this.testimonials.length > 2) {
                        this.visibleTestimonials = this.visibleTestimonials.concat(
                            this.testimonials.slice(0, 2 - this.visibleTestimonials.length)
                        );
                    }
                }
            }
        }
    </script>

    <!-- Include Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>



    <!-- YouTube Section -->
    <section class="py-16 bg-gray-100">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl font-bold text-green-900 mb-10">
                 <?php echo e(__('messages.youtube_section_title')); ?>

            </h2>

            <!-- Video Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                <!-- Video 1 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/LojMUZgCnvk"
                        title="YouTube video 1" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 2 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/gfXgCt_-aFc"
                        title="YouTube video 2" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 3 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/8Y0DLiW7ThI"
                        title="YouTube video 3" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 4 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/uv1UpkrvjCI"
                        title="YouTube video 4" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 5 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/7V608fY9RV4"
                        title="YouTube video 5" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 6 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/pWMVSiEGQwA"
                        title="YouTube video 6" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 7 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/MvwMeCjtOew"
                        title="YouTube video 7" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 8 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/Rfg_-KtoA38"
                        title="YouTube video 8" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

                <!-- Video 9 -->
                <div class="aspect-w-16 aspect-h-9">
                    <iframe class="w-full h-full rounded-xl shadow-lg" src="https://www.youtube.com/embed/hvC3aAdCpYI"
                        title="YouTube video 9" frameborder="0"
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen>
                    </iframe>
                </div>

            </div>
        </div>
    </section>



    <!-- FAQ Section -->
    <section class="py-12 bg-white" x-data="{ tab: 'general' }">
        <div class="max-w-3xl px-4 mx-auto">

            <!-- Heading -->
            <h2 class="mb-4 text-3xl font-bold text-center text-green-900"><?php echo e(__('messages.faq_heading')); ?></h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full mb-6 text-center"></div>

            <!-- Tabs -->
            <div class="flex justify-center mb-6 space-x-4 text-center">
                <button @click="tab = 'general'" :class="{ 'bg-green-600 text-white': tab === 'general' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    <?php echo e(__('messages.faq_tab_general')); ?>

                </button>
                <button @click="tab = 'government'" :class="{ 'bg-green-600 text-white': tab === 'government' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    <?php echo e(__('messages.faq_tab_government')); ?>

                </button>
                <button @click="tab = 'post'" :class="{ 'bg-green-600 text-white': tab === 'post' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    <?php echo e(__('messages.faq_tab_post')); ?>

                </button>
            </div>

            <!-- GENERAL Tab -->
            <div x-show="tab === 'general'" x-transition x-data="{
                selected: null,
                showCount: 4,
                faqs: [{
                        id: 1,
                        question: 'Who can apply for contract farming?',
                        answer: 'Any individual farmer, group of farmers, FPO (Farmer Producer Organization), CBBO (Cluster-Based Business Organization), landowner, or lease/rental land cultivator is eligible to apply under our contract farming model.'
                    },
                    {
                        id: 2,
                        question: 'What is the minimum land requirement?',
                        answer: 'Click-N-Grow Agroventures offers cultivation of 14+ medicinal and herbal crops. Based on the crop, land requirements are categorized as follows:\n\nMinimum 1 Acre: Yellow Shatavari, Stevia, Safed Musli, Pippali, Kali Haldi, Sarpagandha\nMinimum 5 Acres: Ashwagandha, Moringa, Tulsi, Kalmegh, Akarkara, Chia, Quinoa, Amla'
                    },
                    {
                        id: 3,
                        question: 'Is owning the land compulsory? Can I cultivate on leased/rented land?',
                        answer: 'No, it is not compulsory to own the land. You may carry out cultivation on leased or rented land, provided the lease tenure covers at least the full crop cycle and you have valid access to farm operations.'
                    },
                    {
                        id: 4,
                        question: 'Do you provide inputs like seeds and fertilizers?',
                        answer: 'Yes, quality planting material, organic fertilizers, and bio-pesticides are to be procured through Click-N-Grow. Growers are requested to purchase these inputs on an advance payment basis to ensure standardized crop performance and traceability.'
                    },
                    {
                        id: 5,
                        question: 'What technical support is provided during cultivation?',
                        answer: 'Our agronomy team provides stage-wise guidance on land preparation, sowing, irrigation, organic pest and disease management, harvesting schedules, and crop care best practices to ensure successful cultivation.'
                    },
                    {
                        id: 6,
                        question: 'Can I grow any crop I want?',
                        answer: 'Crop selection depends on your region, land condition, irrigation access, and market demand. Our team will help you select the most suitable crop from our portfolio for contract farming.'
                    },
                    {
                        id: 7,
                        question: 'Do I need prior experience in farming?',
                        answer: 'No prior experience is required. Our technical team supports you with training and cultivation guidance throughout the crop cycle.'
                    },
                    {
                        id: 8,
                        question: 'Will I get a fixed income?',
                        answer: 'Your income depends on proper crop care, timely input use, and harvesting standards. We offer minimum support price (MSP) agreements wherever applicable to ensure profitability.'
                    },
                    {
                        id: 9,
                        question: 'What is the duration of the contract?',
                        answer: 'The contract duration varies from 6 to 18 months depending on the crop selected and the seasonal cycle.'
                    },
                    {
                        id: 10,
                        question: 'What if my crop fails due to natural calamities?',
                        answer: 'We recommend insuring your crops under government or private schemes. We also advise using protective cultivation practices to reduce the risk of damage.'
                    },
                    {
                        id: 11,
                        question: 'Is any training provided before cultivation?',
                        answer: 'Yes, we conduct orientation sessions and ongoing training (online/offline) during the season to guide you through crop selection, cultivation, harvesting, and post-harvest handling.'
                    },
                    {
                        id: 12,
                        question: 'Do I need to hire labor for farming?',
                        answer: 'Depending on the size of land and crop, manual labor may be needed during land preparation, sowing, weeding, and harvesting. Our team helps you plan your workforce.'
                    },
                    {
                        id: 13,
                        question: 'What are my responsibilities as a contract farmer?',
                        answer: 'You are responsible for following technical protocols, maintaining input quality, keeping records, and ensuring timely harvesting and supply as per the agreement.'
                    },
                    {
                        id: 14,
                        question: 'Will I have to manage marketing or find buyers myself?',
                        answer: 'No. Under the contract, Click-N-Grow ensures buyback of the harvested produce at agreed terms and pricing.'
                    },
                    {
                        id: 15,
                        question: 'Can I exit the contract midway?',
                        answer: 'Exiting the contract prematurely is discouraged. In case of unavoidable situations, written communication and mutual agreement are required to terminate the contract.'
                    },
                    {
                        id: 16,
                        question: 'How do I apply for contract farming?',
                        answer: 'You can fill the interest form on our website or contact our field officer. We will assess your land, crop suitability, and explain the terms before signing the agreement.'
                    }
                ],
            
                visibleFaqs() {
                    return this.faqs.slice(0, this.showCount);
                },
                toggleShow() {
                    if (this.showCount >= this.faqs.length) {
                        this.showCount = 4;
                    } else {
                        this.showCount += 4;
                    }
                }
            }" class="space-y-4">

                <template x-for="faq in visibleFaqs()" :key="faq.id">
                    <div class="border rounded-lg">
                        <button
                            class="flex items-center justify-between w-full px-6 py-4 font-medium text-left text-black"
                            @click="selected !== faq.id ? selected = faq.id : selected = null">
                            <span x-text="faq.question"></span>
                            <span x-text="selected === faq.id ? '-' : '+'"></span>
                        </button>
                        <div x-show="selected === faq.id" x-collapse class="px-6 pb-4 text-gray-700">
                            <span x-text="faq.answer"></span>
                        </div>
                    </div>
                </template>

                <div class="mt-6 text-center" x-show="faqs.length > 4">
                    <button @click="toggleShow()" class="font-medium text-green-700 hover:underline">
                        <span x-text="showCount >= faqs.length ? 'View Less FAQs' : 'View More FAQs →'"></span>
                    </button>
                </div>
            </div>

            <!-- GOVERNMENT Tab -->
            <div x-show="tab === 'government'" x-transition x-data="{
                selected: null,
                showCount: 4,
                faqs: [{
                        id: 1,
                        question: 'Is any government subsidy available?',
                        answer: `Yes, several government subsidies are available through the National Medicinal Plants Board (NMPB) and related AYUSH schemes. Here’s a clear breakdown:
                                                                                                                                🌱 1. Cultivation Subsidies (NAM/NMPB) 
                                                                                                                                India is one of the richest countries in the world in terms of biodiversity, with 15 agro-climatic zones. Out of the 17,000–18,000 species of flowering plants, more than 7,000 are estimated to have medicinal usage in folk and documented systems of medicine like Ayurveda, Unani, Siddha, and Homoeopathy (AYUSH System of Medicine).
                                                                                                                                Medicinal plants are not only a major resource base for the traditional medicine and herbal industry but also provide livelihood and health security to a large segment of the Indian population. About 1,178 species of medicinal plants are estimated to be in trade, of which 242 species have annual consumption levels in excess of 100 metric tons per year.
                                                                                                                                The domestic demand for medicinal plants was estimated at 1,95,000 metric tons for 2014–2015, and export demand was estimated at 1,34,500 metric tons during the same period. Total consumption of herbal raw drugs in the country for 2014–15 was estimated at 5,12,000 metric tons with a trade value of ₹5,500 crore. Export value increased from ₹345.80 crore in 2005–06 to ₹3,211 crore in 2014–15, a nine-fold increase over a decade.`
                    },
                    {
                        id: 2,
                        question: 'What is the National Medicinal Plants Board (NMPB)?',
                        answer: `The Government of India set up the National Medicinal Plants Board (NMPB) on 24th November 2000. Currently, the board works under the Ministry of AYUSH (Ayurveda, Yoga & Naturopathy, Unani, Siddha & Homoeopathy), Government of India. The primary mandate of the NMPB is to develop mechanisms for coordination between ministries/departments/organizations and implement support policies and programs for the overall growth (conservation, cultivation, trade, and export) of the medicinal plants sector at the Central, State, and International levels.`
                    },
                    {
                        id: 3,
                        question: 'What are the aims and objectives of NMPB?',
                        answer: `In recent years, the cultivation of medicinal plants has gained momentum. However, a significant part of demand is still met from wild sources. To meet this increasing demand, the NMPB focuses on:
                                                                                                                                • In-situ and ex-situ conservation
                                                                                                                                • Augmenting local medicinal plants and aromatic species
                                                                                                                                • Promoting research and development
                                                                                                                                • Capacity building through training
                                                                                                                                • Creating awareness through promotional activities like Home/School herbal gardens
                                                                                                                                • Supporting quality assurance and standardization
                                                                                                                                • Developing Good Agricultural and Collection Practices (GACPs)
                                                                                                                                • Developing monographs and agro-techniques
                                                                                                                                • Supporting certification of quality of raw drugs, seeds, and planting materials
                                                                                                                                The ultimate goal is to promote the medicinal plants sector by coordinating with different ministries/departments for implementation of policies/programs.`
                    },
                    {
                        id: 4,
                        question: 'What kind of subsidies are offered under the National AYUSH Mission (NAM)?',
                        answer: `Under NAM, subsidies are offered for growing 140 prioritized medicinal plants on farmer lands:
                                                                                                                                • 75% subsidy for CITES-listed or endangered plants
                                                                                                                                • 50% subsidy for critically declining species or those with long gestation periods
                                                                                                                                • 20% subsidy for other supported plants
                                                                                                                                These are cluster-based schemes with support for quality seeds, nursery development, post-harvest management, processing, and marketing.`
                    },
                    {
                        id: 5,
                        question: 'What is the Central Sector Scheme for Conservation and Management?',
                        answer: `This centrally funded NMPB scheme supports various interventions:
                                                                                                                                • Nurseries & Quality Planting Material (QPM): 50% subsidy (up to ₹10 lakhs per unit for private nurseries)
                                                                                                                                • Cultivation: 20%, 50%, or 75% subsidy depending on species, applied in clusters of ≥2 ha with ≥5 farmers
                                                                                                                                • Infrastructure (drying sheds, storage):
                                                                                                                                - 100% subsidy (up to ₹10 lakhs) for SHGs/cooperatives
                                                                                                                                - 50% subsidy for individual growers
                                                                                                                                • Processing & Value Addition Units: 25% subsidy, maximum ₹50 lakhs
                                                                                                                                • Testing Labs: 30% subsidy, maximum ₹30 lakhs
                                                                                                                                • Market Support: 50% subsidy, up to ₹10 lakhs for promotion, mandis, etc.
                                                                                                                                • Insurance & Quality Certification: 50% subsidy up to ₹5 lakhs for certification and 50% of crop insurance premiums`
                    },
                    {
                        id: 6,
                        question: 'What is the Regional Cum Facilitation Centre (RCFC) – Maharashtra Region?',
                        answer: `The NMPB has established an RCFC at Savitribai Phule Pune University. It covers Maharashtra, Gujarat, Goa, Rajasthan, and D&NH & D&DIA. These centers assist farmers with:
                                                                                                                                • Technical guidance
                                                                                                                                • Distribution of quality planting materials
                                                                                                                                • Project facilitation and documentation
                                                                                                                                • Coordination with regional/state officers for implementation`
                    },
                    {
                        id: 7,
                        question: 'How can I avail these subsidies?',
                        answer: `To benefit from these schemes:
                                                                                                                                1. Identify your project type: cultivation, nurseries, drying/storage, processing, labs, marketing, certification.
                                                                                                                                2. Form or join a cluster (e.g., SHG, cooperative, producer company).
                                                                                                                                3. Connect with your state’s Medicinal Plants Board or RCFC Pune: they guide application, planning, and submission to NMPB.
                                                                                                                                4. Prepare project proposals following operational guidelines.
                                                                                                                                5. Submit proposals via appropriate nodal agencies (State Horticulture Mission/Medicinal Plants Board).
                                                                                                                                6. Post-approval, funds are released in installments based on milestones and verification.`
                    },
                    {
                        id: 8,
                        question: 'Quick Summary Table',
                        answer: `Scheme / Component | Subsidy Rate | Max Support
                                                                                                                                    --- | --- | ---
                                                                                                                                    Cultivation (NAM/NMPB) | 20%, 50%, 75% | Cluster-based
                                                                                                                                    Nursery/QPM development | 50% | ₹10 lakhs/unit
                                                                                                                                    Drying sheds/storage | 100% (SHG), 50% (Ind.) | ₹10 lakhs
                                                                                                                                    Processing units (value addition) | 25% | ₹50 lakhs
                                                                                                                                    Testing labs | 30% | ₹30 lakhs
                                                                                                                                    Market Promotion & Infrastructure | 50% | ₹10 lakhs
                                                                                                                                    Certification & Insurance | 50% | ₹5 lakhs (cert), 50% crop premium`
                    }
                ],
            
                visibleFaqs() {
                    return this.faqs.slice(0, this.showCount);
                },
                toggleShow() {
                    if (this.showCount >= this.faqs.length) {
                        this.showCount = 4;
                    } else {
                        this.showCount += 4;
                    }
                }
            }" class="space-y-4">

                <template x-for="faq in visibleFaqs()" :key="faq.id">
                    <div class="border rounded-lg">
                        <button
                            class="flex items-center justify-between w-full px-6 py-4 font-medium text-left text-black"
                            @click="selected !== faq.id ? selected = faq.id : selected = null">
                            <span x-text="faq.question"></span>
                            <span x-text="selected === faq.id ? '-' : '+'"></span>
                        </button>
                        <div x-show="selected === faq.id" x-collapse class="px-6 pb-4 text-gray-700">
                            <span x-text="faq.answer"></span>
                        </div>
                    </div>
                </template>

                <!-- Show More only if > 4 -->
                <div class="mt-6 text-center" x-show="faqs.length > 4">
                    <button @click="toggleShow()" class="font-medium text-green-700 hover:underline">
                        <span x-text="showCount >= faqs.length ? 'View Less FAQs' : 'View More FAQs →'"></span>
                    </button>
                </div>
            </div>

            <!-- POST Tab -->
            <div x-show="tab === 'post'" x-transition x-data="{
                selected: null,
                showCount: 4,
                faqs: [{
                        id: 1,
                        question: 'Do you support export of medicinal / herbal commodities?',
                        answer: 'Yes, we support the export of medicinal and herbal commodities. We collaborate with exporters, processors, and bulk buyers to create reliable supply chains. Our role includes linking contract growers to export opportunities and ensuring quality compliance as per market demand.'
                    },
                    {
                        id: 2,
                        question: 'Who arranges transportation of plants and harvested produce?',
                        answer: 'It is the grower\'s responsibility to bear the transportation cost of planting materials (such as seeds and fertilizers) as well as the harvested produce. However, in cases where the total area under contract farming exceeds 50 acres, combining multiple growers, the buyer may take responsibility for transportation logistics.'
                    },
                    {
                        id: 3,
                        question: 'Is processing or drying required?',
                        answer: 'Yes, processing or drying is essential for all medicinal crops to maintain their quality and market value. We provide complete guidance on drying, cleaning, grading, and packaging as per industry standards.'
                    },
                    {
                        id: 4,
                        question: 'Do you help with value addition or branding?',
                        answer: `Yes, absolutely! At Click-N-Grow Agroventures, we don’t just stop at cultivation—we believe in empowering our partners through end-to-end value chain integration. Here's how we support:
                                                                                                
                                                                                                                                🌿 1. Value Chain Integration
                                                                                                                                We work closely with our partners to integrate various stages of the supply chain:
                                                                                                                                • Post-harvest handling – Proper drying, grading, and sorting of medicinal crops.
                                                                                                                                • Primary processing – Pulverizing, extracting, or converting raw herbs into semi-processed products.
                                                                                                                                • Logistics & warehousing – Ensuring safe storage and timely movement from farm to factory or market.
                                                                                                
                                                                                                                                🏭 2. Bulk Processing & Custom Formulations
                                                                                                                                We facilitate bulk processing through our own or partner facilities:
                                                                                                                                • Drying, grinding, or oil extraction as per industry standards.
                                                                                                                                • Custom formulations for nutraceuticals, herbal teas, supplements, cosmetics, etc.
                                                                                                
                                                                                                                                🛍️ 3. Branding & Private Label Support
                                                                                                                                If you're looking to launch your own brand, we can support with:
                                                                                                                                • Brand identity development – Logo, packaging, labeling, and brand messaging.
                                                                                                                                • Regulatory assistance – Support in obtaining FSSAI, Ayush, or organic certifications.
                                                                                                                                • Product development – Herbal products, oils, powders, capsules, or ready-to-sell goods.
                                                                                                
                                                                                                                                📦 4. B2B & Institutional Marketing
                                                                                                                                We connect growers, processors, and buyers through a dedicated B2B marketing channel:
                                                                                                                                • Introducing products to exporters, bulk buyers, wellness brands, and retail chains.
                                                                                                                                • Participation in trade fairs, exhibitions, and digital marketplaces under our umbrella.`
                    }
                ],
            
                visibleFaqs() {
                    return this.faqs.slice(0, this.showCount);
                },
                toggleShow() {
                    if (this.showCount >= this.faqs.length) {
                        this.showCount = 4;
                    } else {
                        this.showCount += 4;
                    }
                }
            }" class="space-y-4">

                <template x-for="faq in visibleFaqs()" :key="faq.id">
                    <div class="border rounded-lg">
                        <button
                            class="flex items-center justify-between w-full px-6 py-4 font-medium text-left text-black"
                            @click="selected !== faq.id ? selected = faq.id : selected = null">
                            <span x-text="faq.question"></span>
                            <span x-text="selected === faq.id ? '-' : '+'"></span>
                        </button>
                        <div x-show="selected === faq.id" x-collapse class="px-6 pb-4 text-gray-700">
                            <span x-text="faq.answer"></span>
                        </div>
                    </div>
                </template>

                <div class="mt-6 text-center" x-show="faqs.length > 4">
                    <button @click="toggleShow()" class="font-medium text-green-700 hover:underline">
                        <span x-text="showCount >= faqs.length ? 'View Less FAQs' : 'View More FAQs →'"></span>
                    </button>
                </div>
            </div>

        </div>
    </section>



    <!-- Footer Section with Background + Tabs + Contact Info -->
    <section class="relative py-16 text-green-900" x-data="{ activeTab: 'associate' }">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-center bg-cover blur-sm "
            style="background-image: url('<?php echo e(asset('images/hero_placeholder_img2.webp')); ?>');">
        </div>

        <!-- Overlay -->
        

        <!-- Heading (FULL WIDTH, no box) -->
        <div id="enquiry-form-section" class="relative px-6 py-10 text-center">
            
            

            <h1 class="mb-8 text-3xl font-bold text-center text-green-800 md:text-4xl">
                <?php echo e(__('messages.enquiry_form_title')); ?>

            </h1>
            <p class="mb-6 text-center text-gray-600">
                 <?php echo e(__('messages.enquiry_form_desc')); ?>

            </p>
        </div>

        <!-- Tabs (kept boxed) -->
        <div class="relative max-w-6xl mx-auto overflow-hidden rounded-lg shadow-lg">
            <!-- Tabs -->
            <div class="flex justify-center border-b bg-white/80">
                <button class="px-6 py-3 font-semibold"
                    :class="activeTab === 'associate' ? 'text-green-800 border-b-4 border-green-700' :
                        'text-gray-600 hover:text-green-800'"
                    @click="activeTab = 'associate'">
                    <?php echo e(__('messages.business_associate_tab')); ?>

                </button>
                <button class="px-6 py-3 font-semibold"
                    :class="activeTab === 'farmer' ? 'text-green-800 border-b-4 border-green-700' :
                        'text-gray-600 hover:text-green-800'"
                    @click="activeTab = 'farmer'">
                    <?php echo e(__('messages.individual_farmer_tab')); ?>

                </button>
                <button class="px-6 py-3 font-semibold"
                    :class="activeTab === 'fpo' ? 'text-green-800 border-b-4 border-green-700' :
                        'text-gray-600 hover:text-green-800'"
                    @click="activeTab = 'fpo'">
                    <?php echo e(__('messages.fpo_farmer_group_tab')); ?>

                </button>
            </div>

            <!-- Forms -->
            <div class="bg-white">
                <!-- Business Associate Form -->
                <div class="p-8" x-show="activeTab === 'associate'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800"><?php echo e(__('messages.business_associate_title')); ?>

                    </h2>
                    <p class="mb-6 text-center text-gray-600"><?php echo e(__('messages.business_associate_desc')); ?></p>

                    <form action="<?php echo e(route('enquiry.business.store')); ?>" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        <?php echo csrf_field(); ?>
                        <!-- Full Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.full_name')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.company_name')); ?></label>
                            <input type="text" name="company_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.mobile_number')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.email')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State & District -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.state_district')); ?><span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="state_district" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.experience')); ?></label>
                            <input type="number" name="experience" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Area You Wish to Operate In -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.operating_area')); ?></label>
                            <input type="text" name="operating_area"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Type of Network -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.network_type')); ?></label>
                            <input type="text" name="network_type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Why do you want to work -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.reason')); ?></label>
                            <textarea name="reason" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Upload Resume -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> <?php echo e(__('messages.resume')); ?></label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx"
                                class="w-full text-gray-700">
                        </div>

                        <!-- Preferred Mode of Contact -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> <?php echo e(__('messages.preferred_contact')); ?></label>
                            <select name="preferred_contact"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="call"><?php echo e(__('messages.call')); ?></option>
                                <option value="whatsapp"><?php echo e(__('messages.whatsapp')); ?></option>
                                <option value="email"><?php echo e(__('messages.email')); ?></option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                 <?php echo e(__('messages.submit_button')); ?>

                            </button>
                        </div>
                    </form>
                </div>


                <!-- Farmer Form -->
                <div class="p-8" x-show="activeTab === 'farmer'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800"> <?php echo e(__('messages.individual_farmer_title')); ?>

                    </h2>
                    <p class="mb-6 text-center text-gray-600"> <?php echo e(__('messages.individual_farmer_desc')); ?></p>

                    <form action="<?php echo e(route('enquiry.farmer.store')); ?>" method="POST" class="space-y-4">
                        <?php echo csrf_field(); ?>

                        <!-- Full Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> <?php echo e(__('messages.full_name')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.mobile_number')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.email')); ?></label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State & District -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> <?php echo e(__('messages.state_district')); ?><span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="state_district" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Village/Town Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.village_town_name')); ?> <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="village" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Total Land Available -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.total_land_available')); ?><span class="text-red-500">*</span></label>
                            <input type="number" name="land_area" min="0" step="0.01" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Irrigation Availability -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.irrigation_availability')); ?> <span
                                    class="text-red-500">*</span></label>
                            <select name="irrigation" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value=""><?php echo e(__('messages.select')); ?></option>
                                <option value="yes"><?php echo e(__('messages.yes')); ?></option>
                                <option value="no"><?php echo e(__('messages.no')); ?></option>
                            </select>
                        </div>

                        <!-- Type of Land -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.type_of_land')); ?><span
                                    class="text-red-500">*</span></label>
                            <select name="land_type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value=""><?php echo e(__('messages.select')); ?></option>
                                <option value="owned"><?php echo e(__('messages.owned')); ?></option>
                                <option value="leased"><?php echo e(__('messages.leased')); ?></option>
                            </select>
                        </div>

                        <!-- Crops Cultivated Previously -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.crops_cultivated_previously')); ?></label>
                            <input type="text" name="previous_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Interested Crops -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.interested_crop')); ?></label>
                            <select name="interested_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value=""><?php echo e(__('messages.select_crop')); ?></option>
                                <option value="akarkara"><?php echo e(__('messages.akarkara')); ?></option>
                                <option value="amla"><?php echo e(__('messages.amla')); ?></option>
                                <option value="ashwagandha"><?php echo e(__('messages.ashwagandha')); ?></option>
                                <option value="black_turmeric"><?php echo e(__('messages.black_turmeric')); ?></option>
                                <option value="chia_seeds"><?php echo e(__('messages.chia_seeds')); ?></option>
                                <option value="kalmegh"><?php echo e(__('messages.kalmegh')); ?></option>
                                <option value="moringa"><?php echo e(__('messages.moringa')); ?></option>
                                <option value="pippli"><?php echo e(__('messages.pippli')); ?></option>
                                <option value="quinoa"><?php echo e(__('messages.quinoa')); ?></option>
                                <option value="safed_musli"><?php echo e(__('messages.safed_musli')); ?></option>
                                <option value="sarpagandha"><?php echo e(__('messages.sarpagandha')); ?></option>
                                <option value="stevia"><?php echo e(__('messages.stevia')); ?></option>
                                <option value="tulsi"><?php echo e(__('messages.tulsi')); ?></option>
                                <option value="yellow_shatavari"><?php echo e(__('messages.yellow_shatavari')); ?></option>
                                <!-- Add more crops as needed -->
                            </select>
                        </div>


                        <!-- Planned Start Month -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.planned_start_month')); ?></label>
                            <select name="start_month"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value=""><?php echo e(__('messages.select_month')); ?></option>
                                <option value="january"><?php echo e(__('messages.january')); ?></option>
                                <option value="february"><?php echo e(__('messages.february')); ?></option>
                                <option value="march"><?php echo e(__('messages.march')); ?></option>
                                <option value="april"><?php echo e(__('messages.april')); ?></option>
                                <option value="may"><?php echo e(__('messages.may')); ?></option>
                                <option value="june"><?php echo e(__('messages.june')); ?></option>
                                <option value="july"><?php echo e(__('messages.july')); ?></option>
                                <option value="august"><?php echo e(__('messages.august')); ?></option>
                                <option value="september"><?php echo e(__('messages.september')); ?></option>
                                <option value="october"><?php echo e(__('messages.october')); ?></option>
                                <option value="november"><?php echo e(__('messages.november')); ?></option>
                                <option value="december"><?php echo e(__('messages.december')); ?></option>
                            </select>
                        </div>

                        <!-- Preferred Support Required -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> <?php echo e(__('messages.preferred_support_required')); ?></label>
                            <div class="flex flex-col space-y-2">
                                <label><input type="checkbox" name="support[]" value="technical_guidance"
                                        class="mr-2"> <?php echo e(__('messages.technical_guidance')); ?></label>
                                <label><input type="checkbox" name="support[]" value="input_supply" class="mr-2">
                                    <?php echo e(__('messages.input_supply')); ?></label>
                                <label><input type="checkbox" name="support[]" value="buyback_contract"
                                        class="mr-2"><?php echo e(__('messages.buyback_contract')); ?></label>
                                <label><input type="checkbox" name="support[]" value="training" class="mr-2">
                                    <?php echo e(__('messages.training')); ?></label>
                            </div>
                        </div>

                        <!-- Additional Comments -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.additional_comments')); ?></label>
                            <textarea name="additional_comments" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                <?php echo e(__('messages.submit_farmer_enquiry')); ?>

                            </button>
                        </div>
                    </form>
                </div>


                <!-- FPO Form -->
                <!-- FPO / Farmer Group Form -->
                <div class="p-8" x-show="activeTab === 'fpo'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800">
                        <?php echo e(__('messages.fpo_farmer_group_title')); ?>

                    </h2>
                    <p class="mb-6 text-center text-gray-600">
                        <?php echo e(__('messages.fpo_farmer_group_desc')); ?>

                    </p>

                    <form action="<?php echo e(route('enquiry.fpo.store')); ?>" method="POST" enctype="multipart/form-data" class="space-y-4">
                        <?php echo csrf_field(); ?>

                        <!-- FPO / Group Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.fpo_group_name')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="group_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Registration Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.registration_number')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="registration_number" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Contact Person Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.contact_person_name')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="contact_person" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.mobile_number')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.email')); ?></label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State, District & Taluka -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.state_district_taluka')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="state_district_taluka" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Number of Farmers -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.number_of_farmers')); ?> <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="number_of_farmers" min="1" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Total Land Available -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                <?php echo e(__('messages.total_land_available')); ?> (<?php echo e(__('messages.combined')); ?>) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="total_land" min="0" step="0.01" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Type of Crops Currently Grown -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.current_crops')); ?></label>
                            <input type="text" name="current_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Interested Crops -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.interested_crop')); ?></label>
                            <select name="interested_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value=""><?php echo e(__('messages.select_crop')); ?></option>
                                <option value="akarkara"><?php echo e(__('messages.akarkara')); ?></option>
                                <option value="amla"><?php echo e(__('messages.amla')); ?></option>
                                <option value="ashwagandha"><?php echo e(__('messages.ashwagandha')); ?></option>
                                <option value="black_turmeric"><?php echo e(__('messages.black_turmeric')); ?></option>
                                <option value="chia_seeds"><?php echo e(__('messages.chia_seeds')); ?></option>
                                <option value="kalmegh"><?php echo e(__('messages.kalmegh')); ?></option>
                                <option value="moringa"><?php echo e(__('messages.moringa')); ?></option>
                                <option value="pippli"><?php echo e(__('messages.pippli')); ?></option>
                                <option value="quinoa"><?php echo e(__('messages.quinoa')); ?></option>
                                <option value="safed_musli"><?php echo e(__('messages.safed_musli')); ?></option>
                                <option value="sarpagandha"><?php echo e(__('messages.sarpagandha')); ?></option>
                                <option value="stevia"><?php echo e(__('messages.stevia')); ?></option>
                                <option value="tulsi"><?php echo e(__('messages.tulsi')); ?></option>
                                <option value="yellow_shatavari"><?php echo e(__('messages.yellow_shatavari')); ?></option>
                                <!-- Add more crops as needed -->
                            </select>
                        </div>

                        <!-- Expected Start Time -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.expected_start_time')); ?></label>
                            <input type="text" name="expected_start"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Support Required -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.support_required')); ?></label>
                            <div class="flex flex-col space-y-2">
                                <label><input type="checkbox" name="support[]" value="technical_guidance" class="mr-2"> <?php echo e(__('messages.technical_guidance')); ?></label>
                                <label><input type="checkbox" name="support[]" value="bulk_input_supply" class="mr-2"> <?php echo e(__('messages.bulk_input_supply')); ?></label>
                                <label><input type="checkbox" name="support[]" value="buyback_contract" class="mr-2"> <?php echo e(__('messages.buyback_contract')); ?></label>
                                <label><input type="checkbox" name="support[]" value="on_site_visit" class="mr-2"> <?php echo e(__('messages.on_site_visit')); ?></label>
                            </div>
                        </div>

                        <!-- Upload Group Profile -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.upload_group_profile')); ?></label>
                            <input type="file" name="group_profile" accept=".pdf,.doc,.docx" class="w-full text-gray-700">
                        </div>

                        <!-- Remarks -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"><?php echo e(__('messages.remarks')); ?></label>
                            <textarea name="remarks" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                <?php echo e(__('messages.submit_fpo_enquiry')); ?>

                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        
        <footer>
            <div class="relative px-8 py-16 mt-12 text-white bg-black/60">
                <div class="mx-auto grid grid-cols-1 md:grid-cols-3 gap-6 items-start">

                    <!-- Left: Logo -->
                    <div class="grid grid-cols-1 md:grid-cols-1 ml-12 px-6">
                        <!-- Logo Section -->
                        <div class="mb-6">
                            <img src="<?php echo e(asset('images/Click N Grow Final Logo.jpg')); ?>" alt="Logo" class="h-40 shadow-lg rounded-2xl">
                        </div>

                        <!-- Our Websites Section -->
                        <h4 class="mb-2 text-lg font-semibold"><?php echo e(__('messages.footer_websites')); ?></h4>
                        <ul class="space-y-1 text-gray-200">
                            <li>
                                <a href="http://www.ekisanzone.com" target="_blank" class="transition duration-300 hover:text-green-400">
                                    www.ekisanzone.com
                                </a>
                            </li>
                            <li>
                                <a href="http://www.kisansat.com" target="_blank" class="transition duration-300 hover:text-green-400">
                                    www.kisansat.com
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- Middle: Corporate Office Info -->
                    <div class="text-center md:text-left">
                        <h3 class="mb-6 text-3xl font-bold text-green-400"><?php echo e(__('messages.footer_corporate_office')); ?></h3>
                        <p class="mb-6 leading-relaxed text-gray-200">
                            <?php echo e(__('messages.footer_address')); ?>

                        </p>

                        <h4 class="mb-4 text-xl font-semibold text-green-300"><?php echo e(__('messages.footer_key_contacts')); ?></h4>
                        <ul class="space-y-2 text-gray-200">
                            <li class="flex flex-col p-3 rounded-lg md:flex-row md:justify-between md:items-center bg-gray-900/40">
                                <span class="font-medium">Ms. Karishma Srivastava</span>
                                <span class="italic text-gray-300"><?php echo e(__('messages.business_development_manager')); ?></span>
                                <span class="font-medium text-green-400"> +91-7028301210</span>
                            </li>
                            <li class="flex flex-col p-3 rounded-lg md:flex-row md:justify-between md:items-center bg-gray-900/40">
                                <span class="font-medium">Mr. Bhushan Deshmukh</span>
                                <span class="italic text-gray-300"><?php echo e(__('messages.sales_agronomist')); ?></span>
                                <span class="font-medium text-green-400"> +91-9096338660</span>
                            </li>
                            <li class="flex flex-col p-3 rounded-lg md:flex-row md:justify-between md:items-center bg-gray-900/40">
                                <span class="font-medium">Mr. Amol Khandare</span>
                                <span class="italic text-gray-300"><?php echo e(__('messages.co_founder_director')); ?></span>
                                <span class="font-medium text-green-400"> +91-7775008660</span>
                            </li>
                            <li class="flex flex-col p-3 rounded-lg md:flex-row md:justify-between md:items-center bg-gray-900/40">
                                <span class="font-medium">Mrs. Priya Gangasagare</span>
                                <span class="italic text-gray-300"><?php echo e(__('messages.co_founder_director')); ?></span>
                                <span class="font-medium text-green-400"> +91-97730951149</span>
                            </li>
                        </ul>
                    </div>

                    <!-- Right: Email & WhatsApp -->
                    <div class="ml-12 text-center md:text-left">
                        <h4 class="mb-3 text-xl font-semibold text-green-300"><?php echo e(__('messages.footer_email')); ?></h4>
                        <ul class="space-y-2 text-gray-200">
                            <li>
                                <a href="mailto:info@ekisanzone.com" class="transition duration-300 hover:text-green-400">info@ekisanzone.com</a>
                            </li>
                            <li>
                                <a href="mailto:info.clickngrow@gmail.com" class="transition duration-300 hover:text-green-400">info.clickngrow@gmail.com</a>
                            </li>
                            <li>
                                <a href="mailto:ekisanzone1@gmail.com" class="transition duration-300 hover:text-green-400">ekisanzone1@gmail.com</a>
                            </li>
                        </ul>

                        <h4 class="mt-6 mb-3 text-xl font-semibold text-green-300"><?php echo e(__('messages.footer_whatsapp')); ?></h4>
                        <p class="text-lg">💬 +91-7775008660</p>
                    </div>
                </div>
            </div>
        </footer>


    </section>









    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>





    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const enquiryForm = document.querySelector(
                'form[action="<?php echo e(route('contract_farming.enquiry.public.store')); ?>"]');

            <?php if(session('success')): ?>
                // Scroll to form
                enquiryForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Show SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "<?php echo e(session('success')); ?>",
                    timer: 7000,
                    showConfirmButton: true
                });
            <?php endif; ?>

            <?php if(session('error')): ?>
                // Scroll to form
                enquiryForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Show SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "<?php echo e(session('error')); ?>",
                    timer: 7000,
                    showConfirmButton: true
                });
            <?php endif; ?>
        });
    </script>

    <script>
        window.addEventListener("DOMContentLoaded", () => {
            const video = document.getElementById("backgroundVideo");
            if (video) {
                video.playbackRate = 0.5; // 0.5 = half speed
            }
        });
    </script>





 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $attributes = $__attributesOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__attributesOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b)): ?>
<?php $component = $__componentOriginal69dc84650370d1d4dc1b42d016d7226b; ?>
<?php unset($__componentOriginal69dc84650370d1d4dc1b42d016d7226b); ?>
<?php endif; ?>
<?php /**PATH C:\Users\jab\Desktop\Contract\resources\views/pages/contract.blade.php ENDPATH**/ ?>