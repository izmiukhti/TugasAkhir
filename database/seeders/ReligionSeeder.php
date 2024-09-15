<?php

namespace Database\Seeders;

use App\Models\Religion;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ReligionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $religions = [
            ['name' => 'Islam'],
            ['name' => 'Protestant'],
            ['name' => 'Catholic'],
            ['name' => 'Hindu'],
            ['name' => 'Buddha'],
            ['name' => 'Confucian'],
            ['name' => 'Other'],
        ];

        foreach ($religions as $item) {
            Religion::create($item);
        }
    }
}
