<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sub_category = new \App\Models\SubCategory();
        $sub_category->name = "TEST SUB CAT";
        $sub_category->category_id = 1;
        $sub_category->save();


    }
}