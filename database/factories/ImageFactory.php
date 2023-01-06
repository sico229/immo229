<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'url' => "https://random.imagecdn.app/500/150",
            'annonce_id' => rand(0,10),
        ];
    }
}
