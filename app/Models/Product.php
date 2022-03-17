<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
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
        'line_id',
        'marker_id',
        'brand_id',
        'presentation_id',
        'precio_iva',
        'observaciones',
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
        'line_id' => 'integer',
        'marker_id' => 'integer',
        'brand_id' => 'integer',
        'presentation_id' => 'integer',
        'precio_iva' => 'integer',
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

    public function line()
    {
        return $this->belongsTo(\App\Models\Line::class);
    }

    public function marker()
    {
        return $this->belongsTo(\App\Models\Maker::class);
    }

    public function brand()
    {
        return $this->belongsTo(\App\Models\Brand::class);
    }

    public function presentation()
    {
        return $this->belongsTo(\App\Models\Presentation::class);
    }

    public function precioIva()
    {
        return $this->belongsTo(\App\Models\PrecioIva::class);
    }

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
