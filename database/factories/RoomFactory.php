<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class RoomFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $randomString = $this->faker->words(2, true);

        return [
            'floor' => rand(0,4),
            'name' => $randomString,
            'slug' => Str::slug($randomString),
            'description' => $this->faker->realText(rand(10,20)),
            'image' => "https://images.pexels.com/photos/5137980/pexels-photo-5137980.jpeg", //faker images site not working at the moment
            //'image' => $this->faker->image(null, 360, 360, null, true, true, 'bedroom', false),
        ];
    }
}
