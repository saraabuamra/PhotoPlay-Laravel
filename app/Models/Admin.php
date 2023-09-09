<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authentictable;


class Admin extends Authentictable
{
    use HasFactory;
    protected $guard = 'admin';

}
