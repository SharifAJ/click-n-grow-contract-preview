<x-guest-layout>
    <div class="container mt-3 mb-20 max-w-5xl px-4 sm:px-6 lg:px-8">
        <!-- Page Title -->
        <div class="rounded-lg bg-gradient-to-r from-green-200 via-emerald-100 to-emerald-200 p-6 text-center shadow-lg">
            <h1 class="mt-4 text-2xl font-extrabold sm:text-4xl">{{ __('messages.aboutus_page_title') }}</h1>
            <p class="mt-2 text-base sm:text-lg">{{ __('messages.aboutus_page_sub_title') }}</p>
        </div>

        <div class="flex flex-col items-center gap-12 lg:flex-row mt-10">
            <!-- Text Content -->
            <div class="space-y-6 lg:w-1/2" data-aos="fade-right">
                <h2 class="text-2xl font-semibold text-primary sm:text-3xl">{{ __('messages.about_title') }}</h2>
                <p class="text-base font-medium text-gray-700 sm:text-lg">
                    {{ __('messages.about_description') }}
                </p>
                {{-- <p class="text-sm text-gray-600 sm:text-base">{{ $setting->about_us }}</p> --}}
                <p class="text-sm text-gray-600 sm:text-base">
                    {{ $setting['about_us_' . app()->getLocale()] ?? __('messages.default_about_us') }}
                </p>
            </div>

            <!-- Image -->
            <div class="flex justify-center lg:w-1/2" data-aos="fade-left" data-aos-delay="200">
                <img class="w-full max-w-xs sm:max-w-md rounded-lg shadow-xl"
                    src="{{ asset('images/about-us-1000x667.webp') }}" alt="Farmer using KisanSAT">
            </div>
        </div>
    </div>
</x-guest-layout>
