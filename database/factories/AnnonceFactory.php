<?php

namespace Database\Factories;

use SicoHelpers\Helpers;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class AnnonceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            "user_id"=>rand(1,11),
            "typeAnnonce"=>['Location','Vente','Recherche'][rand(0,2)],
            "typeConstruction"=>['Entrée-Coucher','Chanbre-Salon','Appartement Simple','Appartement Meublé','Boutique'][rand(0,4)],
            "numeroAnnonce"=>Helpers::tokener("number",6),
            "quartier"=>$this->faker->city(),
            "ville"=>$this->faker->city(),
            "description"=>$this->faker->sentence(rand(4,10)),
            "status"=>$this->faker->boolean(80),
            "likes"=>rand(0,35),
            "datePublication"=>$this->faker->dateTime()->format('d/m H:i'),
            
            "loyer"=>rand(7000,200000),
            "token"=>Str::random(60)
        ];
    }
}
