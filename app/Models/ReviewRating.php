<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $estimation Оценка
 * @property integer $user_id Идентификатор пользователя
 * @property integer $review_id Идентификатор отзыва
 */

class ReviewRating extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'review_rating';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estimation',
        'user_id',
        'review_id',
    ];

    public function review(){
        return $this->belongsTo('App\Models\Review');
    }
}
