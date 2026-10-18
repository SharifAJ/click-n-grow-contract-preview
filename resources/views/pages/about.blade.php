<x-guest-layout brand="click-n-grow">
    <section class="about-hero" aria-labelledby="about-hero-title">
        <img class="about-hero__image" src="{{ asset('images/home_banner.png') }}"
            alt="Farmer tending herbal crops in a green field" fetchpriority="high">
        <div class="about-hero__content">
            <p class="about-hero__eyebrow"><span aria-hidden="true"></span>ABOUT US</p>
            <h1 class="about-hero__title" id="about-hero-title">From Farm to Future</h1>
            <p class="about-hero__tagline">Connecting Farmers, Herbal Industries<br class="about-hero__desktop-break"> and Sustainable Growth</p>
            <p class="about-hero__description">
                Click-N-Grow Agroventures Pvt. Ltd. is an agribusiness company focused on developing a structured,
                market-oriented medicinal plants ecosystem by connecting farmers with herbal industries through contract
                farming, technical guidance, aggregation and market linkages.
            </p>
            <a class="about-hero__button" href="#about-bigger-picture">Our Story <span aria-hidden="true">→</span></a>
        </div>
    </section>

    <section class="about-bigger-picture" id="about-bigger-picture" aria-labelledby="about-bigger-picture-title">
        <div class="about-bigger-picture__inner">
            <div class="about-bigger-picture__content">
                <p class="about-bigger-picture__eyebrow"><span aria-hidden="true"></span> The Bigger Picture</p>
                <h2 class="about-bigger-picture__title" id="about-bigger-picture-title">
                    India Has the Potential.<br>
                    The Gap Is in the Connection.
                </h2>
                <p class="about-bigger-picture__description">
                    India has a rich heritage of medicinal plants and a fast-growing herbal industry. Yet, there is a gap
                    between farmers who grow these crops and industries that need them. We are working to bridge this gap
                    through a structured, market-linked approach.
                </p>
            </div>

            <div class="about-bigger-picture__visual" aria-hidden="true">
                <div class="about-bigger-picture__map"></div>
                <div class="about-bigger-picture__arrow about-bigger-picture__arrow--top"></div>

                <div class="about-bigger-picture__circle about-bigger-picture__circle--crop">
                    <img src="{{ asset('images/plant.jpg') }}" alt="">
                </div>

                <div class="about-bigger-picture__circle about-bigger-picture__circle--processing">
                    <img src="{{ asset('images/farmer-happy.jpg') }}" alt="">
                </div>

                <div class="about-bigger-picture__circle about-bigger-picture__circle--root">
                    <img src="{{ asset('images/crops.jpg') }}" alt="">
                </div>
            </div>
        </div>
    </section>
</x-guest-layout>
