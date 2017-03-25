<?php

namespace App\Models;

use Vendor\Database\Model;

class User extends Model
{
    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password'];

    protected $hidden = ['password'];
}