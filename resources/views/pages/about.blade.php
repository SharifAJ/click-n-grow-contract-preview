<x-guest-layout brand="click-n-grow">
    <section class="about-hero" aria-labelledby="about-hero-title">
        <img class="about-hero__image" src="{{ asset('images/home_banner.png') }}"
            alt="Farmer tending herbal crops in a green field" fetchpriority="high">
        <div class="about-hero__wash" aria-hidden="true"></div>
        <div class="about-hero__content">
            <h1 class="about-hero__title" id="about-hero-title">About Us</h1>
            <p class="about-hero__tagline">Empowering Herbal Farming<br class="about-hero__desktop-break"> for a Healthier Tomorrow</p>
            <p class="about-hero__description">
                At Click-N-Grow Agroventures Pvt Ltd, we are committed to building a sustainable and transparent herbal
                farming ecosystem by connecting farmers, industry and opportunities.
            </p>
        </div>
    </section>

    <section class="about-story" aria-labelledby="about-story-title">
        <div class="about-story__intro">
            <div class="about-story__copy">
                <p class="about-story__eyebrow">Who We Are</p>
                <h2 class="about-story__title" id="about-story-title">Building a Stronger<br class="about-story__desktop-break"> Herbal Farming Ecosystem</h2>
                <p class="about-story__description">
                    Click-N-Grow Agroventures Pvt Ltd is an initiative dedicated to promoting large-scale cultivation of
                    medicinal and aromatic plants through contract farming. We work closely with farmers, FPOs, herbal
                    companies and business partners to create a reliable, sustainable and profitable value chain — from
                    farm to industry.
                </p>
            </div>
            <div class="about-story__image-wrap">
                <img class="about-story__image" src="{{ asset('images/plant.jpg') }}"
                    alt="A young medicinal plant growing in rich soil">
            </div>
        </div>

        <div class="about-story__values">
            <article class="about-story__value about-story__value--vision">
                <svg class="about-story__value-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                    <circle cx="28" cy="36" r="20" stroke="currentColor" stroke-width="3" />
                    <circle cx="28" cy="36" r="11" stroke="currentColor" stroke-width="3" />
                    <circle cx="28" cy="36" r="3" fill="currentColor" />
                    <path d="M30 34 52 12m-10 0h10v10m-18 18 9-9" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div>
                    <h3>Our Vision</h3>
                    <p>To be a leading force in herbal agriculture, empowering farmers and creating a healthier, more sustainable India.</p>
                </div>
            </article>

            <article class="about-story__value about-story__value--mission">
                <svg class="about-story__value-icon" viewBox="0 0 64 64" fill="none" aria-hidden="true">
                    <path d="M8 52 29 18l21 34H8Z" stroke="currentColor" stroke-width="3" stroke-linejoin="round" />
                    <path d="M18 36h23M29 18V8m0 0h17l-5 6 5 5H29" stroke="currentColor" stroke-width="3"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div>
                    <h3>Our Mission</h3>
                    <p>To support farmers at every step — from crop selection to raw material supply — through expert guidance, market linkages and long-term partnerships.</p>
                </div>
            </article>
        </div>
    </section>

    <section class="about-approach" aria-labelledby="about-approach-title">
        <div class="about-approach__header">
            <p class="about-approach__eyebrow">Our Approach</p>
            <h2 class="about-approach__title" id="about-approach-title">From Farm to Herbal Industry</h2>
            <p class="about-approach__description">
                We provide end-to-end support to ensure successful cultivation, quality production and direct market access for farmers.
            </p>
        </div>

        <ol class="about-approach__steps">
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-hand-holding-seedling" aria-hidden="true"></i></span>
                <span class="about-approach__label">Crop<br>Selection</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-seedling" aria-hidden="true"></i></span>
                <span class="about-approach__label">Cultivation</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-user" aria-hidden="true"></i></span>
                <span class="about-approach__label">Field Support<br>for Cultivation</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-wheat-awn" aria-hidden="true"></i></span>
                <span class="about-approach__label">Harvest</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-circle-check" aria-hidden="true"></i></span>
                <span class="about-approach__label">Quality<br>Assessment</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-gears" aria-hidden="true"></i></span>
                <span class="about-approach__label">Processing /<br>Grading</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-truck" aria-hidden="true"></i></span>
                <span class="about-approach__label">Raw Material<br>Supply</span>
                <span class="about-approach__arrow" aria-hidden="true"><i class="fas fa-arrow-right"></i></span>
            </li>
            <li class="about-approach__step">
                <span class="about-approach__icon"><i class="fas fa-industry" aria-hidden="true"></i></span>
                <span class="about-approach__label">Herbal<br>Industry</span>
            </li>
        </ol>
    </section>
</x-guest-layout>
