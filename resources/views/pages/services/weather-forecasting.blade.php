<x-service-layout title="{{ __('messages.weather_forecast_title') }}" icon="🌤️"
    headerImgUrl="{{ asset('images/services_header_1000x500_Weather Forecast.png') }}"
    description="{{ __('messages.weather_forecast_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.weather_forecast_how_title') }}</h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.weather_forecast_how_para1') }}
        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.weather_forecast_how_para2') }}
        </p>
    </div>



    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.weather_forecast_benefits_title') }}</h2>
        <div class="mt-4 grid gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-calendar-alt" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.weather_forecast_benefit1_title') }}</span>
                    {{ __('messages.weather_forecast_benefit1_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-bug" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.weather_forecast_benefit2_title') }}</span>
                    {{ __('messages.weather_forecast_benefit2_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-tint" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.weather_forecast_benefit3_title') }}</span>
                    {{ __('messages.weather_forecast_benefit3_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-exclamation-triangle" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.weather_forecast_benefit4_title') }}</span>
                    {{ __('messages.weather_forecast_benefit4_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-coins" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.weather_forecast_benefit5_title') }}</span>
                    {{ __('messages.weather_forecast_benefit5_text') }}</p>
            </div>
        </div>
    </div>

    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.weather_forecast_procedure_title') }}</h2>
        <div class="mt-4 space-y-4">
            @for ($i = 1; $i <= 6; $i++)
                <div class="flex items-start space-x-3">
                    <span class="font-bold text-emerald-600">{{ $i }}.</span>
                    <p><span
                            class="font-semibold">{{ __('messages.weather_forecast_procedure' . $i . '_title') }}</span>
                        {{ __('messages.weather_forecast_procedure' . $i . '_text') }}</p>
                </div>
            @endfor
        </div>
    </div>


</x-service-layout>
