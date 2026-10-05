<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- for using_map  --}}
    {{-- <link href="https://unpkg.com/leaflet/dist/leaflet.css" rel="stylesheet" />
    <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script> --}}

    <!-- Add Leaflet CSS -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

    <!-- Add Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>


    <!-- Link Swiper's CSS -->
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />


    <style>
        .carousel {
            background: #EEE;
        }

        .carousel-cell {
            width: 66%;
            height: 200px;
            margin-right: 10px;
            background: #8C8;
            border-radius: 5px;
            counter-increment: gallery-cell;
        }

        /* cell number */
        .carousel-cell:before {
            display: block;
            text-align: center;
            content: counter(gallery-cell);
            line-height: 200px;
            font-size: 80px;
            color: white;
        }

        .carousel-container .prev,
        .carousel-container .next {
            position: absolute;
            bottom: 0px;
            /* Move buttons to the bottom */
            left: 1px;
            /* Move to left corner */
            z-index: 9999;
            /* Ensure it's on top */
            pointer-events: auto !important;
            background-color: rgba(0, 0, 0, 0.6);
            /* Slightly transparent background */
            color: white;
            /* Button color */
            padding: 10px 15px;
            border-radius: 50%;
            /* Circular button */
        }

        .carousel-container .next {
            left: 50px;
            /* Adjust the next button position slightly */
        }


        .loader {
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #3498db;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .custom-swal-button {
            background-color: #33772f !important;
            color: white !important;
        }


        /* ======================for map================= */
        .leaflet-bottom {
            display: none !important;
        }

        #map {
            width: 100% !important;
            height: 100% !important;
            min-height: 600px;
            max-height: 1000px;
        }

        #content {
            width: 100% !important;
            display: flex;
            flex-direction: column;
        }

        /* ======================end for map================= */


        select[name="mandi_rate_table_length"] {
            width: 60px !important;
        }


        /* for loader */
        /* HTML: <div class="loader"></div> */
        .mandiratesloader {
            width: fit-content;
            font-weight: bold;
            font-family: monospace;
            font-size: 25px;
            /* clip-path: inset(0 100% 0 0); */
            /* animation: l5 2s steps(11) infinite; */
        }

        .mandiratesloader:before {
            content: "Loading..."
        }

        @keyframes l5 {
            to {
                clip-path: inset(0 -1ch 0 0)
            }
        }
    </style>
    {{-- ================== Farm monitoring header title==================== --}}

    {{--
    1. Weather 
    2. Crop Calendar
    3. Pest and Disease
    4. Irrigation data
    5. Image Advisory Info
    6. Satellite data
    7. Soil Report 
    --}}

    {{-- ==================end  Farm monitoring header title ==================== --}}


    <div class="container mx-auto">


        {{-- ================== For header title ==================== --}}
        <div class="pb-3">
            <div class="max-w-10xl mx-auto">
                <div class="white:bg-gray-800 overflow-hidden bg-white font-semibold shadow-sm sm:rounded-lg">
                    <div class="p-6 text-xl text-gray-900 dark:text-gray-800">
                        {{ __('Farm Monitoring') }}
                    </div>
                </div>
            </div>
        </div>


        {{-- ================== For Key Statistics ==================== --}}
        <div class="mt-5 grid grid-cols-1 gap-6 sm:grid-cols-2 md:grid-cols-4 lg:grid-cols-4">
            <!-- Sidebar -->
            {{-- <div class="w-50 h-screen bg-gray-400 text-white p-6">
                <ul id="sidebar" class="menu bg-gray-500 rounded-box">
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="#">Locations</a></li>
                    <li><a href="#">Reports</a></li>
                    <li><a href="#">Settings</a></li>
                </ul>
            </div> --}}



            {{-- for accordion  code   far details --}}

            <div class="col-span-12 flex-grow" id="content">
                {{-- ================== For header title ==================== --}}
                {{-- <div class="pb-3">
                    <div class="max-w-10xl mx-auto">
                        <div class="overflow-hidden bg-gray-200 font-semibold shadow-sm sm:rounded-lg">
                            <div class="p-3 text-center text-3xl font-bold text-gray-700">
                                {{ __('Farm Detail') }}
                            </div>
                        </div>
                    </div>
                </div> --}}


                <div class="flex flex-wrap gap-4  bg-gray-100 rounded-lg">
                    @php
                        $latitude = $farm->center[0] ?? null;
                        $longitude = $farm->center[1] ?? null;
                    @endphp
                    <!-- Farm Details Card -->
                    <div class="w-1/1 bg-white p-4 shadow rounded-lg">
                        <p><b>Farm ID :</b> <span class="ps-3">{{ $farm->farm_id }}</span></p>
                        <p><b>Farmer Name :</b> <span class="ps-3">{{ $farm->user->name }}</span></p>
                        <p><b>Farm Name :</b> <span class="ps-3">{{ $farm->name }}</span></p>
                        <p><b>Crop Name :</b> <span class="ps-3">{{ $farm->croptype }}</span></p>
                        <p><b>Sowing Date :</b> <span
                                class="ps-3">{{ date('d-M-Y', strtotime($farm->sowingdate)) }}</span></p>
                        <p><b>District :</b> <span class="ps-3">{{ $farm->district }}</span></p>
                        <p><b>State :</b> <span class="ps-3">{{ $farm->state }}</span></p>
                        <p><b>Area :</b> <span class="ps-3"> </span>{{ floor($farm->area * 10) / 10}} acres</p>
                        @if ($farm->status === 'Unpaid')
                            <p><b>Status :</b> <span class="ps-3 text-red-500">Farm is not premium</span></p>
                        @else
                            <p><b>Status :</b> <span class="ps-3 text-green-500">Farm is premium</span></p>
                        @endif
                    </div>
                </div>

            </div>
            {{-- for accordion  code   01 Map --}}

            <div class="col-span-12 flex-grow" id="content">
                {{-- ================== For header title ==================== --}}
                <div class="pb-3">
                    <div class="max-w-10xl mx-auto">
                        <div class="overflow-hidden bg-gray-200 font-semibold shadow-sm sm:rounded-lg">
                            <div class="p-3 text-center text-3xl font-bold text-gray-700">
                                {{ __('Free Services') }}
                            </div>
                        </div>
                    </div>
                </div>


                <div class="collapse collapse-arrow border border-gray-300 bg-white p-4">
                    <input id="accordion-01" type="checkbox">
                    {{-- <input id="accordion-01" type="checkbox" checked> --}}
                    {{-- <input type="checkbox" id="accordion-01"> --}}
                    <label class="collapse-title text-lg font-medium" for="accordion-01">
                        Land Area Mapping
                    </label>
                    <div class="collapse-content">

                        <!-- Map Container -->
                        <div class="mb-6 max-h-[1000px] min-h-[600px] w-full rounded-lg border border-gray-300 shadow-md"
                            id="map">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-span-12 flex-grow" id="content">



                <!-- Accordion  2  Mandi Rates-->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-02" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-02">
                        Mandi Rates
                    </label>
                    <div class="collapse-content">
                        <div class="flex flex-wrap gap-4 p-4 bg-gray-100 rounded-lg">
                            <!-- State Dropdown -->
                            <div class="w-1/5">
                                <label class="block text-sm font-medium text-gray-700">State</label>
                                <input type="text" id="state_option" class="input input-bordered w-full"
                                    value="{{ $farm_state }}">
                                {{-- <select class="select select-bordered w-full" id="state_option"
                                    onchange="get_city_list()">
                                    <option value="{{ $farm_state }}" selected>{{ $farm_state ?? 'Select State' }}
                                    </option>
                                    @foreach ($states as $state)
                                        @if ($farm_state != $state->state)
                                            <option value="{{ $state->state }}">{{ $state->state }}</option>
                                        @endif
                                    @endforeach
                                </select> --}}
                            </div>

                            <!-- District Dropdown -->
                            <div class="w-1/5">
                                <label class="block text-sm font-medium text-gray-700">District</label>
                                <input type="text" id="district_option" class="input input-bordered w-full"
                                    value="{{ $farm_dis }}">

                                {{-- <select class="select select-bordered w-full h-25" id="district_option"
                                    style="height: 200px !important;">
                                    <option value="{{ $farm_dis }}" selected>{{ $farm_dis ?? 'Select District' }}
                                    </option>
                                    @foreach ($all_districtes as $all_district)
                                        @if ($farm_dis != $all_district->city)
                                            <option value="{{ $all_district->city }}">{{ $all_district->city }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select> --}}
                            </div>


                            @php
                                $date = date('Y-m-d'); // Ensure correct date format
                            @endphp

                            <!-- From Date -->
                            {{-- <div class="w-1/5">
                                <label class="block text-sm font-medium text-gray-700">From Date</label>
                                <input type="date" id="fromDate" class="input input-bordered w-full"
                                    value="{{ old('fromDate', $date) }}">
                            </div> --}}

                            <!-- To Date -->
                            {{-- <div class="w-1/5">
                                <label class="block text-sm font-medium text-gray-700">To Date</label>
                                <input type="date" id="toDate" class="input input-bordered w-full"
                                    value="{{ old('toDate', $date) }}">
                            </div> --}}

                            <!-- Search Button -->
                            <div class="w-1/7 flex items-end">
                                <button class="btn btn-primary w-full" onclick="getmandirates_inputs_data()"
                                    id="searchBtn">Search</button>
                            </div>
                            <!-- Reset Button -->
                            {{-- <div class="w-1/7 flex items-end">
                                <button class="btn btn-info w-full" onclick="resetmandirates_inputs_data()"
                                    id="searchBtn">Reset</button>
                            </div> --}}
                        </div>

                        <table class="table w-full min-w-[800px] mt-5" id="mandi_rate_table">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border p-2">#</th>
                                    <th class="border p-2">State</th>
                                    <th class="border p-2">District</th>
                                    <th class="border p-2">Market</th>
                                    <th class="border p-2">Crop Name</th>
                                    <th class="border p-2">Variety</th>
                                    <th class="border p-2">Arrival Date</th>
                                    <th class="border p-2">Min Price</th>
                                    <th class="border p-2">Max Price</th>
                                    <th class="border p-2">Average Price</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>


                    </div>
                </div>

                {{-- ================== For header title ==================== --}}
                <div class="mt-9 pb-3">
                    <div class="max-w-10xl mx-auto">
                        <div class="overflow-hidden bg-gray-200 font-semibold shadow-sm sm:rounded-lg">
                            <div class="p-3 text-center text-3xl font-bold text-gray-700">
                                {{ __('Premium Services') }}
                            </div>
                        </div>
                    </div>
                </div>

                {{-- for accordion  code   1 wheather --}}

                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-1" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-1">
                        Weather Forecasting
                    </label>
                    <div class="collapse-content">

                        @if (!empty($today_wheather_data))
                            <p class="">
                                Date as at: {{ date('d-m-Y', strtotime($latest_updated_at)) }}
                            </p>
                            <div class="grid grid-cols-1 gap-4 lg:flex">
                                <!-- First Section (Smaller Card) -->
                                @if (!empty($today_wheather_data))
                                    <div class="relative h-[340px] min-h-[340px]   rounded-lg bg-cover bg-center p-6 text-white  lg:w-2/5"
                                        style="background-image: url('{{ asset('images/weather_forecast_dashboard_bg.webp') }}'); background-size: 100% 109%;">

                                        <!-- Top Right (Temperature & Date) -->
                                        <div class="absolute right-2 top-2 w-auto max-w-xs rounded-lg p-3 text-center">
                                            @php
                                                $temperature = json_decode(
                                                    trim($today_wheather_data->temperature, '"'),
                                                    true,
                                                );
                                            @endphp

                                            <p class="text-2xl font-extrabold">
                                                {{ $temperature[1] ?? 'N/A' }}°C /
                                                {{ $temperature[0] ?? 'N/A' }}°C
                                            </p>


                                            <p class="text-3xl font-extrabold">
                                                {{ \Carbon\Carbon::parse($today_wheather_data->sunrise_time_local)->format('d-m-y') }}
                                            </p>
                                            <p class="text-lg">
                                                {{ $today_wheather_data->narrative }}
                                            </p>

                                        </div>
                                        <!-- Weather Conditions Box -->
                                        <div
                                            class="absolute bottom-4 left-4 inline-block w-auto max-w-xs rounded-lg bg-white bg-opacity-60 p-4 shadow-lg">

                                            <p class="text-md text-blue-500">Humidity:
                                                {{ $today_wheather_data->relative_humidity }}%</p>
                                            <p class="text-md text-blue-500">Wind Speed:
                                                {{ $today_wheather_data->wind_speed }}
                                                km/h</p>
                                            <p class="text-md text-blue-500">Cloud Cover:
                                                {{ $today_wheather_data->cloud_cover }}%
                                            </p>
                                            <p class="text-md text-blue-500">Precip Type:
                                                {{ $today_wheather_data->precip_type }}
                                            </p>
                                            <p class="text-md text-blue-500">Precip Chance:
                                                {{ $today_wheather_data->precip_chance }}%</p>
                                        </div>

                                    </div>
                                @else
                                    <p class="text-red-500">No weather data available for today.</p>
                                @endif


                                <!-- Second Section (Takes More Space) -->
                                @if (!empty($all_weather_data))
                                    <div class="lg:w-3/5">
                                        <!-- Header with Title & Info Icon -->
                                        <div class="mb-4 flex items-center justify-between">
                                            <p class="text-lg font-semibold">Weather data for next 14 days</p>
                                            <i class="fa fa-info-circle"
                                                style="font-size:30px; color:#33772f; cursor:pointer;"
                                                onclick="showDisclaimer()"></i>
                                        </div>

                                        <!-- Weather Cards Grid -->
                                        <div class="grid grid-cols-2 gap-4 md:grid-cols-4 lg:grid-cols-7">
                                            @foreach ($all_weather_data as $index => $day)
                                                @if ($index == 0)
                                                    @continue
                                                @endif

                                                @php
                                                    // Date Format
                                                    $date = \Carbon\Carbon::parse($day->sunrise_time_local)->format(
                                                        'd/m',
                                                    );

                                                    // Temperature Handling
                                                    $temperature = json_decode(trim($day->temperature, '"'), true);
                                                    $minTemp = isset($temperature[1])
                                                        ? number_format($temperature[1], 1)
                                                        : 'N/A';
                                                    $maxTemp = isset($temperature[0])
                                                        ? number_format($temperature[0], 1)
                                                        : 'N/A';

                                                    // Use only thunder_category for Weather Condition
                                                    $condition = strtolower($day->thunder_category ?? 'cloudy');

                                                    // Mapping thunder_category to Icons
                                                    $weather_icons = [
                                                        'clear' => 'sunny.png',
                                                        'partly cloudy' => 'partly_cloudy.png',
                                                        'cloudy' => 'cloudy.png',
                                                        'rain' => 'rainy.png',
                                                        'storm' => 'storm.png',
                                                        'snow' => 'snowflake.png',
                                                        'wind' => 'windy.png',
                                                        'fog' => 'fog.png',
                                                    ];

                                                    // Default Icon
                                                    $weather_icon = 'cloudy.png';
                                                    foreach ($weather_icons as $key => $icon) {
                                                        if (strpos($condition, $key) !== false) {
                                                            $weather_icon = $icon;
                                                            break;
                                                        }
                                                    }

                                                    $weather_icon_path = asset('images/' . $weather_icon);
                                                @endphp

                                                <!-- Weather Card -->
                                                <div
                                                    class="card h-full   rounded-lg bg-blue-50 p-3 text-center transition-transform duration-300 hover:scale-105 hover:shadow-lg hover:shadow-gray-600">
                                                    <h3 class="my-1 text-xs font-semibold">
                                                        {{ $date }}</h3>
                                                    {{-- <img src="{{ $weather_icon_path }}" alt="Icon" class="w-10 mx-auto my-3"> --}}
                                                    <p class="my-3 text-xs font-bold">{{ $minTemp }}°C /
                                                        {{ $maxTemp }}°C</p>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                @else
                                    <p class="font-bold text-red-500">Weather data not available.</p>
                                @endif

                            </div>



                            <div class="mt-9 grid grid-cols-1 gap-4 lg:grid-cols-2">
                                <!-- First Chart Section -->
                                <div class="bg-white p-4 flex justify-center items-center">
                                    <canvas id="myChart1" class="w-full h-auto max-w-full"></canvas>
                                </div>

                                <!-- Second Chart Section -->
                                <div class="flex items-center justify-center bg-white p-4">
                                    <canvas class="h-auto w-full max-w-full" id="myChart2"></canvas>
                                </div>
                            </div>
                        @else
                            <p class="text-left text-red-500">No weather data available.</p>
                        @endif
                    </div>
                </div>


                <!-- Accordion Item 3 Soil Nutrient Analysis -->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-3" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-3">
                        Soil Nutrient Analysis
                    </label>
                    <div class="collapse-content relative">
                        <div class="top-30 absolute right-24 flex items-center justify-between">
                            <p class="text-lg font-semibold"></p>
                            <i class="fa fa-info-circle" style="font-size:30px; color:#33772f; cursor:pointer;"
                                onclick="show_Soil_Nutrient_Disclaimer()"></i>
                        </div>

                        @if (!empty($soil_repo_data))
                            <!-- Loader Spinner -->
                            <div class="absolute inset-0 flex items-center justify-center bg-gray-100" id="pdfLoader">
                                <div
                                    class="loader h-10 w-10 animate-spin rounded-full border-t-4 border-solid border-blue-500">
                                </div>
                            </div>

                            <!-- PDF Iframe -->
                            <iframe class="mt-9 hidden" id="pdfIframe" src="{{ $soil_repo_data }}"
                                style="border: none;" width="100%" height="700px"
                                onload="document.getElementById('pdfLoader').style.display='none'; this.style.display='block';">
                            </iframe>
                        @else
                            <p class="text-red-500">Soil report PDF not available.</p>
                        @endif

                    </div>
                </div>


                <!-- Accordion  4 Pest and Disease-->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-4" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-4">Pest and Disease
                        Forewarning</label>
                    <div class="collapse-content">
                        <div class="mb-14 w-full p-7" x-data="{ openTab: 1, activeClasses: 'text-primary border-primary', inactiveClasses: 'border-transparent' }">
                            <div class="border-stroke mb-6 flex flex-wrap gap-5 border-b sm:gap-10">
                                <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base"
                                    href="#" @click.prevent="openTab = 1"
                                    :class="openTab === 1 ? activeClasses : inactiveClasses">Disease</a>
                                <a class="border-b-2 py-4 text-sm font-medium hover:text-primary md:text-base"
                                    href="#" @click.prevent="openTab = 2"
                                    :class="openTab === 2 ? activeClasses : inactiveClasses">Pest</a>

                                <div class="top-30 absolute right-24 flex items-center justify-between">
                                    <p class="text-lg font-semibold"></p>
                                    <i class="fa fa-info-circle"
                                        style="font-size:30px; color:#33772f; cursor:pointer;"
                                        onclick="show_Pest_Diseas_Disclaimer()"></i>
                                </div>
                            </div>

                            <div class="w-full">
                                <div class="h-[700px] overflow-auto bg-white p-5" x-show="openTab === 1">
                                    @if ($deas_data->count() > 0)

                                        @foreach ($deas_data as $key => $data)
                                            <div
                                                class="mx-auto my-9 max-w-4xl overflow-hidden rounded-lg border border-gray-300 bg-white shadow-lg">

                                                @php
                                                    if (is_string($data->disease_img_urls)) {
                                                        $imageUrls = json_decode($data->disease_img_urls, true);
                                                    } elseif (is_array($data->disease_img_urls)) {
                                                        $imageUrls = $data->disease_img_urls;
                                                    } else {
                                                        $imageUrls = [];
                                                    }
                                                @endphp

                                                @if (!empty($imageUrls))
                                                    <!-- Image Carousel -->
                                                    <div class="relative h-[300px] overflow-hidden p-5">
                                                        <div class="carousel-container relative h-full w-full"
                                                            id="carousel-{{ $data->id }}">
                                                            @foreach ($imageUrls as $index => $img)
                                                                {{-- <a data-fancybox="gallery-{{ $data->id }}"
                                                                    href="{{ $img }}"
                                                                    data-caption="Image {{ $index + 1 }}"
                                                                    target="_blank" style="pointer-events: auto;"> --}}
                                                                <div class="{{ $index === 0 ? 'opacity-100' : 'opacity-0' }} carousel-item absolute left-0 top-0 h-full w-full transition-opacity duration-700"
                                                                    data-index="{{ $index }}">

                                                                    <!-- Loader Spinner -->
                                                                    <div
                                                                        class="image-loader absolute inset-0 flex items-center justify-center bg-gray-200">
                                                                        <div
                                                                            class="loader h-10 w-10 animate-spin rounded-full border-t-4 border-solid border-blue-500">
                                                                        </div>
                                                                    </div>

                                                                    <!-- Image -->
                                                                    <img class="hidden h-full object-cover"
                                                                        src="{{ $img }}" alt="Disease Image"
                                                                        onload="this.style.display='block'; this.previousElementSibling.style.display='none';">
                                                                </div>
                                                                {{-- </a> --}}
                                                            @endforeach

                                                            <!-- Next & Previous Buttons -->
                                                            <div
                                                                class="absolute bottom-1 left-[40%] flex -translate-x-1/2 transform gap-5">

                                                                <button class="prev btn btn-circle"
                                                                    data-carousel="carousel-{{ $data->id }}">❮</button>
                                                                <button class="next btn btn-circle"
                                                                    data-carousel="carousel-{{ $data->id }}">❯</button>
                                                            </div>

                                                        </div>

                                                    </div>
                                                @endif

                                                <!-- Card Content -->
                                                <div class="p-5">
                                                    <h2 class="text-lg font-bold text-red-800">
                                                        {{ $data->disease ?? 'N/A' }}</h2>
                                                    <p><strong class="text-blue-600">Crop Name :</strong>
                                                        {{ $data->crop_name }}</p>
                                                    <p><strong class="text-blue-600">Affected Part :</strong>
                                                        {{ $data->affected_part }}</p>
                                                    <p><strong class="text-blue-600">Mode of Spread :</strong>
                                                        {{ $data->mode_of_spread }}</p>
                                                    <p><strong class="text-blue-600">Stage of Infection :</strong>
                                                        {{ $data->stage_of_infection }}</p>
                                                    <p><strong class="text-blue-600">Pathogen :</strong>
                                                        {{ $data->pathogen }}</p>
                                                    <p><strong class="text-blue-600">Solution :</strong>
                                                        {{ $data->solution }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-left text-red-500">Data Not Available</p>
                                    @endif
                                    <!-- CSS to Ensure Buttons are Clickable -->
                                    <style>
                                        .carousel-container .prev,
                                        .carousel-container .next {
                                            pointer-events: auto !important;
                                            z-index: 999999999;
                                            /* Ensure buttons are clickable */
                                        }
                                    </style>




                                </div>
                                <div class="h-[600px] overflow-auto bg-white p-5" x-show="openTab === 2">


                                    @if ($pest_data->count() > 0)
                                        @foreach ($pest_data as $key => $data)
                                            <div
                                                class="mx-auto my-9 max-w-4xl overflow-hidden rounded-lg border border-gray-300 bg-white shadow-lg">

                                                <!-- Header with Title & Info Icon -->
                                                <!-- Image Carousel -->
                                                @php
                                                    if (is_string($data->pest_img_urls)) {
                                                        $imageUrls = json_decode($data->pest_img_urls, true);
                                                    } elseif (is_array($data->pest_img_urls)) {
                                                        $imageUrls = $data->pest_img_urls;
                                                    } else {
                                                        $imageUrls = [];
                                                    }

                                                    // dd($imageUrls);

                                                @endphp


                                                @if (!empty($imageUrls))
                                                    <div class="relative h-[300px] overflow-hidden p-5">
                                                        <div class="carousel-container relative h-full w-full"
                                                            id="carousel-{{ $data->id }}">
                                                            @foreach ($imageUrls as $index => $img)
                                                                <div class="{{ $index === 0 ? 'opacity-100' : 'opacity-0' }} carousel-item absolute left-0 top-0 h-full w-full transition-opacity duration-700"
                                                                    data-index="{{ $index }}">
                                                                    <!-- Ensure each image has the correct href & data-fancybox grouping -->
                                                                    {{-- <a data-fancybox="gallery"
                                                                        href="{{ $img }}"
                                                                        data-caption="Caption #{{ $index + 1 }}"
                                                                        target="_blank"> --}}
                                                                    <!-- Loader Spinner -->
                                                                    <div
                                                                        class="image-loader absolute inset-0 flex items-center justify-center bg-gray-200">
                                                                        <div
                                                                            class="loader h-10 w-10 animate-spin rounded-full border-t-4 border-solid border-blue-500">
                                                                        </div>
                                                                    </div>
                                                                    <!-- Image -->
                                                                    <img class="hidden h-full object-cover"
                                                                        src="{{ $img }}" alt="Disease Image"
                                                                        onload="this.style.display='block'; this.previousElementSibling.style.display='none';">
                                                                </div>
                                                            @endforeach

                                                            <!-- Next & Previous Buttons -->
                                                            <div
                                                                class="absolute bottom-1 left-[40%] flex -translate-x-1/2 transform gap-5">
                                                                <button class="prev btn btn-circle"
                                                                    data-carousel="carousel-{{ $data->id }}">❮</button>
                                                                <button class="next btn btn-circle"
                                                                    data-carousel="carousel-{{ $data->id }}">❯</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif


                                                <!-- Card Content -->
                                                <div class="p-5">
                                                    <h2 class="text-lg font-bold text-red-800">
                                                        {{ $data->pest ?? 'N/A' }}</h2>
                                                    <p><strong class="text-blue-600">Crop Name :</strong>
                                                        {{ $data->crop_name }}</p>
                                                    <p><strong class="text-blue-600">Affected Part :</strong>
                                                        {{ $data->affected_part }}</p>
                                                    <p><strong class="text-blue-600">Mode of Spread :</strong>
                                                        {{ $data->mode_of_spread }}</p>
                                                    <p><strong class="text-blue-600">Stage of Infection :</strong>
                                                        {{ $data->stage_of_infection }}</p>
                                                    <p><strong class="text-blue-600">Pathogen :</strong>
                                                        {{ $data->pathogen }}</p>
                                                    <p><strong class="text-blue-600">Solution :</strong>
                                                        {{ $data->solution }}</p>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <p class="text-left text-red-500">Data Not Available</p>
                                    @endif
                                    <!-- CSS to Ensure Buttons are Clickable -->
                                    <style>
                                        .carousel-container .prev,
                                        .carousel-container .next {
                                            pointer-events: auto !important;
                                            z-index: 999999999;
                                            /* Ensure buttons are clickable */
                                        }
                                    </style>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>


                <!-- Accordion  5 Crop Health Analysis-->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-5" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-5">
                        Crop Health Analysis
                    </label>
                    <div class="collapse-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @if ($cropHealthImg != null)
                                <!-- Image Card -->
                                <div class="bg-white  flex flex-col items-left">
                                    <p class="">
                                        Date as at: {{ $crop_date_as_at }}
                                    </p>
                                    <img src="{{ asset($cropHealthImg) }}" alt="Soil Moisture"
                                        class="w-full max-w-[500px] h-auto rounded-lg border border-gray-300">
                                </div>
                            @else
                                <p class="text-red-500 text-left">Today image report not generated</p>
                            @endif
                            <!-- Chart Card -->
                            <div class="bg-white   shadow-md rounded-lg flex flex-col items-center">
                                <h3 class="text-lg font-semibold mb-2">Crop Health Data</h3>
                                <canvas id="crop_zonalStatsChart" class="w-full "></canvas>
                            </div>

                        </div>

                    </div>
                </div>



                <!-- Accordion Item 6 Image-Based Diagnosis-->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-6" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-6">
                        Image-Based Diagnosis
                    </label>
                    <div class="collapse-content">
                        @if ($image_ad_data->count() != 0)
                            <div class="top-30 absolute right-24 flex items-center justify-between">
                                <p class="text-lg font-semibold"></p>
                                <i class="fa fa-info-circle" style="font-size:30px; color:#33772f; cursor:pointer;"
                                    onclick="show_Image_Based_Diagnosis_Disclaimer()"></i>
                            </div>
                            <div class="h-[700px] overflow-auto p-5">
                                @foreach ($image_ad_data as $img_data)
                                    <div
                                        class="mx-auto my-9 max-w-4xl overflow-hidden rounded-lg border border-gray-300 bg-white shadow-lg">

                                        <!-- Header with Title & Info Icon -->
                                        <!-- Image Carousel -->
                                        @php
                                            $img_path_imgdaig = null;
                                            $imagePath = public_path(
                                                'storage/advisories/images/' . $img_data->submission->image_file_name,
                                            );

                                            if (
                                                !empty($img_data->submission->image_file_name) &&
                                                file_exists($imagePath)
                                            ) {
                                                $img_path_imgdaig = asset(
                                                    'storage/advisories/images/' .
                                                        $img_data->submission->image_file_name,
                                                );
                                            }
                                        @endphp

                                        @if ($img_path_imgdaig)
                                            <div class="relative h-[300px] overflow-hidden p-5">
                                                <!-- Loader while image loads -->
                                                <div
                                                    class="image-loader absolute inset-0 flex items-center justify-center bg-gray-200">
                                                    <div
                                                        class="loader h-10 w-10 animate-spin rounded-full border-t-4 border-solid border-blue-500">
                                                    </div>
                                                </div>

                                                <!-- Image -->
                                                <img class="hidden h-full object-cover" src="{{ $img_path_imgdaig }}"
                                                    alt="Disease Image"
                                                    onload="this.style.display='block'; this.previousElementSibling.style.display='none';">
                                            </div>
                                        @endif



                                        <!-- Card Content -->
                                        <div class="p-5">
                                            <h2 class="text-lg font-bold text-red-800">
                                                {{ $img_data->disease_name ?? 'N/A' }}</h2>
                                            <h2 class="text-lg font-bold text-green-800">
                                                {{ $img_data->crop_name ?? 'N/A' }}</h2>
                                            <p><strong class="text-blue-600">Solution :</strong>
                                                {{ $img_data->disease_solution ?? 'N/A' }}</p>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-left text-red-500">Data Not Available</p>
                        @endif
                    </div>

                </div>



                <!-- Accordion 7 Soil Moisture  Estimation-->
                <div class="collapse collapse-arrow border border-gray-300 bg-white mb-5 p-4">
                    <input type="checkbox" id="accordion-7">
                    <label for="accordion-7" class="collapse-title text-lg font-medium">
                        Soil Moisture Estimation
                    </label>
                    <div class="collapse-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                            @if ($soilMoistureImg != null)
                                <!-- Image Card -->
                                <div class="bg-white  flex flex-col items-left">
                                    <p class="">
                                        Date as at: {{ $soil_date_as_at }}
                                    </p>
                                    <img src="{{ asset($soilMoistureImg) }}" alt="Soil Moisture"
                                        class="w-full max-w-[500px] h-auto rounded-lg border border-gray-300">
                                </div>
                            @else
                                <p class="text-red-500 text-left">Today image report not generated</p>
                            @endif
                            <!-- Chart Card -->
                            <div class="bg-white   shadow-md rounded-lg flex flex-col items-center">
                                <h3 class="text-lg font-semibold mb-2">Soil Moisture Data</h3>
                                <canvas id="sm_zonalStatsChart" class="w-full "></canvas>
                            </div>

                        </div>
                    </div>
                </div>


                <!-- Accordion  8  crop Calendar -->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input id="accordion-8" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-8">
                        Crop Calendar
                    </label>
                    <div class="collapse-content overflow-hidden">
                        @if (count($calenders) > 0)
                            <div class="swiper">
                                <div class="swiper-wrapper">
                                    @foreach ($calenders as $calender)
                                        <div class="swiper-slide">
                                            <div class="card rounded-xl bg-base-100 p-6 shadow-sm">
                                                <h2 class="text-xl font-bold">Range: {{ $calender->range }}</h2>
                                                <p class="text-lg"><strong>Recommended: </strong>
                                                    <br>
                                                    {{ $calender->recommended }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="custom-swiper-pagination text-center pt-6"></div>

                            <!-- Swiper Navigation -->
                            <div class="flex justify-center gap-10">
                                <div class="custom-swiper-button-prev">
                                    <i class="fas fa-arrow-left rounded-full bg-emerald-800 p-2 text-white"></i>
                                </div>
                                <div class="custom-swiper-button-next">
                                    <i class="fas fa-arrow-right rounded-full bg-emerald-800 p-2 text-white"></i>
                                </div>
                            </div>
                        @else
                            <p class="text-left text-red-500" colspan="3">Data Not Available</p>
                        @endif
                    </div>

                </div>
                <!-- Accordion 6  LSWI-->
                {{-- <div class="collapse collapse-arrow border border-gray-300 bg-white my-5 p-4">
                    <input type="checkbox" id="accordion-6">
                    <label for="accordion-6" class="collapse-title text-lg font-medium">
                        LSWI
                    </label>
                    <div class="collapse-content">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Image Card -->
                            <div class="bg-white p-4 shadow-md rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">LSWI Image</h3>

                                @if ($lswiImg)
                                    <img src="{{ $lswiImg }}" alt="LSWI"
                                        class="w-full rounded-lg shadow-md">
                                @else
                                    <p class="text-red-500">Image not available</p>
                                @endif
                            </div>

                            <!-- Chart Card -->
                            <div class="bg-white p-4 shadow-md rounded-lg">
                                <h3 class="text-lg font-semibold mb-2">LSWI Data</h3>
                                <canvas id="lswi_zonalStatsChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <!-- Accordion Item 9 - Optimal Irrigation -->
                <div class="collapse collapse-arrow mb-5 border border-gray-300 bg-white p-4">
                    <input class="accordion-toggle" id="accordion-19" type="checkbox">
                    <label class="collapse-title text-lg font-medium" for="accordion-19">
                        Optimal Irrigation
                    </label>
                    <div class="collapse-content">
                        <div class="flex items-center justify-between">
                            <h1 class="ps-2 text-xl font-bold" id="irrigation-date"></h1>
                            <i class="fa fa-info-circle" class="fa fa-info-circle"
                                style="font-size:30px; color:#33772f; cursor:pointer;"
                                onclick="show_irrigation_Disclaimer()" <i></i>
                        </div>

                        <table class="table relative" id="_irrigation_table_tag">
                            <thead class="text-primary-content">
                                <tr>
                                    <th>Type</th>
                                    <th>Gross Irrigation (mm)</th>
                                    <th>Irrigation Frequency (days)</th>
                                </tr>
                            </thead>
                            <tbody id="irrigation-data">
                                @if (count($irrigations) != 0)
                                    @foreach ($irrigations as $irrigation)
                                        <tr>
                                            <td>{{ $irrigation->type }}</td>
                                            <td>{{ $irrigation->gross_irrig }}</td>
                                            <td>{{ $irrigation->irrig_freq }}</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td class="text-center text-red-500" colspan="3">Data Not Available</td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
        {{-- ================== For Key Statistics ==================== --}}


    </div>


    <script>
        // $(document).ready(function() {
        //     $('#state_option').select2();
        //     $('#district_option').select2();
        // });
    </script>



    @php
        // Decode center if stored as JSON
        $farmCenter = is_string($farm->center) ? json_decode($farm->center, true) : $farm->center;

        // Decode geo_json safely
        $geoJson = is_string($farm->geo_json) ? json_decode($farm->geo_json, true) : $farm->geo_json;
        $coordinates = $geoJson['geometry']['coordinates'][0] ?? [];

        // Convert [lng, lat] to [lat, lng] format
        $convertedCoords = [];
        foreach ($coordinates as $coord) {
            if (is_array($coord) && count($coord) == 2) {
                $convertedCoords[] = [$coord[1], $coord[0]];
            }
        }

        // Calculate centroid of the polygon (Average lat & lng)
        if (count($convertedCoords) > 0) {
            $latSum = 0;
            $lngSum = 0;
            foreach ($convertedCoords as $point) {
                $latSum += $point[0];
                $lngSum += $point[1];
            }
            $farmCenter = [$latSum / count($convertedCoords), $lngSum / count($convertedCoords)];
        }

        // Ensure farmCenter is always valid
        if (!is_array($farmCenter) || count($farmCenter) != 2) {
            $farmCenter = [0, 0]; // Default to (0,0) if everything fails
        }
    @endphp


    {{-- ====================== For Mandi data============================== --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            getmandirates_inputs_data(true); // Load data on page load (ignore state/district validation)
        });

        function formatDate(dateString) {
            if (!dateString) return ''; // Handle empty dates
            let date = new Date(dateString);
            let day = String(date.getDate()).padStart(2, '0');
            let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are 0-based
            let year = date.getFullYear();
            return `${day}-${month}-${year}`;
        }

        function getmandirates_inputs_data(onPageLoad = false) {
            $(".error-msg").remove(); // Clear previous error messages

            let state = $('#state_option').val();
            let district = $('#district_option').val();
            let from_date = $('#fromDate').val();
            let to_date = $('#toDate').val();
            let isValid = true;

            // // Validation function
            // function showError(inputSelector, message) {
            //     let inputElement = $(inputSelector);
            //     let errorMsg = `<span class="error-msg text-red-500 text-sm">${message}</span>`;

            //     // Check if the element is Select2
            //     if (inputElement.hasClass('select2-hidden-accessible')) {
            //         inputElement.next('.select2').after(errorMsg); // Append below Select2
            //     } else {
            //         inputElement.parent().append(errorMsg); // Append below the input field
            //     }

            //     isValid = false;
            // }

            // // **Validation Check Only If Not on Page Load**
            // if (!onPageLoad) {
            //     if (!state) showError("#state_option", "State is required.");
            //     if (!district) showError("#district_option", "District is required.");
            //     if (!from_date) showError("#fromDate", "From Date is required.");
            //     if (!to_date) showError("#toDate", "To Date is required.");

            //     if (!isValid) return; // Stop execution if validation fails
            // }

            // // **Prevent AJAX if Dates Are Not Selected**
            // if (!from_date || !to_date) return;

            // $('#mandi_rate_table tbody').html('<tr><td colspan="11" class="text-center">Loading data...</td></tr>');

            $('#mandi_rate_table tbody').html(
                '<div class="mandiratesloader"></div>'
            );

            $.ajax({
                url: "{{ route('mandi.rates') }}",
                type: "GET",
                data: {
                    state: state,
                    district: district,
                    from_date: from_date,
                    to_date: to_date
                },
                dataType: "json",
                success: function(response) {
                    if (response.data.length !== 0) {
                        let dt = $("#mandi_rate_table").DataTable();
                        dt.clear().draw(); // Clear previous data

                        response.data.forEach((rate, index) => {
                            let formattedDate = formatDate(rate.arrival_date);
                            dt.row.add([
                                index + 1,
                                rate.state,
                                rate.district,
                                rate.market,
                                rate.commodity,
                                rate.variety,
                                formattedDate,
                                rate.min_price,
                                rate.max_price,
                                rate.modal_price
                            ]).draw(false);
                        });
                    } else {
                        $('#mandi_rate_table tbody').html(
                            '<tr><td colspan="11" class="text-center text-red-500">No data available</td></tr>'
                        );
                    }
                },
                error: function(xhr) {
                    console.error("Error:", xhr);
                    $('#mandi_rate_table tbody').html(
                        '<tr><td colspan="11" class="text-center text-red-500">Error fetching data</td></tr>'
                    );
                }
            });

        }

        function resetmandirates_inputs_data() {
            // Reset Select2 dropdowns properly
            $('#state_option').val('').trigger('change');
            $('#district_option').val('').trigger('change');

            // Reset date inputs
            $('#fromDate').val('');
            $('#toDate').val('');

            // Remove validation error messages
            $(".error-msg").remove();
            let dt = $("#mandi_rate_table").DataTable();
            dt.clear().draw();
        }
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTables
            let dt = new DataTable("#mandi_rate_table", {
                processing: true, // Show loading indicator
                paging: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                scrollX: true,
                // scrollY: "550px",
                // scrollCollapse: true,
                // autoWidth: false,


            });
        });
    </script>









    {{-- ====================== For Get_dis ============================== --}}
    <script>
        function get_city_list() {
            let state_id = $('#state_option').val();

            if (!state_id) {
                $('#district_option').html('<option value="">Select District</option>');
                return;
            }

            $.ajax({
                url: "{{ url('get_city_list') }}",
                method: "POST",
                data: {
                    state_id: state_id,
                    "_token": "{{ csrf_token() }}"
                },
                dataType: "json", // Ensure response is JSON
                success: function(res) {
                    let htmldata = '<option value="">Select District</option>';
                    if (Array.isArray(res) && res.length > 0) {
                        res.forEach(item => {
                            htmldata += `<option value="${item.city}">${item.city}</option>`;
                        });
                    }
                    $('#district_option').html(htmldata);
                },
                error: function(xhr, status, error) {
                    console.error('AJAX error:', error);
                    $('#district_option').html('<option value="">Select District</option>');
                }
            });
        }
    </script>









    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var smChartData = @json($smChartData);
            var cropChartData = @json($ndviChartData);

            // console.log("✅ Soil Moisture Data:", smChartData);
            // console.log("✅ Crop Health Data:", cropChartData);

            smChartData = typeof smChartData === "string" ? JSON.parse(smChartData) : smChartData;
            cropChartData = typeof cropChartData === "string" ? JSON.parse(cropChartData) : cropChartData;

            function hasValidData(data) {
                return Array.isArray(data) && data.some(entry => entry.value !== 0);
            }


            function getLastSixMonthsData(data) {
                let sixMonthsAgo = new Date();
                sixMonthsAgo.setMonth(sixMonthsAgo.getMonth() - 6);
                return data.filter(entry => new Date(entry.date) >= sixMonthsAgo);
            }

            function renderLineChart(canvasId, data, label, bgColor, borderColor) {
                var canvasElement = document.getElementById(canvasId);
                if (!canvasElement) {
                    // console.error(`❌ Canvas element not found: ${canvasId}`);
                    return;
                }

                var container = canvasElement.parentElement;
                let filteredData = getLastSixMonthsData(data);

                if (!hasValidData(filteredData)) {
                    // console.warn(`⚠️ No valid data available for: ${label}`);
                    canvasElement.style.display = "none";

                    let noDataMessage = document.createElement("p");
                    noDataMessage.className = "no-data-message";
                    noDataMessage.innerText = `⚠️ No data available for ${label}`;

                    let existingMessage = container.querySelector(".no-data-message");
                    if (existingMessage) existingMessage.remove();

                    container.appendChild(noDataMessage);
                    return;
                }

                canvasElement.style.display = "block";

                let existingMessage = container.querySelector(".no-data-message");
                if (existingMessage) existingMessage.remove();

                var existingChart = Chart.getChart(canvasId);
                if (existingChart) {
                    existingChart.destroy();
                }

                var labels = filteredData.map(entry => entry.date);
                var values = filteredData.map(entry => entry.value);
                var maxYValue = Math.max(...values) + 0.2; // ✅ Adjusted padding

                canvasElement.style.height = "400px"; // ✅ Fixed height

                new Chart(canvasElement, {
                    type: "line",
                    data: {
                        labels: labels,
                        datasets: [{
                            label: label,
                            data: values,
                            backgroundColor: bgColor,
                            borderColor: borderColor,
                            borderWidth: 2,
                            tension: 0, // Smooth curves
                            fill: false,
                            pointRadius: 5,
                            pointHoverRadius: 7
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            x: {
                                ticks: {
                                    maxRotation: 0,
                                    minRotation: 0
                                },
                                grid: {
                                    display: false
                                }
                            },
                            y: {
                                beginAtZero: true, // ✅ Force start from 0
                                suggestedMin: 0, // ✅ Ensures Y-axis starts at 0
                                stepSize: 0.1, // ✅ Adds step of 0.1
                                max: maxYValue, // ✅ Prevents unnecessary stretching
                            }
                        },
                        plugins: {
                            legend: {
                                labels: {
                                    font: {
                                        size: 14
                                    }
                                }
                            }
                        }
                    }
                });
            }

            if (hasValidData(smChartData)) {
                renderLineChart("sm_zonalStatsChart", smChartData, "Soil Moisture", "rgba(75, 192, 192, 0.5)",
                    "rgba(75, 192, 192, 1)");
            } else {
                console.warn("⚠️ Soil Moisture Chart: No valid data available");
            }

            if (hasValidData(cropChartData)) {
                renderLineChart("crop_zonalStatsChart", cropChartData, "Crop Health", "rgba(255, 159, 64, 0.5)",
                    "rgba(255, 159, 64, 1)");
            } else {
                console.warn("⚠️ Crop Health Chart: No valid data available");
            }
        });
    </script>







    {{-- for accordation 1 discalimer --}}
    <script>
        function showDisclaimer() {
            Swal.fire({
                title: "Disclaimer",
                html: `
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Weather Forecast</h3>
                         <p>Users are advised to note that meteorological conditions can undergo swift changes, and the provided data may not consistently mirror real-time situations.</p>
                    </div>
                    `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: true,
                allowEscapeKey: true,
                customClass: {
                    confirmButton: "custom-swal-button"
                },
                showCloseButton: true // This enables the close (X) button at the top right
            });
        }


        //  for accordation Pest Disclaimer

        function show_Pest_Diseas_Disclaimer() {
            Swal.fire({
                title: "Disclaimer",
                html: `
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Pest and Disease Forewarning</h3>
                        <p>The P&D forewarning does not verify the presence of disease or pests; rather, it suggests the potential for infection based on the prevailing weather conditions.</p>
                        
                        <h3 style="font-weight: bold; font-size:20px; margin-top:10px;">P&D Banned Chemicals</h3>
                        <p>The banned chemicals will be updated periodically to align with the government's yearly revisions of chemical regulations. If anything has been overlooked, please identify it and notify our team through WhatsApp at <a href="https://wa.me/918970095700" target="_blank">+918970095700</a>.</p>
                    </div>
                `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: true,
                allowEscapeKey: true,
                customClass: {
                    confirmButton: "custom-swal-button"
                },
                showCloseButton: true // This enables the close (X) button at the top right
            });
        }


        //  for accordation irrigation Disclaimer
        function show_irrigation_Disclaimer() {
            Swal.fire({
                title: "Disclaimer",
                html: `
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Irrigation Advisory</h3>
                         <p>The provided irrigation schedule serves as a general guideline, and adjustments should be made based on current weather conditions and the occurrence of rainfall.</p>
                    </div>
                    <div style="text-align: left;">

                    <h3 style="font-weight: bold; font-size:20px; margin-top:10px;">Interpretation of mm and freq.</h3>
                        <p>Irrigation in ‘mm’ is the depth of water during irrigation. If yield (litre per second) of irrigation is available, it can be used to compute the irrigation time. For details, you can reach out to us through WhatsApp at <a href="https://wa.me/919096248660" target="_blank">+919096248660</a>.</p>
                    </div>
                    
                    `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: true,
                allowEscapeKey: true,
                customClass: {
                    confirmButton: "custom-swal-button"
                },
                showCloseButton: true // This enables the close (X) button at the top right
            });
        }


        //  for Image Based Diagnosis Disclaimer
        function show_Image_Based_Diagnosis_Disclaimer() {
            Swal.fire({
                title: "Disclaimer",
                html: `
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Image Advisory</h3>
                         <p>Always adhere to the precise instructions on the product label for accurate and current guidance on safe and effective pesticide use. Wear appropriate protective gear, apply pesticides at recommended times, and observe specified pre-harvest intervals to ensure food safety.</p>
                    </div>
                   
                    
                    `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: true,
                allowEscapeKey: true,
                customClass: {
                    confirmButton: "custom-swal-button"
                },
                showCloseButton: true // This enables the close (X) button at the top right
            });
        }


        //  for Soil Nutrient Disclaimer
        function show_Soil_Nutrient_Disclaimer() {
            Swal.fire({
                title: "Disclaimer",
                html: `
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Soil Health</h3>
                         <p>This is generated on the date when the land was barren. The Figures are based on satellite images with a spatial resolution of 10m*10m. When compared to lab tests, there may be minor differences. The reports are not to be reproduced wholly or in part and cannot be used as evidence in the court of LAW .</p>
                    </div>
                    <div style="text-align: left;">
                        <h3 style="font-weight: bold; font-size:20px;">Fertiliser Recommendation</h3>
                         <p> Fertilizer recommendations are based on soil reports and general crop guidelines. However, agriculture's dynamic nature and varying conditions can affect outcomes. Users are advised to consider local factors and crop specifics before applying .</p>
                    </div>
                   
                    
                    `,
                showCancelButton: false,
                showConfirmButton: true,
                confirmButtonText: "OK",
                allowOutsideClick: true,
                allowEscapeKey: true,
                customClass: {
                    confirmButton: "custom-swal-button"
                },
                showCloseButton: true // This enables the close (X) button at the top right
            });
        }
    </script>

    {{-- for using map --}}
    <script>
        function initMap() {
            // Set map center coordinates (Example: India)
            const location = {
                lat: 28.6139,
                lng: 77.2090
            }; // New Delhi

            // Create map instance
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 10, // Adjust zoom level
                center: location, // Center of the map
            });

            // Add marker on the map
            const marker = new google.maps.Marker({
                position: location,
                map: map,
                title: "New Delhi, India", // Tooltip on hover
            });
        }
    </script>



    {{-- fro chartjs --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById("myChart2").getContext("2d");

            var chartData = {!! $chartDataJson !!}; // Getting JSON data from PHP

            var labels = chartData.map(data => data.date); // Extracting dates
            var maxTempData = chartData.map(data => data.maxTemp); // Max Temperature
            var minTempData = chartData.map(data => data.minTemp); // Min Temperature

            var myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [{
                            label: "Max Temperature (°C)",
                            data: maxTempData,
                            borderColor: "red",
                            backgroundColor: "rgba(255, 99, 132, 0.0)", // Removed background fill
                            fill: false,
                            pointRadius: 3, // Increased dot size
                            pointHoverRadius: 5, // Increased hover dot size
                            tension: 0.4,
                            borderWidth: 1, // ⬅️ Reduced line thickness
                        },
                        {
                            label: "Min Temperature (°C)",
                            data: minTempData,
                            borderColor: "blue",
                            backgroundColor: "rgba(54, 162, 235, 0.0)", // Removed background fill
                            fill: false,
                            pointRadius: 3, // Increased dot size
                            pointHoverRadius: 4, // Increased hover dot size
                            tension: 0.4,
                            borderWidth: 1, // ⬅️ Reduced line thickness
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: "Statistic of Temperature", // Added title at the top
                            font: {
                                size: 25
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom", // Moved legend to the bottom
                        },
                        tooltip: {
                            backgroundColor: "rgba(0, 0, 0, 0.8)", // Darker tooltip background
                            titleColor: "#fff",
                            bodyColor: "#fff",
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: "Date",
                            },
                        },
                        y: {
                            title: {
                                display: true,
                                text: "Temperature (°C)",
                            },
                        }
                    }
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            const ctx2 = document.getElementById("myChart1").getContext("2d");

            var rainfallChartData = {!! $rainfallChartDataJson !!}; // Get JSON Data from PHP

            var labels = rainfallChartData.map(data => data.date); // X-Axis Labels (Dates)
            var rainfallData = rainfallChartData.map(data => data.rainfall); // Y-Axis (Rainfall in mm)

            new Chart(ctx2, {
                type: "bar",
                data: {
                    labels: labels,
                    datasets: [{
                        label: "Rainfall (mm)",
                        data: rainfallData,
                        backgroundColor: "rgba(54, 162, 235, 0.5)", // Blue color for rain
                        borderColor: "rgba(54, 162, 235, 1)",
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        title: {
                            display: true,
                            text: "Statistic of RainFall", // Added title at the top
                            font: {
                                size: 25
                            }
                        },
                        legend: {
                            display: true,
                            position: "bottom",
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: "Rainfall (mm)"
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: "Date"
                            }
                        }
                    }
                }
            });
        });
    </script>



    <!-- JavaScript for Carousel -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".carousel-container").forEach(carousel => {
                let slides = carousel.querySelectorAll(".carousel-item");
                let currentIndex = 0;

                function showSlide(index) {
                    slides.forEach((slide, i) => {
                        slide.classList.toggle("opacity-100", i === index);
                        slide.classList.toggle("opacity-0", i !== index);
                    });
                }

                carousel.querySelector(".prev").addEventListener("click", function() {
                    currentIndex = (currentIndex - 1 + slides.length) % slides.length;
                    showSlide(currentIndex);
                });

                carousel.querySelector(".next").addEventListener("click", function() {
                    currentIndex = (currentIndex + 1) % slides.length;
                    showSlide(currentIndex);
                });

                showSlide(currentIndex);
            });
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            new Swiper('.swiper', {
                loop: false,
                spaceBetween: 20,
                navigation: {
                    nextEl: '.custom-swiper-button-next',
                    prevEl: '.custom-swiper-button-prev'
                },
                pagination: {
                    el: '.custom-swiper-pagination',
                    // type: 'bullets',
                    type: "fraction",
                },
            });
        });
    </script>
    {{-- for map lat & long  --}}
    <script>
        // Initialize map at the polygon's centroid
        var map = L.map('map').setView(@json($farmCenter), 35);

        // Google Hybrid Tile Layer
        L.tileLayer('https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}', {
            attribution: '&copy; Google Maps'
        }).addTo(map);
        // Function to force map resize
        function resizeMap() {
            setTimeout(function() {
                map.invalidateSize();
            }, 500); // Delay to allow CSS rendering
        }

        // Call resize function after map load & on window resize
        resizeMap();

        // Get boundary coordinates
        var boundaryCoords = @json($convertedCoords);

        if (boundaryCoords.length > 0) {
            var polygon = L.polygon(boundaryCoords, {
                color: 'red',
                fillColor: 'red',
                fillOpacity: 0.3
            }).addTo(map);

        } else {
            console.error("No boundary coordinates found!");
        }
    </script>

</x-app-layout>
