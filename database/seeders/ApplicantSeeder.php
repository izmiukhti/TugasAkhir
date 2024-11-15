<?php

namespace Database\Seeders;

use App\Models\Applicant;
use Illuminate\Database\Seeder;

class ApplicantSeeder extends Seeder
{
    public function run()
    {
        // Menggunakan insert untuk menambahkan beberapa data
        Applicant::insert([
            [
                'id' => 1,
                'opportunity_id' => 'OPP123',
                'name' => 'Andi Wijaya',
                'email' => 'andi.wijaya@example.com',
                'phone_number' => '081234567890',
                'gender_id' => 'G001',
                'birth_date' => '1995-05-15',
                'domicile_address' => 'Jl. Merdeka No. 1, Jakarta',
                'religion_id' => 'R001',
                'marital_id' => 'M001',
                'education_id' => 'E001',
                'education_institution' => 'Universitas Indonesia',
                'majority' => 'Teknik Informatika',
                'gpa' => '3.75',
                'graduate_status' => 'lulus',
                'graduate_year' => '2018',
                'information_from' => 'Website Resmi',
                'portfolio_link' => 'https://andiwijaya.com',
                'cv_file' => 'cv_andi_wijaya.pdf',
            ],
            [
                'id' => 2,
                'opportunity_id' => 'OPP124',
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@example.com',
                'phone_number' => '082345678901',
                'gender_id' => 'G002',
                'birth_date' => '1996-07-20',
                'domicile_address' => 'Jl. Kemerdekaan No. 2, Bandung',
                'religion_id' => 'R002',
                'marital_id' => 'M002',
                'education_id' => 'E002',
                'education_institution' => 'Institut Teknologi Bandung',
                'majority' => 'Sistem Informasi',
                'gpa' => '3.60',
                'graduate_status' => 'lulus',
                'graduate_year' => '2019',
                'information_from' => 'Teman',
                'portfolio_link' => 'https://budisantoso.com',
                'cv_file' => 'cv_budi_santoso.pdf',
            ],
            // Tambahkan lebih banyak data sesuai kebutuhan
        ]);
    }
}
