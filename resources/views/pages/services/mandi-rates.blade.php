<x-service-layout title="{{ __('messages.mandi_rates_title') }}" icon="📊"
    headerImgUrl="{{ asset('images/services_header_1000x500_mandi rates.png') }}"
    description="{{ __('messages.mandi_rates_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.mandi_rates_how_it_works_title') }}</h2>
        <p class="text-gray-700 mt-2 leading-relaxed">
            {{ __('messages.mandi_rates_how_it_works_para1') }}
        </p>
    </div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.mandi_rates_benefits_title') }}</h2>
        <div class="grid md:grid-cols-2 gap-x-8 gap-y-6 mt-4">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-search" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.transparency') }}:</span>
                    {{ __('messages.transparency_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-chart-line" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.market_awareness') }}:</span>
                    {{ __('messages.market_awareness_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-wallet" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.better_bargaining') }}:</span>
                    {{ __('messages.better_bargaining_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-chart-bar" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.profit_maximization') }}:</span>
                    {{ __('messages.profit_maximization_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-shield-alt" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.reduced_exploitation') }}:</span>
                    {{ __('messages.reduced_exploitation_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-chart-pie" iconSize="text-lg" bgSize="w-12 h-12" />
                <p><span class="font-semibold">{{ __('messages.economic_growth') }}:</span>
                    {{ __('messages.economic_growth_text') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.procedure_to_use') }}</h2>
        <div class="space-y-4 mt-4">
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">1.</span>
                <p><span class="font-semibold">{{ __('messages.access_service') }}:</span>
                    {{ __('messages.access_service_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">2.</span>
                <p><span class="font-semibold">{{ __('messages.select_commodity_location') }}:</span>
                    {{ __('messages.select_commodity_location_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">3.</span>
                <p><span class="font-semibold">{{ __('messages.analyze_market_trends') }}:</span>
                    {{ __('messages.analyze_market_trends_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">4.</span>
                <p><span class="font-semibold">{{ __('messages.make_informed_decisions') }}:</span>
                    {{ __('messages.make_informed_decisions_text') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="text-emerald-600 font-bold">5.</span>
                <p><span class="font-semibold">{{ __('messages.stay_updated') }}:</span>
                    {{ __('messages.stay_updated_text') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
