<x-guest-layout brand="click-n-grow">
    <section class="trading-export-hero" aria-labelledby="trading-export-title">
        <img class="trading-export-hero__image" src="{{ asset('images/te_banner.png') }}"
            alt="" fetchpriority="high">
        <div class="trading-export-hero__wash" aria-hidden="true"></div>
        <div class="trading-export-hero__content">
            <p class="trading-export-hero__eyebrow">Trading &amp; Export</p>
            <h1 class="trading-export-hero__title" id="trading-export-title">
                Bringing India&rsquo;s<br class="trading-export-hero__desktop-break">
                Herbal Wealth to<br class="trading-export-hero__desktop-break">
                the World
            </h1>
            <p class="trading-export-hero__description">
                We supply high-quality, sustainably sourced herbal raw materials to herbal companies and global
                markets, ensuring purity, consistency and reliable supply.
            </p>
            <div class="trading-export-hero__actions">
                <a class="trading-export-hero__button trading-export-hero__button--primary"
                    href="{{ route('contact-us') }}">
                    Inquire for Raw Materials <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
                <a class="trading-export-hero__button trading-export-hero__button--secondary"
                    href="{{ route('contact-us') }}">
                    Partner With Us <i class="fas fa-arrow-right" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>

    <section class="trading-export-highlights" aria-label="Trading and export advantages">
        <div class="trading-export-highlights__grid">
            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-leaf"></i>
                </span>
                <h2 class="trading-export-highlight__title">Wide Range of Herbal Crops</h2>
                <p class="trading-export-highlight__description">
                    14+ herbal crops sourced from our farmer network.
                </p>
            </article>

            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-certificate"></i>
                </span>
                <h2 class="trading-export-highlight__title">Reliable Quality</h2>
                <p class="trading-export-highlight__description">
                    Quality checked and processed as per industry standards.
                </p>
            </article>

            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-truck"></i>
                </span>
                <h2 class="trading-export-highlight__title">Consistent Supply</h2>
                <p class="trading-export-highlight__description">
                    Scalable supply from 500+ farmers across 10+ states.
                </p>
            </article>

            <article class="trading-export-highlight">
                <span class="trading-export-highlight__icon" aria-hidden="true">
                    <i class="fas fa-globe"></i>
                </span>
                <h2 class="trading-export-highlight__title">Domestic &amp; Global Reach</h2>
                <p class="trading-export-highlight__description">
                    Supplying to leading herbal companies in India and international markets.
                </p>
            </article>
        </div>
    </section>
</x-guest-layout>
