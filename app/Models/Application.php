<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $user_id Идентификатор пользователя
 * @property integer $status_id Идентификатор статуса
 * @property string $description Текст заявки
 */

class Application extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'application';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'user_id',
        'status_id',
        'description',
    ];
}
