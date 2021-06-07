<?php

namespace Database\Seeders;

use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Factory::create();
        foreach (range(1,30) as $i) {
            Product::create([
                'category_id' => rand(1,3),
                'name' => $faker->word,
                'description' => $faker->sentence,
            ]);
        }
    }
}
