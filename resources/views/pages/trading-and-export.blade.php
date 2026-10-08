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
</x-guest-layout>
