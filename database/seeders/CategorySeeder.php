<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

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
            Categories::create($category);
        }
    }
}
