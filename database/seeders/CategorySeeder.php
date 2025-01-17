<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::create(['name' => 'Historia']);
        Category::create(['name' => 'Fantasy']);
        Category::create(['name' => 'Kryminał']);
    }
}

