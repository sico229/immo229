<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ImagesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'annonce_id'=>rand(1,10),
            'url' => ["https://random.imagecdn.app/500/150","https://random.dog/","https://source.unsplash.com/random"][rand(0,2)]
        ];
    }
}
