<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin extends Authenticatable
{
    use HasFactory;
    protected $table = 'admins';
    //1st time password 12345678 below is hashed for DB password column
    //$2y$12$PRjP7EK7Pr/zv/aNg8YGPuymm/o66wCxvw1IUKOqUQtEtfLGGyg8.
    protected $fillable = ['name', 'email', 'password','status'];

    protected $hidden = ['password'];
}
