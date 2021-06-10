<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('sub_categories')->insert([
            [
                'category_id' => '1',
                'name' => 'Lenovo'
            ],
            [
                'category_id' => '1',
                'name' => 'Dell'
            ],
            [
                'category_id' => '1',
                'name' => 'Asus'
            ],
            [
                'category_id' => '2',
                'name' => 'HP'
            ],
            [
                'category_id' => '2',
                'name' => 'Google'
            ],
            [
                'category_id' => '2',
                'name' => 'Microsoft'
            ],
            [
                'category_id' => '3',
                'name' => 'Apple'
            ],
            [
                'category_id' => '3',
                'name' => 'Xiaomi'
            ],
            [
                'category_id' => '3',
                'name' => 'Huawei'
            ],
        ]);
    }
}
