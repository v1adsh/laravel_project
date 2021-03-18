<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

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
        'name',
    ];
}
