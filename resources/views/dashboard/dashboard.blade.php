<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>



    <div class="container mx-auto">


        {{-- ================== For header title ==================== --}}
        <div class="pb-3">
            <div class="max-w-10xl mx-auto">
                <div class="white:bg-gray-800 overflow-hidden bg-white font-semibold shadow-sm sm:rounded-lg">
                    <div class="p-6 text-xl text-gray-900 dark:text-gray-800">
                        {{ __('Key Statistics') }}
                    </div>
                </div>
            </div>
        </div>

        {{-- ================== For Key Statistics ==================== --}}
        <div class="mt-5 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Active Farmers: {{ $active_farmer }} | InActive Farmers: {{ $inactive_farmer }}
                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8" style="position: relative;top: 7px;">
                        <img src="{{ url('/images/card_1.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold text-larg">{{ $total_farmer }}</p>
                        <p class=" text-lg font-semibold">Farmers</p>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Paid Farms: {{ $paid_farms }} | Unpaid Farms: {{ $unpaid_farms }}
                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="mt-5 flex flex-col items-center justify-center  mr-8">
                        <img src="{{ url('/images/card_2.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold">{{ $total_farms }}</p>
                        <p class="text-lg font-semibold">Farms</p>
                    </div>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Paid Farms Area: {{ number_format($paid_area_farms, 1) }} | Unpaid Farms Area:
                    {{ number_format($unpaid_area_farms, 1) }}
                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8" style="position: relative;top: 16px;">
                        <img src="{{ url('/images/card_3.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold">{{ number_format($farms_area, 1) }}</p>
                        <p class=" text-lg font-semibold">Farms Area (Acres)</p>
                    </div>
                </div>
            </div>

        </div>
        {{-- ================== For Key Statistics ==================== --}}
        <div class="mt-6 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3">


            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Soil Nutrient Analysis: {{ $premium_service_1 }} | Image-Based Diagnosis:
                    {{ $premium_service_2 }}
                </span>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-center justify-center mr-8" style="position: relative;top: 6px;">
                        <img src="{{ url('/images/card_6.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-15  flex items-center justify-center" style="    align-items: end;">
                        <p class="text-3xl font-extrabold">{{ $total_service }}</p>
                    </div>
                </div>
                <div class="  flex items-center justify-center">
                    <p class="text-lg font-semibold">Total Service Purchased</p>
                </div>
            </div>
            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block">
                    Gold Package: {{ $gold_service }} | Silver Package:
                    {{ $silver_service }} | Basic Package:
                    {{ $basic_service }}
                </span>
                <div class="grid grid-cols-2 gap-6">
                    <div class="flex items-center justify-center mr-8" style="position: relative;top: 6px;">
                        <img src="{{ url('/images/card_7.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-15  flex items-center justify-center" style="    align-items: end;">
                        <p class="text-3xl font-extrabold">{{ $total_package }}</p>
                    </div>
                </div>
                <div class="  flex items-center justify-center">
                    <p class="text-lg font-semibold">Total Package Purchased</p>
                </div>
            </div>

            <div
                class="relative flex flex-col items-center justify-center rounded-lg bg-white shadow-lg transition hover:shadow-xl py-10 group">
                <span
                    class="absolute bottom-full mb-1 hidden w-auto rounded bg-gray-900 px-3 py-1 text-sm text-white shadow-lg group-hover:block text-center">
                    Mobile Payments: {{ number_format($moblie_rec_amt, 2) }} | Admin Payments:
                    {{ number_format($admin_rec_amt, 2) }}
                </span>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-2">
                    <div class="flex flex-col items-center justify-center  mr-8">
                        <img src="{{ url('/images/card_8.png') }}" alt="Farmer Img" class="h-20 w-20">
                    </div>
                    <div class="mt-8 flex flex-col items-center justify-center  ">
                        <p class="text-3xl font-extrabold">{{ number_format($total_rec_amt, 2) }}</p>
                        <p class="text-lg font-semibold">Received Amount</p>
                    </div>
                </div>
            </div>
        </div>


    </div>
</x-app-layout>


