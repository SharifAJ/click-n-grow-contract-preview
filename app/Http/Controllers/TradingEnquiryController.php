<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\TradingEnquiry;
use App\Services\ExpertVisitPricing;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class TradingEnquiryController extends Controller
{
    public function create(): View
    {
        return view('pages.trading-enquiry-form', $this->formData());
    }

    public function store(Request $request): RedirectResponse
    {
        $options = $this->formData();

        $validated = $request->validate([
            'company_name' => ['required', 'string', 'max:255'],
            'organization_type' => ['required', 'string', Rule::in($options['organizationTypes'])],
            'contact_person_name' => ['required', 'string', 'max:150'],
            'designation' => ['required', 'string', 'max:150'],
            'email' => ['required', 'email', 'max:150'],
            'mobile_country_code' => ['required', 'string', 'max:8'],
            'mobile' => ['required', 'regex:/^[6-9][0-9]{9}$/'],
            'website' => ['nullable', 'string', 'max:255'],
            'business_type' => ['required', 'string', Rule::in($options['businessTypes'])],
            'product_interest' => ['required', 'string', Rule::in($options['products'])],
            'expected_quantity' => ['required', 'string', Rule::in(array_keys($options['quantities']))],
            'inquiry_purposes' => ['required', 'array', 'min:1'],
            'inquiry_purposes.*' => ['string', Rule::in(array_keys($options['purposes']))],
            'company_address' => ['required', 'string', 'max:500'],
            'city' => ['required', 'string', 'max:120'],
            'state' => ['required', 'string', 'max:120'],
            'country' => ['required', 'string', Rule::in($options['countries'])],
            'pincode' => ['required', 'string', 'max:20'],
            'requirements' => ['required', 'string', 'max:2000'],
            'consent' => ['accepted'],
        ], [
            'mobile.regex' => 'Enter a valid 10-digit Indian mobile number.',
            'inquiry_purposes.required' => 'Select at least one purpose of inquiry.',
            'consent.accepted' => 'Please agree to be contacted regarding this inquiry.',
        ]);

        $website = $validated['website'] ?? null;
        if (is_string($website) && $website !== '' && ! Str::startsWith($website, ['http://', 'https://'])) {
            $website = 'https://'.$website;
        }

        TradingEnquiry::create([
            'company_name' => $validated['company_name'],
            'organization_type' => $validated['organization_type'],
            'contact_person_name' => $validated['contact_person_name'],
            'designation' => $validated['designation'],
            'email' => $validated['email'],
            'mobile_country_code' => $validated['mobile_country_code'],
            'mobile' => $validated['mobile'],
            'website' => $website,
            'business_type' => $validated['business_type'],
            'product_interest' => $validated['product_interest'],
            'expected_quantity' => $validated['expected_quantity'],
            'inquiry_purposes' => $validated['inquiry_purposes'],
            'company_address' => $validated['company_address'],
            'city' => $validated['city'],
            'state' => $validated['state'],
            'country' => $validated['country'],
            'pincode' => $validated['pincode'],
            'requirements' => $validated['requirements'],
            'consented_at' => now(),
        ]);

        return redirect()
            ->route('trading-enquiry-form')
            ->with('success', 'Your trading enquiry has been submitted successfully. Our team will get in touch with you shortly.');
    }

    private function formData(): array
    {
        $cropProducts = Crop::query()
            ->orderBy('name')
            ->pluck('name')
            ->filter()
            ->unique()
            ->values()
            ->all();

        $products = $cropProducts ?: [
            'Ashwagandha',
            'Tulsi',
            'Aloe Vera',
            'Shatavari',
            'Moringa',
            'Amla',
        ];
        $products[] = 'Multiple crops';
        $products[] = 'Other';

        return [
            'organizationTypes' => [
                'Herbal / Ayurvedic company',
                'Manufacturer',
                'Exporter',
                'Importer',
                'Trader / Wholesaler',
                'Distributor',
                'Retailer',
                'FPO / Cooperative',
                'Other',
            ],
            'businessTypes' => [
                'Buyer of raw materials',
                'Exporter',
                'Importer',
                'Manufacturer',
                'Brand / FMCG',
                'Distributor',
                'Business associate',
                'Other',
            ],
            'products' => $products,
            'quantities' => [
                'less_than_1_mt' => 'Less than 1 MT',
                '1_5_mt' => '1 – 5 MT',
                '5_10_mt' => '5 – 10 MT',
                '10_25_mt' => '10 – 25 MT',
                '25_50_mt' => '25 – 50 MT',
                '50_plus_mt' => '50+ MT',
                'to_be_discussed' => 'To be discussed',
            ],
            'purposes' => [
                'buy_raw_materials' => 'Buy Raw Materials',
                'export' => 'Export',
                'become_business_associate' => 'Become Business Associate',
                'other' => 'Other',
            ],
            'states' => ExpertVisitPricing::states(),
            'countries' => [
                'India',
                'United Arab Emirates',
                'United States',
                'United Kingdom',
                'Germany',
                'France',
                'Singapore',
                'Malaysia',
                'Australia',
                'Japan',
                'South Korea',
                'Bangladesh',
                'Nepal',
                'Sri Lanka',
                'Other',
            ],
        ];
    }
}
