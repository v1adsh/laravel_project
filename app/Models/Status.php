<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

/**
 * @property integer $status Статус
 * @property string $name Название статуса
 */

class Status extends Model
{
    use HasFactory, Notifiable;

    public $timestamps = false;

    protected $table = 'status';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status',
        'name',
    ];

    public function application(){
        return $this->belongsTo('App\Application');
    }
}
