<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    const ROLE_ADMIN = 'admin';
    const ROLE_CUSTOMER = 'customer';
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status',
        'phone',
        'address',
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
    // Kiểm tra role người dùng
    public function isRoleAdmin() 
    {
        return $this->role === self::ROLE_ADMIN;
    }
    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
