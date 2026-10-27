<x-guest-layout :contract_var="'contract_page'">

    <section class="contract-home-hero">
        <picture>
            <source media="(max-width: 767px)" srcset="{{ asset('images/client-assets/farmers-at-harvest.jpg') }}">
            <img class="contract-home-hero__image" src="{{ asset('images/client-assets/farmers-at-harvest.jpg') }}"
                alt="Farmer holding fresh herbs in a green field" fetchpriority="high">
        </picture>
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

    <section class="journey-section" aria-labelledby="journey-heading">
        <header class="journey-section__header">
            <h2 id="journey-heading">From Farm to Future</h2>
            <p>Our end-to-end model connects farmers to the herbal industry with complete support.</p>
        </header>

        <div class="journey-track-wrap">
            <ol class="journey-track" aria-label="Farm-to-herbal-industry process">
                <li class="journey-step">
                    <img src="{{ asset('images/lang and soil.jpg') }}" alt="Cultivated field" loading="lazy">
                    <span>Crop<br>Selection</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/Quality Input Supply.jpg') }}" alt="Farmer tending a field" loading="lazy">
                    <span>Cultivation</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/farmer.jpg') }}" alt="Farmer growing herbs" loading="lazy">
                    <span>Raw Support<br>for Cultivation</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/farmer-happy.jpg') }}" alt="Farmer with harvested produce" loading="lazy">
                    <span>Harvest</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/Cultivation Advisory.jpg') }}" alt="Crop assessment in a greenhouse" loading="lazy">
                    <span>Quality<br>Assessment</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/Corporates.jpeg') }}" alt="Agricultural materials being assessed" loading="lazy">
                    <span>Processing /<br>Grading</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/FPOs.jpg') }}" alt="Farmer producer organization and its produce" loading="lazy">
                    <span>Raw Material<br>Supply</span>
                </li>
                <li class="journey-step">
                    <img src="{{ asset('images/yeild.jpg') }}" alt="Mature crop ready for market" loading="lazy">
                    <span>Herbal<br>Industry</span>
                </li>
            </ol>
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
                    url('{{ asset('images/sec_bg.png') }}') center center / cover no-repeat;
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
                        url('{{ asset('images/sec_bg.png') }}') 66% center / cover no-repeat;
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
                        url('{{ asset('images/sec_bg.png') }}') center center / cover no-repeat;
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
    <!-- Alpine.js -->
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>



    <!-- Success Stories -->
    <div class="bg-green-100" x-data="testimonialSlider()" x-init="initAutoScroll()">
        <div class="mt-16 text-center">
            <br>
            <h2 class="text-3xl font-bold text-[#3d693c] mb-4">{{ __('messages.success_stories') }}</h2>
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
                 {{ __('messages.youtube_section_title') }}
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
    <section class="py-12 bg-white" id="faq" x-data="{ tab: 'general' }">
        <div class="max-w-3xl px-4 mx-auto">

            <!-- Heading -->
            <h2 class="mb-4 text-3xl font-bold text-center text-green-900">{{ __('messages.faq_heading') }}</h2>
            <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full mb-6 text-center"></div>

            <!-- Tabs -->
            <div class="flex justify-center mb-6 space-x-4 text-center">
                <button @click="tab = 'general'" :class="{ 'bg-green-600 text-white': tab === 'general' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    {{ __('messages.faq_tab_general') }}
                </button>
                <button @click="tab = 'government'" :class="{ 'bg-green-600 text-white': tab === 'government' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    {{ __('messages.faq_tab_government') }}
                </button>
                <button @click="tab = 'post'" :class="{ 'bg-green-600 text-white': tab === 'post' }"
                    class="px-4 py-2 border rounded-lg hover:bg-green-100">
                    {{ __('messages.faq_tab_post') }}
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




    {{-- Crop --}}
    <section class="py-16" id="contract-crops" x-data>
        <div class="container max-w-6xl px-4 mx-auto">
            <div class="mt-16 text-center">
                <h2 class="text-3xl font-bold text-[#3d693c] mb-4">
                    {{ __('messages.contract_crops_title') }}
                </h2>
                <div class="w-24 h-1 bg-[#90ee90] mx-auto rounded-full"></div>
                <br>
            </div>

            <!-- Crop Cards -->
            <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3">
                @foreach ($datas as $data)
                    <div x-data="{ showModal: false }"
                        class="contract-crop-card">

                        <img class="contract-crop-card__image" src="{{ $data->display_image ?? asset('images/client-assets/crop-herb.jpg') }}"
                            alt="Herbal crops grown for contract farming" loading="lazy">

                        <div class="contract-crop-card__body">

                        <!-- Card Header -->
                        <div class="flex items-center mb-2 space-x-3">
                            @if ($data->icon)
                                <span class="text-xl">{!! $data->icon !!}</span>
                            @endif
                            <h3 class="text-lg font-semibold text-[#2b501e]">{{ $data->name }}</h3>
                        </div>

                        <!-- Card Description -->
                        <p class="mb-4 text-sm text-gray-700">{{ $data->description }}</p>

                        <!-- Sowing Months -->
                        @if (!empty($data->sowing_months))
                            <p class="mb-4 text-xs font-semibold text-green-700">
                                Sowing Months:
                                <span class="font-normal text-gray-500 whitespace-normal">
                                    @php
                                        $months = $data->sowing_months;
                                        if (is_string($months)) {
                                            $months = json_decode($months, true);
                                        }
                                        if (is_array($months)) {
                                            echo implode(', ', $months);
                                        } else {
                                            echo $data->sowing_months;
                                        }
                                    @endphp
                                </span>
                            </p>
                        @endif

                        <!-- View Details Button -->
                        <button @click="showModal = true" class="text-sm font-semibold text-[#2b501e] hover:underline">
                            {{ __('messages.contract_crops_view_details') }}
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
                                    @if ($data->icon)
                                        <span class="text-2xl">{!! $data->icon !!}</span>
                                    @endif
                                    <h3 class="text-xl font-semibold text-green-800">{{ $data->name }} Details</h3>
                                </div>

                                <!-- ✅ Add this code here to display images -->
                                @php
                                    $images = is_array($data->images)
                                        ? $data->images
                                        : (json_decode($data->images ?? '[]', true) ?? []);
                                @endphp

                                @if (!empty($images))
                                    <div class="grid grid-cols-2 gap-3 mb-4">
                                        @foreach ($images as $img)
                                            <img src="{{ asset('storage/' . $img) }}" alt="{{ $data->name }}"
                                                class="object-cover w-full h-24 border border-gray-300 rounded">
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Modal Details -->
                                <p class="mb-4 text-sm text-gray-700">{{ $data->details }}</p>

                                <!-- PDFs -->
                                <div class="flex justify-center gap-4 mt-6">
                                    @if ($data->pdf_en)
                                        <a href="{{ asset('storage/' . $data->pdf_en) }}" target="_blank"
                                            class="px-5 py-2 font-semibold text-white transition bg-green-800 rounded-lg shadow hover:bg-green-900">
                                            {{ __('messages.contract_crops_pdf_en') }}
                                        </a>
                                    @endif
                                    @if ($data->pdf_hi)
                                        <a href="{{ asset('storage/' . $data->pdf_hi) }}" target="_blank"
                                            class="px-5 py-2 font-semibold text-white transition bg-green-800 rounded-lg shadow hover:bg-green-900">
                                            {{ __('messages.contract_crops_pdf_hi') }}
                                        </a>
                                    @endif
                                </div>

                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>




    @include('pages.partials.gallery-news')

    <!-- Farmer and partner enquiry forms -->
    <section class="relative py-16 text-green-900" x-data="{ activeTab: 'associate' }">
        <!-- Background Image -->
        <div class="absolute inset-0 bg-center bg-cover blur-sm "
            style="background-image: url('{{ asset('images/hero_placeholder_img2.webp') }}');">
        </div>

        <!-- Overlay -->
        {{-- <div class="absolute inset-0 bg-white/50"></div> --}}

        <!-- Heading (FULL WIDTH, no box) -->
        <div id="enquiry-form-section" class="relative px-6 py-10 text-center">
            {{-- <img src="{{ asset('images/Click N Grow Final Logo.jpg') }}" alt="Logo" class="mb-4 h-52"> --}}
            {{-- <h2 class="text-4xl font-bold text-green-900">Ready to Start Your Journey?</h2>
            <p class="mt-2 text-lg text-gray-700">Get in touch with our experts today</p> --}}

            <h1 class="mb-8 text-3xl font-bold text-center text-green-800 md:text-4xl">
                {{ __('messages.enquiry_form_title') }}
            </h1>
            <p class="mb-6 text-center text-gray-600">
                 {{ __('messages.enquiry_form_desc') }}
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
                    {{ __('messages.business_associate_tab') }}
                </button>
                <button class="px-6 py-3 font-semibold"
                    :class="activeTab === 'farmer' ? 'text-green-800 border-b-4 border-green-700' :
                        'text-gray-600 hover:text-green-800'"
                    @click="activeTab = 'farmer'">
                    {{ __('messages.individual_farmer_tab') }}
                </button>
                <button class="px-6 py-3 font-semibold"
                    :class="activeTab === 'fpo' ? 'text-green-800 border-b-4 border-green-700' :
                        'text-gray-600 hover:text-green-800'"
                    @click="activeTab = 'fpo'">
                    {{ __('messages.fpo_farmer_group_tab') }}
                </button>
            </div>

            <!-- Forms -->
            <div class="bg-white">
                <!-- Business Associate Form -->
                <div class="p-8" x-show="activeTab === 'associate'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800">{{ __('messages.business_associate_title') }}
                    </h2>
                    <p class="mb-6 text-center text-gray-600">{{ __('messages.business_associate_desc') }}</p>

                    <form action="{{ route('public.enquiry.business.store') }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf
                        <!-- Full Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.full_name') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Company Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.company_name') }}</label>
                            <input type="text" name="company_name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.mobile_number') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.email') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State & District -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.state_district') }}<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="state_district" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Experience -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.experience') }}</label>
                            <input type="number" name="experience" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Area You Wish to Operate In -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.operating_area') }}</label>
                            <input type="text" name="operating_area"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Type of Network -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.network_type') }}</label>
                            <input type="text" name="network_type"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Why do you want to work -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.reason') }}</label>
                            <textarea name="reason" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Upload Resume -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> {{ __('messages.resume') }}</label>
                            <input type="file" name="resume" accept=".pdf,.doc,.docx"
                                class="w-full text-gray-700">
                        </div>

                        <!-- Preferred Mode of Contact -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> {{ __('messages.preferred_contact') }}</label>
                            <select name="preferred_contact"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="call">{{ __('messages.call') }}</option>
                                <option value="whatsapp">{{ __('messages.whatsapp') }}</option>
                                <option value="email">{{ __('messages.email') }}</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                 {{ __('messages.submit_button') }}
                            </button>
                        </div>
                    </form>
                </div>


                <!-- Farmer Form -->
                <div class="p-8" x-show="activeTab === 'farmer'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800"> {{ __('messages.individual_farmer_title') }}
                    </h2>
                    <p class="mb-6 text-center text-gray-600"> {{ __('messages.individual_farmer_desc') }}</p>

                    <form action="{{ route('public.enquiry.farmer.store') }}" method="POST" class="space-y-4">
                        @csrf

                        <!-- Full Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> {{ __('messages.full_name') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="full_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.mobile_number') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.email') }}</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State & District -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> {{ __('messages.state_district') }}<span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="state_district" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Village/Town Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.village_town_name') }} <span
                                    class="text-red-500">*</span></label>
                            <input type="text" name="village" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Total Land Available -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.total_land_available') }}<span class="text-red-500">*</span></label>
                            <input type="number" name="land_area" min="0" step="0.01" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Irrigation Availability -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.irrigation_availability') }} <span
                                    class="text-red-500">*</span></label>
                            <select name="irrigation" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">{{ __('messages.select') }}</option>
                                <option value="yes">{{ __('messages.yes') }}</option>
                                <option value="no">{{ __('messages.no') }}</option>
                            </select>
                        </div>

                        <!-- Type of Land -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.type_of_land') }}<span
                                    class="text-red-500">*</span></label>
                            <select name="land_type" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">{{ __('messages.select') }}</option>
                                <option value="owned">{{ __('messages.owned') }}</option>
                                <option value="leased">{{ __('messages.leased') }}</option>
                            </select>
                        </div>

                        <!-- Crops Cultivated Previously -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.crops_cultivated_previously') }}</label>
                            <input type="text" name="previous_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Interested Crops -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.interested_crop') }}</label>
                            <select name="interested_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">{{ __('messages.select_crop') }}</option>
                                <option value="akarkara">{{ __('messages.akarkara') }}</option>
                                <option value="amla">{{ __('messages.amla') }}</option>
                                <option value="ashwagandha">{{ __('messages.ashwagandha') }}</option>
                                <option value="black_turmeric">{{ __('messages.black_turmeric') }}</option>
                                <option value="chia_seeds">{{ __('messages.chia_seeds') }}</option>
                                <option value="kalmegh">{{ __('messages.kalmegh') }}</option>
                                <option value="moringa">{{ __('messages.moringa') }}</option>
                                <option value="pippli">{{ __('messages.pippli') }}</option>
                                <option value="quinoa">{{ __('messages.quinoa') }}</option>
                                <option value="safed_musli">{{ __('messages.safed_musli') }}</option>
                                <option value="sarpagandha">{{ __('messages.sarpagandha') }}</option>
                                <option value="stevia">{{ __('messages.stevia') }}</option>
                                <option value="tulsi">{{ __('messages.tulsi') }}</option>
                                <option value="yellow_shatavari">{{ __('messages.yellow_shatavari') }}</option>
                                <!-- Add more crops as needed -->
                            </select>
                        </div>


                        <!-- Planned Start Month -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.planned_start_month') }}</label>
                            <select name="start_month"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">{{ __('messages.select_month') }}</option>
                                <option value="january">{{ __('messages.january') }}</option>
                                <option value="february">{{ __('messages.february') }}</option>
                                <option value="march">{{ __('messages.march') }}</option>
                                <option value="april">{{ __('messages.april') }}</option>
                                <option value="may">{{ __('messages.may') }}</option>
                                <option value="june">{{ __('messages.june') }}</option>
                                <option value="july">{{ __('messages.july') }}</option>
                                <option value="august">{{ __('messages.august') }}</option>
                                <option value="september">{{ __('messages.september') }}</option>
                                <option value="october">{{ __('messages.october') }}</option>
                                <option value="november">{{ __('messages.november') }}</option>
                                <option value="december">{{ __('messages.december') }}</option>
                            </select>
                        </div>

                        <!-- Preferred Support Required -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700"> {{ __('messages.preferred_support_required') }}</label>
                            <div class="flex flex-col space-y-2">
                                <label><input type="checkbox" name="support[]" value="technical_guidance"
                                        class="mr-2"> {{ __('messages.technical_guidance') }}</label>
                                <label><input type="checkbox" name="support[]" value="input_supply" class="mr-2">
                                    {{ __('messages.input_supply') }}</label>
                                <label><input type="checkbox" name="support[]" value="buyback_contract"
                                        class="mr-2">{{ __('messages.buyback_contract') }}</label>
                                <label><input type="checkbox" name="support[]" value="training" class="mr-2">
                                    {{ __('messages.training') }}</label>
                            </div>
                        </div>

                        <!-- Additional Comments -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.additional_comments') }}</label>
                            <textarea name="additional_comments" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                {{ __('messages.submit_farmer_enquiry') }}
                            </button>
                        </div>
                    </form>
                </div>


                <!-- FPO Form -->
                <!-- FPO / Farmer Group Form -->
                <div class="p-8" x-show="activeTab === 'fpo'">
                    <h2 class="mb-2 text-2xl font-bold text-center text-green-800">
                        {{ __('messages.fpo_farmer_group_title') }}
                    </h2>
                    <p class="mb-6 text-center text-gray-600">
                        {{ __('messages.fpo_farmer_group_desc') }}
                    </p>

                    <form action="{{ route('public.enquiry.fpo.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <!-- FPO / Group Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.fpo_group_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="group_name" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Registration Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.registration_number') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="registration_number" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Contact Person Name -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.contact_person_name') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="contact_person" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Mobile Number -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.mobile_number') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="mobile" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Email ID -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.email') }}</label>
                            <input type="email" name="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- State, District & Taluka -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.state_district_taluka') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="state_district_taluka" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Number of Farmers -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.number_of_farmers') }} <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="number_of_farmers" min="1" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Total Land Available -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">
                                {{ __('messages.total_land_available') }} ({{ __('messages.combined') }}) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="total_land" min="0" step="0.01" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Type of Crops Currently Grown -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.current_crops') }}</label>
                            <input type="text" name="current_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Interested Crops -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.interested_crop') }}</label>
                            <select name="interested_crops"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                                <option value="">{{ __('messages.select_crop') }}</option>
                                <option value="akarkara">{{ __('messages.akarkara') }}</option>
                                <option value="amla">{{ __('messages.amla') }}</option>
                                <option value="ashwagandha">{{ __('messages.ashwagandha') }}</option>
                                <option value="black_turmeric">{{ __('messages.black_turmeric') }}</option>
                                <option value="chia_seeds">{{ __('messages.chia_seeds') }}</option>
                                <option value="kalmegh">{{ __('messages.kalmegh') }}</option>
                                <option value="moringa">{{ __('messages.moringa') }}</option>
                                <option value="pippli">{{ __('messages.pippli') }}</option>
                                <option value="quinoa">{{ __('messages.quinoa') }}</option>
                                <option value="safed_musli">{{ __('messages.safed_musli') }}</option>
                                <option value="sarpagandha">{{ __('messages.sarpagandha') }}</option>
                                <option value="stevia">{{ __('messages.stevia') }}</option>
                                <option value="tulsi">{{ __('messages.tulsi') }}</option>
                                <option value="yellow_shatavari">{{ __('messages.yellow_shatavari') }}</option>
                                <!-- Add more crops as needed -->
                            </select>
                        </div>

                        <!-- Expected Start Time -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.expected_start_time') }}</label>
                            <input type="text" name="expected_start"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700">
                        </div>

                        <!-- Support Required -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.support_required') }}</label>
                            <div class="flex flex-col space-y-2">
                                <label><input type="checkbox" name="support[]" value="technical_guidance" class="mr-2"> {{ __('messages.technical_guidance') }}</label>
                                <label><input type="checkbox" name="support[]" value="bulk_input_supply" class="mr-2"> {{ __('messages.bulk_input_supply') }}</label>
                                <label><input type="checkbox" name="support[]" value="buyback_contract" class="mr-2"> {{ __('messages.buyback_contract') }}</label>
                                <label><input type="checkbox" name="support[]" value="on_site_visit" class="mr-2"> {{ __('messages.on_site_visit') }}</label>
                            </div>
                        </div>

                        <!-- Upload Group Profile -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.upload_group_profile') }}</label>
                            <input type="file" name="group_profile" accept=".pdf,.doc,.docx" class="w-full text-gray-700">
                        </div>

                        <!-- Remarks -->
                        <div>
                            <label class="block mb-1 font-semibold text-gray-700">{{ __('messages.remarks') }}</label>
                            <textarea name="remarks" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-700"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit"
                                class="px-6 py-3 font-semibold text-white transition bg-green-700 rounded-lg hover:bg-green-800">
                                {{ __('messages.submit_fpo_enquiry') }}
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>

    </section>









    <!-- Alpine.js -->
    <script src="https://unpkg.com/alpinejs" defer></script>





    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const enquiryForm = document.getElementById('enquiry-form-section');

            @if (session('success'))
                // Scroll to form
                enquiryForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Show SweetAlert
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 7000,
                    showConfirmButton: true
                });
            @endif

            @if (session('error'))
                // Scroll to form
                enquiryForm.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });

                // Show SweetAlert
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 7000,
                    showConfirmButton: true
                });
            @endif
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





</x-guest-layout>
