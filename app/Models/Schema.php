<?php

namespace App\Models;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schema extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function opportunities(){
        return $this->hasMany(Opportunity::class);
    }
}
