<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'roles_id',
        'password',
        'phone_number',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Role (Many to Many)
    public function role()
    {
        return $this->belongsTo(Role::class, 'roles_id', 'id');
    }

    // Relasi ke Permission melalui Role
    public function permissions()
    {
        return $this->roles()->with('permissions')->get()
            ->pluck('permissions')
            ->flatten()
            ->unique('id');
    }
}