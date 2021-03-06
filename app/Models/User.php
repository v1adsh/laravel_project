<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

/**
 * @property integer $id Идентификатор
 * @property string $login Логин пользователя
 * @property string $password Пароль пользователя
 * @property string $fio ФИО пользователя
 * @property string $email Email пользователя
 * @property string $number_phone Номер телефона пользователя
 * @property string $api_token Токен пользователя
 * @property integer $role_id Роль пользователя
 */

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    public $timestamps = false;

    protected $table = 'user';

    protected $hidden = ['password', 'role_id'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'login',
        'password',
        'fio',
        'email',
        'number_phone',
        'api_token',
        'role_id'
    ];

    public function application(){
        return $this->hasMany('App\Model\Application');
    }

    public function review(){
        return $this->hasMany('App\Model\Review');
    }
}
