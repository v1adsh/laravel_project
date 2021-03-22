<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $user_id
 * @property integer $review_rating_id
 * @property integer $datetime
 * @property string $description
 */

class Review extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'review';

    protected $hidden = ['user_id', 'review_rating_id', 'datetime'];

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
}
