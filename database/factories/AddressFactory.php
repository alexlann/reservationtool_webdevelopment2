<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'street' => $this->faker->streetAddress(),
            'zipcode' => $this->faker->postcode(),
            'city' => $this->faker->city(),
            'province' => $this->faker->state(),
            'country_code' => $this->faker->countryCode(),
        ];
    }
}
