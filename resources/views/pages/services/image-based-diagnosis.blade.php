<x-service-layout title="{{ __('messages.image_diagnosis_title') }}" icon="📸"
    headerImgUrl="{{ asset('images/services_header_1000x500_IMAGE BASED DIAGNOSIS.png') }}"
    description="{{ __('messages.image_diagnosis_description') }}">
    <!-- How the Service Works -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.image_diagnosis_how_title') }}</h2>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.image_diagnosis_how_para_1') }}
        </p>
        <p class="mt-2 leading-relaxed text-gray-700">
            {{ __('messages.image_diagnosis_how_para_2') }}
        </p>
    </div>


    <!-- Benefits of the Service -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.image_diagnosis_benefits_title') }}</h2>
        <div class="mt-4 grid gap-x-8 gap-y-6  md:grid-cols-2">
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-bullseye" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_benefit_1_title') }}:</span>
                    {{ __('messages.image_diagnosis_benefit_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-leaf" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_benefit_2_title') }}:</span>
                    {{ __('messages.image_diagnosis_benefit_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-exclamation-triangle" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_benefit_3_title') }}:</span>
                    {{ __('messages.image_diagnosis_benefit_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-seedling" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_benefit_4_title') }}:</span>
                    {{ __('messages.image_diagnosis_benefit_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <x-icon icon="fas fa-dollar-sign" iconSize="text-lg" bgSize="w-12 h-12"></x-icon>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_benefit_5_title') }}:</span>
                    {{ __('messages.image_diagnosis_benefit_5_desc') }}</p>
            </div>
        </div>
    </div>


    <!-- Procedure to Use -->
    <div class="mt-8">
        <h2 class="text-2xl font-bold text-emerald-700">{{ __('messages.image_diagnosis_procedure_title') }}</h2>
        <div class="mt-4 space-y-4">
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">1.</span>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_step_1_title') }}:</span>
                    {{ __('messages.image_diagnosis_step_1_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">2.</span>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_step_2_title') }}:</span>
                    {{ __('messages.image_diagnosis_step_2_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">3.</span>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_step_3_title') }}:</span>
                    {{ __('messages.image_diagnosis_step_3_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">4.</span>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_step_4_title') }}:</span>
                    {{ __('messages.image_diagnosis_step_4_desc') }}</p>
            </div>
            <div class="flex items-start space-x-3">
                <span class="font-bold text-emerald-600">5.</span>
                <p><span class="font-semibold">{{ __('messages.image_diagnosis_step_5_title') }}:</span>
                    {{ __('messages.image_diagnosis_step_5_desc') }}</p>
            </div>
        </div>
    </div>


</x-service-layout>
