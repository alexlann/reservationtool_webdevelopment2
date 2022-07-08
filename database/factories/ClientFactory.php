<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'address_id' =>$this->faker->unique()->numberBetween(1, 100),
            'title' => $this->faker->title(),
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'image' => "https://images.pexels.com/photos/5137980/pexels-photo-5137980.jpeg", //faker images site not working at the moment
            // 'image' => $this->faker->image(null, 360, 360, null, true, true, 'person', false),
        ];
    }
}
