<?php

namespace Database\Seeders;

use App\Models\Role;
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
        Role::insert([
            [
                'name' => 'SuperAdmin',
                'description' => 'Full access to system features including user, role, permission, and recruitment management.',
            ],
            [
                'name' => 'Admin',
                'description' => 'Manage recruitment data: divisions, categories, opportunities, applicants, and reports.',
            ],
            [
                'name' => 'Staff',
                'description' => 'Handle applicant assessments (CV Screening, Psychotest, Interview) and view related data.'
            ]
        ]);

        User::insert([
            [
                'name' => 'Administrator',
                'email' => 'administrator@schooltech.biz.id',
                'password' => Hash::make('password'),
                'roles_id' => 1,
                'email_verified_at' => now(),
                'phone_number' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Admin',
                'email' => 'admin@schooltech.biz.id',
                'password' => Hash::make('password'),
                'roles_id' => 2,
                'email_verified_at' => now(),
                'phone_number' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Staff',
                'email' => 'staff@schooltech.biz.id',
                'password' => Hash::make('password'),
                'roles_id' => 3,
                'email_verified_at' => now(),
                'phone_number' => '081234567890',
                'created_at' => now(),
                'updated_at' => now(),
            ],
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
            DecisionSeeder::class,
            PermissionSeeder::class
        ]);
    }
}