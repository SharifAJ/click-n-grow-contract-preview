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

    <section class="trading-export-products" aria-labelledby="trading-export-products-title">
        <header class="trading-export-products__header">
            <div>
                <p class="trading-export-products__eyebrow">Our Products</p>
                <h2 class="trading-export-products__title" id="trading-export-products-title">
                    High-Quality Herbal Raw Materials
                </h2>
                <p class="trading-export-products__intro">
                    We supply a diverse range of medicinal and aromatic plants, sourced directly from farmers
                    and processed to meet industry requirements.
                </p>
            </div>
            <a class="trading-export-products__all" href="{{ route('contract') }}#contract-crops">
                View All Crops <i class="fas fa-arrow-right" aria-hidden="true"></i>
            </a>
        </header>

        @if ($crops->isNotEmpty())
            <div class="trading-export-products__grid">
                @foreach ($crops->take(6) as $crop)
                    <article class="trading-export-product">
                        @if (is_array($crop->images) && !empty($crop->images[0]))
                            <img class="trading-export-product__image"
                                src="{{ asset('storage/' . $crop->images[0]) }}"
                                alt="{{ $crop->name }}" loading="lazy">
                        @else
                            <div class="trading-export-product__placeholder" aria-hidden="true">
                                <i class="fas fa-leaf"></i>
                            </div>
                        @endif
                        <div class="trading-export-product__body">
                            <h3 class="trading-export-product__name">{{ $crop->name }}</h3>
                            <p class="trading-export-product__description">
                                Herbal raw material
                            </p>
                            <a class="trading-export-product__link"
                                href="{{ route('contact-us') }}"
                                aria-label="Inquire about {{ $crop->name }}">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @else
            @php
                $sampleProducts = [
                    ['name' => 'Ashwagandha', 'parts' => 'Root | Dried | Powder', 'icon' => 'fa-seedling', 'style' => 'ashwagandha'],
                    ['name' => 'Tulsi', 'parts' => 'Leaves | Dried | Powder', 'icon' => 'fa-leaf', 'style' => 'tulsi'],
                    ['name' => 'Aloe Vera', 'parts' => 'Leaf | Dried | Powder', 'icon' => 'fa-leaf', 'style' => 'aloe'],
                    ['name' => 'Shatavari', 'parts' => 'Root | Dried | Powder', 'icon' => 'fa-carrot', 'style' => 'shatavari'],
                    ['name' => 'Moringa', 'parts' => 'Leaves | Dried | Powder', 'icon' => 'fa-mortar-pestle', 'style' => 'moringa'],
                    ['name' => 'Amla', 'parts' => 'Fruit | Dried | Powder', 'icon' => 'fa-apple-whole', 'style' => 'amla'],
                ];
            @endphp

            <div class="trading-export-products__grid">
                @foreach ($sampleProducts as $product)
                    <article class="trading-export-product">
                        <div class="trading-export-product__sample-art trading-export-product__sample-art--{{ $product['style'] }}"
                            aria-hidden="true">
                            <i class="fas {{ $product['icon'] }}"></i>
                        </div>
                        <div class="trading-export-product__body">
                            <h3 class="trading-export-product__name">{{ $product['name'] }}</h3>
                            <p class="trading-export-product__description">{{ $product['parts'] }}</p>
                            <a class="trading-export-product__link"
                                href="{{ route('contact-us') }}"
                                aria-label="Inquire about {{ $product['name'] }}">
                                <i class="fas fa-arrow-right" aria-hidden="true"></i>
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        @endif
    </section>

    <section class="trading-export-process" aria-labelledby="trading-export-process-title">
        <div class="trading-export-process__inner">
            <header class="trading-export-process__header">
                <p class="trading-export-process__eyebrow">Our Process</p>
                <h2 class="trading-export-process__title" id="trading-export-process-title">
                    From Farm to Global Markets
                </h2>
                <p class="trading-export-process__intro">
                    A transparent and reliable supply chain that ensures quality, traceability and timely delivery.
                </p>
            </header>

            <ol class="trading-export-process__steps">
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-people-group"></i>
                    </span>
                    <span class="trading-export-process__label">Farmer Network<br>&amp; Sourcing</span>
                </li>
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-seedling"></i>
                    </span>
                    <span class="trading-export-process__label">Collection &amp;<br>Primary Processing</span>
                </li>
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-certificate"></i>
                    </span>
                    <span class="trading-export-process__label">Quality<br>Assessment</span>
                </li>
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-gears"></i>
                    </span>
                    <span class="trading-export-process__label">Grading &amp;<br>Processing</span>
                </li>
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-box-open"></i>
                    </span>
                    <span class="trading-export-process__label">Packaging</span>
                </li>
                <li class="trading-export-process__step">
                    <span class="trading-export-process__icon" aria-hidden="true">
                        <i class="fas fa-ship"></i>
                    </span>
                    <span class="trading-export-process__label">Domestic &amp;<br>International Supply</span>
                </li>
            </ol>
        </div>
    </section>

    <section class="trading-export-commitment" aria-labelledby="trading-export-commitment-title">
        <div class="trading-export-commitment__inner">
            <div class="trading-export-commitment__content">
                <header class="trading-export-commitment__header">
                    <p class="trading-export-commitment__eyebrow">Our Commitment</p>
                    <h2 class="trading-export-commitment__title" id="trading-export-commitment-title">
                        Quality &amp; Traceability
                    </h2>
                    <p class="trading-export-commitment__intro">
                        We maintain strict quality standards and ensure complete traceability from farm to final delivery.
                    </p>
                </header>

                <div class="trading-export-commitment__grid">
                    <article class="trading-export-commitment__item">
                        <span class="trading-export-commitment__icon" aria-hidden="true">
                            <i class="fas fa-flask"></i>
                        </span>
                        <div>
                            <h3>Quality Checks</h3>
                            <p>Moisture, purity, active constituents and more.</p>
                        </div>
                    </article>
                    <article class="trading-export-commitment__item">
                        <span class="trading-export-commitment__icon" aria-hidden="true">
                            <i class="fas fa-certificate"></i>
                        </span>
                        <div>
                            <h3>Compliant Processing</h3>
                            <p>Processed and graded as per industry requirements.</p>
                        </div>
                    </article>
                    <article class="trading-export-commitment__item">
                        <span class="trading-export-commitment__icon" aria-hidden="true">
                            <i class="fas fa-file-lines"></i>
                        </span>
                        <div>
                            <h3>Traceable Supply Chain</h3>
                            <p>From farm to customer with full documentation.</p>
                        </div>
                    </article>
                    <article class="trading-export-commitment__item">
                        <span class="trading-export-commitment__icon" aria-hidden="true">
                            <i class="fas fa-leaf"></i>
                        </span>
                        <div>
                            <h3>Sustainable Sourcing</h3>
                            <p>Ethical and environmentally responsible practices.</p>
                        </div>
                    </article>
                </div>
            </div>

            <div class="trading-export-shipping" role="img"
                aria-label="Herbal products prepared for bulk shipping and export">
                <div class="trading-export-shipping__sun" aria-hidden="true"></div>
                <div class="trading-export-shipping__containers" aria-hidden="true">
                    <span class="trading-export-shipping__container trading-export-shipping__container--red"></span>
                    <span class="trading-export-shipping__container trading-export-shipping__container--blue"></span>
                    <span class="trading-export-shipping__container trading-export-shipping__container--gold"></span>
                    <span class="trading-export-shipping__container trading-export-shipping__container--navy"></span>
                </div>
                <i class="fas fa-ship trading-export-shipping__ship" aria-hidden="true"></i>
                <div class="trading-export-shipping__callouts" aria-hidden="true">
                    <span><i class="fas fa-box"></i>Bulk Supply Capacities</span>
                    <span><i class="fas fa-boxes-packing"></i>Custom Packaging Options</span>
                    <span><i class="fas fa-file-lines"></i>Export Documentation Support</span>
                </div>
            </div>
        </div>
    </section>

    <section class="trading-export-markets" aria-labelledby="trading-export-markets-title">
        <div class="trading-export-markets__inner">
            <p class="trading-export-markets__eyebrow">Our Markets</p>
            <h2 class="trading-export-markets__title" id="trading-export-markets-title">
                Serving the Herbal Industry
            </h2>
            <p class="trading-export-markets__intro">
                We supply raw materials to a wide range of industries, both in India and globally.
            </p>

            <div class="trading-export-markets__grid">
                <article class="trading-export-market">
                    <span class="trading-export-market__icon" aria-hidden="true">
                        <i class="fas fa-leaf"></i>
                    </span>
                    <div>
                        <h3>Herbal &amp; Ayurvedic Companies</h3>
                        <p>Raw materials for herbal formulations and products.</p>
                    </div>
                </article>

                <article class="trading-export-market">
                    <span class="trading-export-market__icon" aria-hidden="true">
                        <i class="fas fa-capsules"></i>
                    </span>
                    <div>
                        <h3>Pharmaceutical Industry</h3>
                        <p>High-quality herbal ingredients for pharmaceutical use.</p>
                    </div>
                </article>

                <article class="trading-export-market">
                    <span class="trading-export-market__icon" aria-hidden="true">
                        <i class="fas fa-pump-soap"></i>
                    </span>
                    <div>
                        <h3>Cosmetic &amp; Personal Care Industry</h3>
                        <p>Natural ingredients for skincare and wellness products.</p>
                    </div>
                </article>

                <article class="trading-export-market">
                    <span class="trading-export-market__icon" aria-hidden="true">
                        <i class="fas fa-mug-hot"></i>
                    </span>
                    <div>
                        <h3>Food &amp; Nutraceutical Industry</h3>
                        <p>Herbal ingredients for functional foods and supplements.</p>
                    </div>
                </article>
            </div>
        </div>
    </section>
</x-guest-layout>
