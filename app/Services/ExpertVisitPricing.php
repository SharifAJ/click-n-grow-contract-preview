<?php

namespace App\Services;

final class ExpertVisitPricing
{
    private const STATES = [
        'Andhra Pradesh',
        'Arunachal Pradesh',
        'Assam',
        'Bihar',
        'Chhattisgarh',
        'Goa',
        'Gujarat',
        'Haryana',
        'Himachal Pradesh',
        'Jharkhand',
        'Karnataka',
        'Kerala',
        'Madhya Pradesh',
        'Maharashtra',
        'Manipur',
        'Meghalaya',
        'Mizoram',
        'Nagaland',
        'Odisha',
        'Punjab',
        'Rajasthan',
        'Sikkim',
        'Tamil Nadu',
        'Telangana',
        'Tripura',
        'Uttar Pradesh',
        'Uttarakhand',
        'West Bengal',
        'Andaman and Nicobar Islands',
        'Chandigarh',
        'Dadra and Nagar Haveli and Daman and Diu',
        'Delhi',
        'Jammu and Kashmir',
        'Ladakh',
        'Lakshadweep',
        'Puducherry',
    ];

    private const SURROUNDING_STATES = [
        'Madhya Pradesh',
        'Chhattisgarh',
        'Gujarat',
        'Karnataka',
        'Telangana',
    ];

    public static function states(): array
    {
        return self::STATES;
    }

    public static function stateRates(): array
    {
        return array_combine(
            self::STATES,
            array_map(self::rateForState(...), self::STATES)
        );
    }

    public static function rateForState(string $state): int
    {
        if ($state === 'Maharashtra') {
            return 5000;
        }

        if (in_array($state, self::SURROUNDING_STATES, true)) {
            return 7000;
        }

        return 10000;
    }

    public static function feeGroups(): array
    {
        return [
            [
                'label' => 'Maharashtra',
                'states' => ['Maharashtra'],
                'rate' => 5000,
            ],
            [
                'label' => 'Surrounding States',
                'states' => self::SURROUNDING_STATES,
                'rate' => 7000,
            ],
            [
                'label' => 'Other States and Union Territories',
                'states' => ['All remaining states and Union Territories'],
                'rate' => 10000,
            ],
        ];
    }
}
