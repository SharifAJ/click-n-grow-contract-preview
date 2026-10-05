@props([
    'title' => 'KisanSat Services',
    'description' =>
        'KisanSAT is a satellite-based agriculture advisory service for issues relating to agriculture and a crop management concept that is more beneficial for increased crop yield.',
    'icon' => '',
    'headerImgUrl' => asset('/images/services_header2_1000x500.png'),
    'headerImgAlt' => 'KisanSat Services Hero Image',
])

<x-guest-layout>

    {{-- <div class="relative w-full h-64 sm:h-80 lg:h-52 bg-cover bg-center" style="background-image: url('/images/hero_placeholder_img2.webp');">
		<div class="absolute inset-0 bg-gradient-to-r from-black from-40% to-transparent opacity-30"></div>
		<div class="relative z-10 flex items-center h-full px-6 sm:px-10 lg:px-20">
			<div class="text-left text-white">
				<h1 class="text-2xl sm:text-4xl font-extrabold">{{ $title }}</h1>
			</div>
		</div>
	</div> --}}

    <div class="z-10 overflow-hidden bg-gradient-to-br from-green-100 via-transparent to-transparent">
        <div class="relative mx-auto flex h-auto w-full flex-col items-center sm:h-80 md:h-96 md:flex-row">

            <!-- Left Side (Text) -->
            <div
                class="w-full ps-6 pt-5 text-center text-black sm:ps-10 md:w-1/2 md:pt-0 md:text-left lg:pe-10 lg:ps-20">
                <h1 class="mb-4 text-xl font-extrabold md:text-4xl">{{ $title }}</h1>
                <p class="mt-2 text-base sm:text-xl">{{ $description }}</p>
            </div>
            <!-- Right Side (Image) -->
            <div class="mask-image mt-5 w-full md:mt-0 md:w-2/3">
                <img class="h-48 w-full object-cover md:h-full" src="{{ $headerImgUrl }}" alt="{{ $headerImgAlt }}">
            </div>
        </div>
    </div>
    <!-- CSS for Masking Effect -->
    <style>
        .mask-image {
            height: 100%;
            -webkit-mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0) 100%);
            mask-image: linear-gradient(to bottom, rgba(0, 0, 0, 1) 70%, rgba(0, 0, 0, 0.5) 90%, rgba(0, 0, 0, 0) 100%);
        }
    </style>


    <div class="container z-10 mt-10 w-full max-w-5xl bg-white px-4 sm:px-6 lg:px-20">
        {{-- <div
			class="rounded-lg bg-gradient-to-r from-green-200 via-emerald-100 to-emerald-200 p-6 text-center shadow-lg sm:p-8">
			<h1 class="mt-4 text-2xl font-extrabold sm:text-4xl">{{ $title }}</h1>
			<p class="mt-2 text-base sm:text-lg">{{ $description }}</p>
		</div> --}}

        {{-- dark green gradient and white text version of header --}}
        {{-- <div class=" bg-gradient-to-br from-emerald-600 to-green-500 text-white p-6 sm:p-8 rounded-lg shadow-lg text-center">
			<h1 class="mt-4 text-2xl sm:text-4xl font-extrabold">{{ $title }}</h1>
			<p class="mt-2 text-base sm:text-lg">{{ $description }}</p>
		</div> --}}


        <!-- Slot for page-specific content -->
        <div class="mt-6">
            {{ $slot }}
        </div>

        <!-- CTA Button -->
        {{-- <div class="mt-8 text-center">
			<a class="btn btn-primary rounded-lg bg-emerald-700 px-6 py-3 text-white shadow-md hover:bg-emerald-800"
				href="/#services">
				View All KisanSAT Services
			</a>
		</div> --}}

        <div class="my-16 text-center">
            <a class="text-sm text-blue-600 hover:underline sm:text-base"
                href="{{ route('home') }}/#services">{{ __('messages.all_Services_button') }}</a>
        </div>
    </div>
</x-guest-layout>

<script>
	const swiper = new Swiper(".productsSwiper", {
		loop: true,
		slidesPerView: 2,
		spaceBetween: 20,
		autoplay: {
			delay: 1,
			disableOnInteraction: false,
		},
		speed: 4000, // smooth continuous scroll
		grabCursor: true,
		freeMode: true,
		freeModeMomentum: false,
		breakpoints: {
			640: {
				slidesPerView: 2
			},
			768: {
				slidesPerView: 3
			},
			1024: {
				slidesPerView: 4
			},
		},
	});
</script>
