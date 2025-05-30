<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporting extends Model
{
    use HasFactory;

    protected $table = 'reportings';
    protected $fillable = [
        'applicant_id',
        'decision_id'
    ];

    public function applicant()
    {
        return $this->belongsTo(Applicants::class, 'applicant_id');
    }

    public function decision(){
        return $this->belongsTo(Decision::class);
    }
}