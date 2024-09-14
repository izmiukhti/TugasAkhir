<?php

namespace App\Models;

use App\Models\Opportunity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Division extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'description'];

    public function opportunities(){
        return $this->hasMany(Opportunity::class);
    }
}
