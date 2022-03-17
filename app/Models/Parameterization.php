<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameterization extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id',
        'region_id',
        'channel_id',
        'seller_id',
        'observaciones',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'client_id' => 'integer',
        'region_id' => 'integer',
        'channel_id' => 'integer',
        'seller_id' => 'integer',
    ];


    public function client()
    {
        return $this->belongsTo(\App\Models\Client::class);
    }

    public function region()
    {
        return $this->belongsTo(\App\Models\Region::class);
    }

    public function channel()
    {
        return $this->belongsTo(\App\Models\Channel::class);
    }

    public function seller()
    {
        return $this->belongsTo(\App\Models\Seller::class);
    }
}
