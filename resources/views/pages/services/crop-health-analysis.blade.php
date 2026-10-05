<x-service-layout title="{{ __('messages.crop_health_title') }}" icon="🌿"
    headerImgUrl="{{ asset('images/services_header_1000x500_Crop_Health_Analysis.png') }}"
    description="{{ __('messages.crop_health_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.crop_health_how_title') }}</h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.crop_health_how_para1') }}
        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.crop_health_how_para2') }}
        </p>
    </div>

    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.crop_health_benefit_title') }}</h2>
        <div class="mt-4 grid gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-search" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.crop_health_benefit_1_title') }}:</span>
                    {{ __('messages.crop_health_benefit_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-cogs" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.crop_health_benefit_2_title') }}:</span>
                    {{ __('messages.crop_health_benefit_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-seedling" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.crop_health_benefit_3_title') }}:</span>
                    {{ __('messages.crop_health_benefit_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-hourglass-start" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.crop_health_benefit_4_title') }}:</span>
                    {{ __('messages.crop_health_benefit_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-globe" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.crop_health_benefit_5_title') }}:</span>
                    {{ __('messages.crop_health_benefit_5_desc') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use KisanSAT -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.Use_procedure_title') }}</h2>
        <div class="mt-4 space-y-4">
            @for ($i = 1; $i <= 6; $i++)
                <div class="flex items-start space-x-3">
                    <span class="font-bold text-emerald-600">{{ $i }}.</span>
                    <p>
                        <span class="font-semibold">{{ __('messages.procedure_' . $i . '_title') }}:</span>
                        {{ __('messages.procedure_' . $i . '_desc') }}
                    </p>
                </div>
            @endfor
        </div>
    </div>

</x-service-layout>
