<?php

namespace Database\Seeders;

use App\Models\Schema;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SchemaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $schemas = [
            ['name' => 'Work From Anywhere'],
            ['name' => 'Work From Office'],
            ['name' => 'Hybrid'],
        ];

        foreach ($schemas as $schema) {
            Schema::create($schema);
        }
    }
}
