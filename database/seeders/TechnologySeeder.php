<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use App\Models\Technology;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for($i=0; $i<5; $i++){

            $newTechnology = new Technology();
            $newTechnology->name = $faker->sentence(2);
            $newTechnology->slug = Str::slug($newTechnology->name, '-');
            $newTechnology->save();

        }
    }
}
