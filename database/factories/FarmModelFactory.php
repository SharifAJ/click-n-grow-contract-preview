<?php

namespace Database\Factories;

use App\Models\FarmModel;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class FarmModelFactory extends Factory
{
    protected $model = FarmModel::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'farm_id' => $this->faker->unique()->regexify('[0-9]{6}'), // Example: "ABC123"
            'name' => $this->faker->company . ' Farm',
            'croptype' => Arr::random(['Apple', 'Cherry Tomato', 'Wheat', 'Corn', 'Rice']),
            'category' => 'farm',
            'sowingdate' => $this->faker->dateTimeBetween('-1 year', '+1 year')->format('d-m-Y'),
            'crop_variety' => $this->faker->word,
            'area' => $this->faker->randomFloat(2, 1, 100),
            'center' => [
                $this->faker->latitude,
                $this->faker->longitude,
            ],
            'district' => $this->faker->city,
            'state' => $this->faker->state,
            'geo_json' => [
                'geometry' => [
                    'coordinates' => [
                        [
                            [$this->faker->longitude, $this->faker->latitude],
                            [$this->faker->longitude, $this->faker->latitude],
                            [$this->faker->longitude, $this->faker->latitude],
                            [$this->faker->longitude, $this->faker->latitude],
                            [$this->faker->longitude, $this->faker->latitude],
                        ],
                    ],
                    'type' => 'Polygon',
                ],
                'properties' => [
                    'name' => 'urn:ogc:def:crs:OGC:1.3:CRS84',
                ],
                'type' => 'Feature',
            ],
            'geometry_type' => 'Polygon',
            'status' => Arr::random(['active', 'inactive']),
            // 'last_satellite_api_check' => $this->faker->optional()->dateTimeThisYear(),
            'last_satellite_api_check' => null,
            'type' => 'FeatureCollection',
            // 'user_id' => \App\Models\User::factory(),
            'user_id' => $this->faker->numberBetween(1, 2),
        ];
    }
}
