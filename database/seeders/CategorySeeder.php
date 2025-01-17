<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Historia', 'Fantasy', 'Kryminał', 'Nauka', 'Biografia', 'Thriller', 'Powieść'];
        foreach ($categories as $category) {
            \App\Models\Category::create(['name' => $category]);
        }
    }
}

