<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Opportunity extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $fillable = [
        'name',
        'description',
        'job_description',
        'job_requirements',
        'clicked',
        'quota',
        'location',
        'division_id',
        'category_id',
        'schema_id',
        'start_date',
        'end_date',
    ];
}
