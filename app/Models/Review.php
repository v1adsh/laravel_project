<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $user_id Идентификатор пользователя
 * @property integer $review_rating_id Идентификатор оценки отзыва
 * @property integer $datetime Дата и время
 * @property string $description Описание
 */

class Review extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'review';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'review_rating_id',
        'datetime',
        'description',
    ];

    public function user(){
        return $this->belongsTo('App\Model\User');
    }

    public function reviewRating(){
        return $this->hasOne('App\Model\ReviewRating');
    }
}
