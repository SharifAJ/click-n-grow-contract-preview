<x-service-layout title="{{ __('messages.irrigation_service_title') }}" icon="💧"
    headerImgUrl="{{ asset('images/services_header_1000x500_soil moisture.png') }}"
    description="{{ __('messages.irrigation_service_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.how_service_works') }}</h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.irrigation_service_paragraph1') }}
        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.irrigation_service_paragraph2') }}
        </p>
    </div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.benefits_of_service') }}</h2>
        <div class="mt-4 grid gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-tint" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.irrigation_benefit1_title') }}:</span>
                    {{ __('messages.irrigation_benefit1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-seedling" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.irrigation_benefit2_title') }}:</span>
                    {{ __('messages.irrigation_benefit2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-dollar-sign" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.irrigation_benefit3_title') }}:</span>
                    {{ __('messages.irrigation_benefit3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-globe" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.irrigation_benefit4_title') }}:</span>
                    {{ __('messages.irrigation_benefit4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-calendar-alt" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.irrigation_benefit5_title') }}:</span>
                    {{ __('messages.irrigation_benefit5_desc') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.irrigation_procedure_to_use') }}</h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">1.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure1_title') }}:</span>
                    {{ __('messages.irrigation_procedure1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">2.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure2_title') }}:</span>
                    {{ __('messages.irrigation_procedure2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">3.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure3_title') }}:</span>
                    {{ __('messages.irrigation_procedure3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">4.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure4_title') }}:</span>
                    {{ __('messages.irrigation_procedure4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">5.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure5_title') }}:</span>
                    {{ __('messages.irrigation_procedure5_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">6.</span>
                <p><span class="font-semibold">{{ __('messages.irrigation_procedure6_title') }}:</span>
                    {{ __('messages.irrigation_procedure6_desc') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
