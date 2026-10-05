<x-service-layout title="{{ __('messages.land_mapping_title') }}" icon="🗺️"
    headerImgUrl="{{ asset('images/services_header_1000x500_land area.png') }}"
    description="{{ __('messages.land_mapping_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.land_mapping_how_it_works_title') }}</h2>
        <p class="text-gray-700 mt-2 leading-relaxed">
            {{ __('messages.land_mapping_how_it_works_p1') }}
        </p>
        <p class="text-gray-700 mt-2 leading-relaxed">
            {{ __('messages.land_mapping_how_it_works_p2') }}
        </p>
    </div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.land_mapping_benefits_title') }}</h2>
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 mt-4">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-ruler" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_1_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-hourglass-start" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_2_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-mobile-alt" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_3_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-exchange-alt" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_4_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-money-bill-wave" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_5_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_5_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-file-alt" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.land_mapping_benefit_6_title') }}:</span>
                    {{ __('messages.land_mapping_benefit_6_desc') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.land_mapping_procedure_title') }}</h2>
        <div class="space-y-4 mt-4">
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">1.</span>
                <p><span class="font-semibold">{{ __('messages.land_mapping_step_1_title') }}:</span>
                    {{ __('messages.land_mapping_step_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">2.</span>
                <p><span class="font-semibold">{{ __('messages.land_mapping_step_2_title') }}:</span>
                    {{ __('messages.land_mapping_step_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">3.</span>
                <p><span class="font-semibold">{{ __('messages.land_mapping_step_3_title') }}:</span>
                    {{ __('messages.land_mapping_step_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">4.</span>
                <p><span class="font-semibold">{{ __('messages.land_mapping_step_4_title') }}:</span>
                    {{ __('messages.land_mapping_step_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">5.</span>
                <p><span class="font-semibold">{{ __('messages.land_mapping_step_5_title') }}:</span>
                    {{ __('messages.land_mapping_step_5_desc') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
