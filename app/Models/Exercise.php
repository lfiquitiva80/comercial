<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'year_id',
        'month_id',
        'client_id',
        'direccion',
        'ciudad',
        'observaciones',
        'latitude',
        'longitude',
        'map',
        'user_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'year_id' => 'integer',
        'month_id' => 'integer',
        'client_id' => 'integer',
        'user_id' => 'integer',
    ];


    public function year()
    {
        return $this->belongsTo(\App\Models\Year::class);
    }

    public function month()
    {
        return $this->belongsTo(\App\Models\Month::class);
    }

    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
