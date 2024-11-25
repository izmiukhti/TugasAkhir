<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\CategorySeeder;
use Database\Seeders\DivisionSeeder;
use Database\Seeders\ReligionSeeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Administrator',
            'email' => 'administrator@schooltech.biz.id',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
            'phone_number' => '081234567890',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->call([
            CategorySeeder::class,
            DivisionSeeder::class,
            SchemaSeeder::class,
            GenderSeeder::class,
            ReligionSeeder::class,
            MaritalSeeder::class,
            EducationSeeder::class,
            GraduateStatusSeeder::class,
            SourceInformationSeeder::class,
        ]);
    }
}
