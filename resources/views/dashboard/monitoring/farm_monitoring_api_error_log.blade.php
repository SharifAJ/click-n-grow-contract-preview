<x-app-layout>
    {{-- ================== For header title ==================== --}}
    <x-header-title :title="__('Farm Monitoring API Error Log')" />





    <div class=" mt-5">
        <div class="rounded-sm border border-stroke bg-white shadow-default dark:border-strokedark dark:bg-boxdark">
            {{-- <div class="flex justify-between items-center p-4">
                <h4 class="text-lg font-semibold">Farm Details</h4>
                <a href="{{ route('addfarm.index') }}" class="btn btn-success text-white">
                    Back
                </a>
            </div> --}}

            <div class="overflow-x-auto">

                <div class="w-full p-5">
                    <table class="table border border-gray-300">
                        <thead>
                            <tr>
                                <td class="border border-gray-300">#</td>
                                <td class="border border-gray-300">Report Generated At</td>
                                <td class="border border-gray-300">Service Name</td>
                                <td class="border border-gray-300">Report Updated At</td>
                                <td class="border border-gray-300">API Report Status</td>
                                <td class="border border-gray-300">API Count</td>
                                <td class="border border-gray-300">Error Message (if any)</td>
                            </tr>
                        </thead>
                        <tbody>



                            {{-- for Land Area Mapping --}}
                            <tr>
                                <td class="border border-gray-300">1</td>
                                <td class="border border-gray-300"> N/A
                                </td>
                                <td class="border border-gray-300">Land Area Mapping</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">0</td>
                                <td class="border border-gray-300">N/A </td>
                            </tr>

                            {{-- for Weather Forecasting --}}
                            <tr>
                                <td class="border border-gray-300">2</td>
                                @if (optional($weather)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($weather->created_at ?? 'N/A')) }}</td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif

                                <td class="border border-gray-300">Weather Forecasting</td>
                                @if (optional($weather)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($weather->updated_at ?? 'N/A')) }}</td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif

                                <td class="border border-gray-300">{{ ucfirst($weather->api_status ?? 'N/A') }}</td>

                                <td class="border border-gray-300">{{ $weatherCount }}</td>
                                <td class="border border-gray-300">{{ $weather->error_message ?? 'N/A' }}</td>
                            </tr>

                            {{-- for Mandi Rates --}}
                            <tr>
                                <td class="border border-gray-300">3</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">Mandi Rates</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">N/A</td>
                                <td class="border border-gray-300">0</td>
                                <td class="border border-gray-300">N/A</td>
                            </tr>

                            {{-- for Soil Nutrient Analysis --}}
                            <tr>
                                <td class="border border-gray-300">4</td>
                                @if (optional($SoilNutrient)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($SoilNutrient->created_at ?? 'N/A')) }}</td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Soil Nutrient Analysis</td>
                                @if (optional($SoilNutrient)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($SoilNutrient->updated_at ?? 'N/A')) }}</td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif

                                <td class="border border-gray-300">
                                    {{ $SoilNutrient && $SoilNutrient->api_status ? ucfirst($SoilNutrient->api_status) : 'N/A' }}
                                </td>

                                <td class="border border-gray-300">{{ $SoilNutrientCount }}</td>
                                <td class="border border-gray-300">{{ $SoilNutrient->error_message ?? 'N/A' }}</td>
                            </tr>

                            {{-- for Pests & Diseases Forewarning --}}
                            <tr>
                                <td class="border border-gray-300">5</td>
                                @if (optional($PestsDiseases)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($PestsDiseases->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Pests & Diseases Forewarning</td>

                                @if (optional($PestsDiseases)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($PestsDiseases->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">
                                    {{ $PestsDiseases && $PestsDiseases->api_status ? ucfirst($PestsDiseases->api_status) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300">{{ $PestsDiseasesCount }}</td>

                                <td class="border border-gray-300">{{ $PestsDiseases->error_message ?? 'N/A' }}</td>
                            </tr>

                            {{-- for Crop Health Analysis --}}
                            <tr>
                                <td class="border border-gray-300">6</td>
                                @if (optional($setallites)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($setallites->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Crop Health Analysis</td>
                                @if (optional($setallites)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($setallites->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">
                                    {{ $setallites && $setallites->api_status ? ucfirst($setallites->api_status) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300">{{ $setallitesCount }}</td>
                                <td class="border border-gray-300">{{ $setallites->error_message ?? 'N/A' }}</td>
                            </tr>
                            {{-- for Image-Based Diagnosis --}}
                            <tr>
                                <td class="border border-gray-300">7</td>
                                @if (optional($ImageDiagnosis)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($ImageDiagnosis->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Image-Based Diagnosis</td>

                                @if (optional($ImageDiagnosis)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($ImageDiagnosis->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">
                                    {{ $ImageDiagnosis && $ImageDiagnosis->api_status ? ucfirst($ImageDiagnosis->api_status) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300">{{ $ImageDiagnosisCount }}</td>

                                <td class="border border-gray-300">{{ $ImageDiagnosis->error_message ?? 'N/A' }}</td>
                            </tr>
                            {{-- for Soil Moisture Estimation --}}
                            <tr>
                                <td class="border border-gray-300">8</td>
                                @if (optional($setallites)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($setallites->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Soil Moisture Estimation</td>
                                @if (optional($setallites)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($setallites->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">
                                    {{ $setallites && $setallites->api_status ? ucfirst($setallites->api_status) : 'N/A' }}
                                </td>

                                <td class="border border-gray-300">{{ $setallitesCount }}</td>

                                <td class="border border-gray-300">{{ $setallites->error_message ?? 'N/A' }}</td>
                            </tr>

                            {{-- for Crop Calendar --}}
                            <tr>
                                <td class="border border-gray-300">9</td>
                                @if (optional($CropCalendar)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($CropCalendar->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">Crop Calendar</td>
                                @if (optional($CropCalendar)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($CropCalendar->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif
                                <td class="border border-gray-300">
                                    {{ $CropCalendar && $CropCalendar->api_status ? ucfirst($CropCalendar->api_status) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300">{{ $CropCalendarCount }}</td>

                                <td class="border border-gray-300">{{ $CropCalendar->error_message ?? 'N/A' }}</td>
                            </tr>
                            {{-- for Optimal Irrigation --}}
                            <tr>
                                <td class="border border-gray-300">10</td>
                                @if (optional($OptimalIrrigation)->created_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($OptimalIrrigation->created_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif

                                <td class="border border-gray-300">Optimal Irrigation</td>

                                @if (optional($OptimalIrrigation)->updated_at)
                                    <td class="border border-gray-300">
                                        {{ date('d-M-Y h:i:s A', strtotime($OptimalIrrigation->updated_at ?? 'N/A')) }}
                                    </td>
                                @else
                                    <td class="border border-gray-300">N/A</td>
                                @endif

                                <td class="border border-gray-300">
                                    {{ $OptimalIrrigation && $OptimalIrrigation->api_status ? ucfirst($OptimalIrrigation->api_status) : 'N/A' }}
                                </td>
                                <td class="border border-gray-300">{{ $OptimalIrrigationCount }}</td>

                                <td class="border border-gray-300">{{ $OptimalIrrigation->error_message ?? 'N/A' }}
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    <a href="{{ route('monitoring.index') }}" class="btn btn-neutral mt-4 text-white">
                        Back
                    </a>
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
