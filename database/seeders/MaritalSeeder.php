<?php

namespace Database\Seeders;

use App\Models\Marital;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MaritalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $maritals = [
            ['name' => 'Married'],
            ['name' => 'Not Married'],
        ];

        foreach ($maritals as $item) {
            Marital::create($item);
        }
    }
}
