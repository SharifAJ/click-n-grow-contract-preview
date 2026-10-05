<x-service-layout title="{{ __('messages.crop_calendar_title') }}" icon="📅"
    headerImgUrl="{{ asset('/images/services_header2_1000x500.png') }}"
    description="{{ __('messages.crop_calendar_description') }}">

    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.crop_calendar_how_title') }}</h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.crop_calendar_how_para1') }}
        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.crop_calendar_how_para2') }}
        </p>
    </div>

    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.benefits_title') }}</h2>
        <div class="mt-4 grid gap-x-8 gap-y-6 md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-hourglass-start" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_1_title') }}</span>
                    {{ __('messages.benefit_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-tint" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_2_title') }}</span>
                    {{ __('messages.benefit_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-seedling" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_3_title') }}</span>
                    {{ __('messages.benefit_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-coins" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_4_title') }}</span>
                    {{ __('messages.benefit_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-cloud-sun-rain" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_5_title') }}</span>
                    {{ __('messages.benefit_5_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-recycle" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.benefit_6_title') }}</span>
                    {{ __('messages.benefit_6_desc') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.procedure_title') }}</h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">1.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step1_title') }}</span>
                    {{ __('messages.procedure_step1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">2.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step2_title') }}</span>
                    {{ __('messages.procedure_step2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">3.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step3_title') }}</span>
                    {{ __('messages.procedure_step3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">4.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step4_title') }}</span>
                    {{ __('messages.procedure_step4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">5.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step5_title') }}</span>
                    {{ __('messages.procedure_step5_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">6.</span>
                <p><span class="font-semibold">{{ __('messages.procedure_step6_title') }}</span>
                    {{ __('messages.procedure_step6_desc') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
