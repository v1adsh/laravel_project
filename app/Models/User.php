<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable

{
    use HasFactory, Notifiable, HasApiTokens;

    public $timestamps = false;

    protected $table = 'user';

    protected $hidden = ['password', 'api_token', 'role_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'login',
        'password',
        'email',
        'number_phone',
        'api_token',
        'role_id'
    ];
}
