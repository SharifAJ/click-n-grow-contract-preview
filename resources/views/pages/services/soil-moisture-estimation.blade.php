<x-service-layout title="{{ __('messages.soil_moisture_service_title') }}" icon="💧"
    headerImgUrl="{{ asset('images/services_header_1000x500_Soil Moisture estimation SME.png') }}"
    description="{{ __('messages.soil_moisture_service_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.how_service_works') }}</h2>
        <p class="text-gray-700 mt-2 leading-relaxed">
            {{ __('messages.soil_moisture_paragraph1') }}
        </p>
        <p class="text-gray-700 mt-2 leading-relaxed">
            {{ __('messages.soil_moisture_paragraph2') }}
        </p>
    </div>

    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.benefits_of_service') }}</h2>
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 mt-4">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-seedling" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_1_title') }}</span>
                    {{ __('messages.sme_benefit_1_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-water" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_2_title') }}</span>
                    {{ __('messages.sme_benefit_2_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-chart-line" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_3_title') }}</span>
                    {{ __('messages.sme_benefit_3_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-dollar-sign" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_4_title') }}</span>
                    {{ __('messages.sme_benefit_4_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-recycle" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_5_title') }}</span>
                    {{ __('messages.sme_benefit_5_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-exclamation-triangle" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.sme_benefit_6_title') }}</span>
                    {{ __('messages.sme_benefit_6_text') }}</p>
            </div>
        </div>
    </div>

    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.sme_procedure_title') }}</h2>
        <div class="space-y-4 mt-4">
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">1.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_1_title') }}</span>
                    {{ __('messages.sme_procedure_1_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">2.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_2_title') }}</span>
                    {{ __('messages.sme_procedure_2_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">3.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_3_title') }}</span>
                    {{ __('messages.sme_procedure_3_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">4.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_4_title') }}</span>
                    {{ __('messages.sme_procedure_4_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">5.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_5_title') }}</span>
                    {{ __('messages.sme_procedure_5_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">6.</span>
                <p><span class="font-semibold">{{ __('messages.sme_procedure_6_title') }}</span>
                    {{ __('messages.sme_procedure_6_text') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
