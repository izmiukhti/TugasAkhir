<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Fulltime', 'description' => 'Fulltime job'],
            ['name' => 'Parttime', 'description' => 'Parttime job'],
            ['name' => 'Freelance', 'description' => 'Freelance job'],
            ['name' => 'Internship', 'description' => 'Internship job'],
            ['name' => 'Temporary', 'description' => 'Temporary job'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
