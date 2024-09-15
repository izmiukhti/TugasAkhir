<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SourceInformation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SourceInformationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sourceInformations = [
            ['name' => 'Family'],
            ['name' => 'Friend'],
            ['name' => 'Social Media'],
            ['name' => 'Website'],
            ['name' => 'Event'],
            ['name' => 'Lecture'],
            ['name' => 'Other'],
        ];

        foreach ($sourceInformations as $item) {
            SourceInformation::create($item);
        }
    }
}
