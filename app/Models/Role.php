<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $role Роль
 * @property string $name Название роли
 */


class Role extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'role',
        'name',
    ];
}
