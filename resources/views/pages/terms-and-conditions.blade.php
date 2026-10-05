<x-guest-layout>
    <div class="container prose mb-20 mt-3 max-w-5xl px-4 sm:px-6 lg:px-8">

        <x-page-header :title="__('messages.terms_title')" />

        <ol>
            <li>
                <h3><u>{{ __('messages.terms_general_heading') }}</u></h3>

                <p class="text-justify">{!! __('messages.terms_general_para1') !!}</p>
                <p class="text-justify">{!! __('messages.terms_general_para2') !!}</p>
                <p class="text-justify">{!! __('messages.terms_general_para3') !!}</p>
            </li>
            <li>
                <h3><u>{{ __('messages.proprietary_rights_title') }}</u></h3>
                <ol type="a">
                    <li>{!! __('messages.proprietary_rights_point_a') !!}</li>
                    <li>{!! __('messages.proprietary_rights_point_b') !!}</li>
                </ol>
            </li>

            <li>
                <h3><u>{{ __('messages.usage_of_application_title') }}</u></h3>
                <ol type="a">
                    <li>{!! __('messages.usage_of_application_point_a') !!}</li>
                    <li>{!! __('messages.usage_of_application_point_b') !!}</li>
                    <li>{!! __('messages.usage_of_application_point_c') !!}</li>
                    <li>{!! __('messages.usage_of_application_point_d') !!}</li>
                </ol>
            </li>

            {{-- <li>
                <h3>
                    <u>{!! __('messages.disclaimer_of_warranty_title') !!}</u>
                </h3>
                <p>{!! __('messages.disclaimer_of_warranty_content') !!}</p>
            </li> --}}

            <li>
                <h3><u>{!! __('messages.privacy_policy_title') !!}</u></h3>
                <p>{!! __('messages.privacy_policy_content') !!}</p>
            </li>
            <li>
                <h3><u>{!! __('messages.exactness_not_guaranteed_title') !!}</u></h3>
                <p>{!! __('messages.exactness_not_guaranteed_content') !!}</p>
            </li>

            <li>
                <h3><u>{!! __('messages.third_party_links_title') !!}</u></h3>
                <p>{!! __('messages.third_party_links_content') !!}</p>
            </li>

            <li>
                <h3><u>{!! __('messages.disclaimer_of_warranty_title') !!}</u></h3>
                <p>{!! __('messages.disclaimer_of_warranty_content') !!}</p>
            </li>

            <li>
                <h3><u>{!! __('messages.limitation_of_liability_title') !!}</u></h3>
                <ol type="a">
                    <li>{!! __('messages.limitation_of_liability_point_a') !!}</li>
                    <li>{!! __('messages.limitation_of_liability_point_b') !!}</li>
                </ol>
            </li>

            <li>
                <h3><u>{!! __('messages.indemnity_title') !!}</u></h3>
                <p>{!! __('messages.indemnity_description') !!}</p>
            </li>
            <li>
                <h3><u>{!! __('messages.pricing_title') !!}</u></h3>
                <p>{!! __('messages.pricing_description') !!}</p>
            </li>

            <li>
                <h3><u>{!! __('messages.force_majeure_title') !!}</u></h3>
                <p>{!! __('messages.force_majeure_description') !!}</p>
            </li>

            <li>
                <h3><u>{!! __('messages.suspension_termination_title') !!}</u></h3>
                <ol type="a">
                    <li>{!! __('messages.suspension_termination_point1') !!}
                        <ol type="a">
                            <li>{!! __('messages.suspension_termination_point1_a') !!}</li>
                            <li>{!! __('messages.suspension_termination_point1_b') !!}</li>
                            <li>{!! __('messages.suspension_termination_point1_c') !!}</li>
                            <li>{!! __('messages.suspension_termination_point1_d') !!}</li>
                            <li>{!! __('messages.suspension_termination_point1_e') !!}</li>
                        </ol>
                    </li>
                    <li>{!! __('messages.suspension_termination_point2') !!}</li>
                    <li>{!! __('messages.suspension_termination_point3') !!}</li>
                </ol>
            </li>

            <li>
                <h3><u>{!! __('messages.governing_law_title') !!}</u></h3>
                <p>{!! __('messages.governing_law_paragraph') !!}</p>
            </li>

        </ol>

        <div class="mt-8">
            <a class="btn btn-outline btn-primary rounded-lg px-6 py-2"
                href="{{ route('home') }}">{{ __('messages.privacypolicy_BacktoHome') }}</a>
        </div>
    </div>
</x-guest-layout>
