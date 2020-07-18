<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class User extends Model
{
    protected $casts = [
        'phone_verified_at' => 'datetime',
    ];

    protected $hidden = [
        'password', 'remember_token', 'level'
    ];

    protected $fillable = [
        'name', 'username', 'phone', 'password', 'birthday'
    ];
}
