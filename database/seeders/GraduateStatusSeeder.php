<?php

namespace Database\Seeders;

use App\Models\GraduatedStatus;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class GraduateStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $graduateStatuses = [
            ['name' => 'Graduated'],
            ['name' => 'Not Graduated'],
        ];

        foreach ($graduateStatuses as $item) {
            GraduatedStatus::create($item);
        }
    }
}
