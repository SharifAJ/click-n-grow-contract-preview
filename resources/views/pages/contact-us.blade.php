<x-guest-layout>
    <div class="container mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">
        <x-page-header title="{{ __('messages.getin_touch_title') }}"
            subTitle="{{ __('messages.getin_touch_subtitle') }}" />
        <!-- Contact Grid -->
        <div class="mt-14 grid gap-6 sm:gap-6 md:grid-cols-2 lg:grid-cols-3">
            <!-- Address Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:py-8 sm:ps-8 sm:pe-4">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-map-marker-alt text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl">{{ __('messages.getin_Office') }}</h3>
                <address class="mt-3 text-base not-italic text-gray-600 sm:mt-4">
                    {{-- eKisanZone, <br>
                    C/17-18, Dakshata Nagar Complex,<br>
                    Sindhi Camp, Opp SP Office, Akola,<br>
                    Maharashtra, India - 444001 --}}

                    {{ $setting->company_address }}
                </address>
            </div>

            <!-- Contact Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:p-8">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-phone-alt fa-flip-horizontal text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl">{{ __('messages.getin_PhoneNumbers') }}</h3>
                <div class="mt-4 space-y-2 sm:mt-6 sm:space-y-3">
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 sm:gap-3" href="tel:+919096248660">
                            <i class="fas fa-phone-alt fa-flip-horizontal"></i>
                            +91-90962-48660
                        </a>
                    </p>
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 sm:gap-3" href="tel:+917775008660">
                            <i class="fas fa-phone-alt fa-flip-horizontal"></i>
                            +91-77750-08660
                        </a>
                    </p>
                </div>
            </div>

            <!-- Email & Social Card -->
            <div class="rounded-xl bg-white p-6 shadow-md sm:p-8">
                <div
                    class="mb-4 inline-flex h-14 w-14 items-center justify-center rounded-full bg-emerald-100 sm:mb-6 sm:h-16 sm:w-16">
                    <i class="fas fa-globe text-xl text-emerald-600 sm:text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 sm:text-2xl">{{ __('messages.getin_DigitalChannels') }}
                </h3>
                <div class="mt-4 space-y-3 sm:mt-6">
                    <p class="text-base text-gray-600 hover:text-emerald-600 sm:text-lg">
                        <a class="flex items-center gap-2 text-lg sm:gap-3" href="mailto:info.kisansat@gmail.com">
                            <i class="fas fa-envelope"></i>
                            info.kisansat@gmail.com
                        </a>
                    </p>
                    <!-- Social Media Links -->
                    <div class="mt-4 flex justify-center space-x-4 md:justify-start">
                        <a class="hover:text-emerald-600" href="https://www.facebook.com/profile.php?id=100093467838017"
                            target="_blank">
                            <i class="fa-brands fa-facebook text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600" href="https://x.com/kisan_sat" target="_blank">
                            <i class="fa-brands fa-twitter text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600" href="https://www.instagram.com/kisansat/?hl=en"
                            target="_blank">
                            <i class="fa-brands fa-instagram text-2xl"></i>
                        </a>
                        <a class="hover:text-emerald-600"
                            href="https://youtube.com/@kisansat-smartfarmingsolutions?si=VTdyMUe24CWK77aJ"
                            target="_blank">
                            <i class="fa-brands fa-youtube text-2xl"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="mt-12 rounded-2xl bg-white p-6 shadow-xl sm:mt-16 sm:p-8 md:p-12">
            <h2 class="mb-6 text-center text-2xl font-bold text-gray-800 sm:mb-8 sm:text-3xl">
                {{ __('messages.getin_ContactUs') }}</h2>
            <form class="mx-auto max-w-xl space-y-4 sm:space-y-6" method="POST"
                action="{{ route('contact-us.store') }}">
                @csrf
                <div class="grid gap-4 sm:gap-6 md:grid-cols-2">
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">{{ __('messages.getin_FullName') }}<span
                                class="text-red-500">*</span></label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="name" type="text" value="{{ old('name') }}"
                            placeholder="{{ __('messages.getin_Name_label') }}" required>

                        @error('name')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">{{ __('messages.getin_Email') }}
                            <span class="text-red-500">*</span>
                        </label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="email" type="email" value="{{ old('email') }}" placeholder="example@gmail.com"
                            required>

                        @error('email')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid gap-4 sm:gap-6 md:grid-cols-2">
                    <div>
                        <label
                            class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">{{ __('messages.getin_Mobile') }}<span
                                class="text-red-500">*</span></label>

                        <input class="input input-bordered w-full" name="mobile" type="tel"
                            value="{{ old('mobile') }}" pattern="[0-9]{10}" oninput="validateMobile(this)"
                            maxlength="10" placeholder="{{ __('messages.getin_Name_mobilenumber_label') }}" required>
                        @error('mobile')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">
                            {{ __('messages.getin_Address') }}</label>
                        <input
                            class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                            name="address" type="text" value="{{ old('address') }}"
                            placeholder="{{ __('messages.getin_Name_address_label') }}">
                        @error('address')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <div>
                    <label
                        class="mb-1 block text-base font-medium text-gray-700 sm:mb-2 sm:text-lg">{{ __('messages.getin_Message') }}</label>
                    <textarea
                        class="w-full rounded-lg border border-gray-300 px-4 py-3 focus:border-transparent focus:ring-2 focus:ring-emerald-500"
                        name="message" rows="5" placeholder="{{ __('messages.getin_Name_helpyou_label') }}">{{ old('message') }}</textarea>

                    @error('message')
                        <span class="text-sm text-red-500">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex">
                    <button
                        class="m-auto rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-md transition-colors duration-300 hover:bg-emerald-700 sm:px-8 sm:py-4 sm:text-lg"
                        type="submit">
                        {{ __('messages.getin_SendMessage') }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Map Section -->
        <div class="mt-12 overflow-hidden rounded-2xl shadow-xl sm:mt-16">
            <iframe class="rounded-2xl"
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3732.259603507598!2d77.01349417470568!3d20.699680199001012!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bd72ff7f7e2c3c1%3A0x2d52bc3d17e08b6a!2seKisanZone!5e0!3m2!1sen!2sin!4v1742639229434!5m2!1sen!2sin"
                style="border:0;" width="100%" height="450" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <!-- CTA Section -->
        <div class="mt-12 text-center sm:mt-16">
            <h3 class="mb-4 text-xl font-bold text-gray-800 sm:mb-6 sm:text-2xl">
                {{ __('messages.getin_JoinThousands') }}</h3>
            <a class="inline-flex items-center justify-center rounded-lg bg-emerald-600 px-6 py-3 text-base font-semibold text-white shadow-lg transition-all duration-300 hover:bg-emerald-700 hover:shadow-xl sm:px-8 sm:py-4 sm:text-lg"
                href="{{ env('ANDROID_APP_LINK') }}" target="_blank">
                <i class="fas fa-download mr-2 sm:mr-3"></i>
                {{ __('messages.getin_Download') }}
            </a>
            <p class="mt-3 text-sm text-gray-600 sm:mt-4 sm:text-base"> {{ __('messages.getin_AndriodPlaystore') }}
            </p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        function validateMobile(input) {
            input.value = input.value.replace(/\D/g, '').slice(0, 10);
        }



        document.addEventListener('DOMContentLoaded', function() {
            @if (session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: "{{ session('success') }}",
                    timer: 7000, // Auto close after 3 seconds
                    showConfirmButton: false
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: "{{ session('error') }}",
                    timer: 7000,
                    showConfirmButton: false
                });
            @endif
        });
    </script>

</x-guest-layout>
