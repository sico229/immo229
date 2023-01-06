<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Annonce;
use App\Models\Images;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //   User::factory(10)->create();
        //   Annonce::factory(20)->create();
        //   Images::factory(20)->create();
        User::factory()->count(50)->has(Annonce::factory()->count(rand(1,3))->has(Images::factory()->count(rand(1,5))))->create();
    }
}
