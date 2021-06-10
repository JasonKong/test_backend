<?php

namespace Database\Seeders;

use App\Models\Category;
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
            $category_id = rand(1,3);
            $category = Category::find($category_id);
            $sub_categories = $category->subCategories;
            Product::create([
                'category_id' => $category_id,
                'sub_category_id' =>$sub_categories[rand(0,2)]->id,
                'name' => $faker->word,
                'description' => $faker->sentence,
            ]);
        }
    }
}
