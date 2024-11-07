<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantsModel extends Model
{
    use HasFactory;

    // Tabel yang digunakan oleh model ini
    protected $table = 'applicants';

    // Kolom yang dapat diisi secara massal
    protected $fillable = [
        'opportunity_id',
        'name',
        'email',
        'phone_number',
        'gender_id',
        'birth_date',
        'domicile_address',
        'religion_id',
        'marital_id',
        'education_id',
        'education_institution',
        'majority',
        'gpa',
        'graduate_status',
        'graduate_year',
        'information_from',
        'portfolio_link',
        'cv_file',
    ];

    // Relasi dengan model lain (optional jika ada foreign key)

    // Relasi ke tabel Gender
    public function gender()
    {
        return $this->belongsTo(Gender::class);
    }

    // Relasi ke tabel Religion
    public function religion()
    {
        return $this->belongsTo(Religion::class);
    }

    // Relasi ke tabel Marital Status
    public function marital()
    {
        return $this->belongsTo(Marital::class);
    }

    // Relasi ke tabel Education
    public function education()
    {
        return $this->belongsTo(Education::class);
    }
}
