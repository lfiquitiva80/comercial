<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Line;
use App\Models\Marker;
use App\Models\Month;
use App\Models\PrecioIva;
use App\Models\Presentation;
use App\Models\Product;
use App\Models\User;
use App\Models\Year;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'year_id' => Year::factory(),
            'month_id' => Month::factory(),
            'client_id' => Client::factory(),
            'line_id' => Line::factory(),
            'marker_id' => Marker::factory(),
            'brand_id' => Brand::factory(),
            'presentation_id' => Presentation::factory(),
            'precio_iva' => PrecioIva::factory(),
            'observaciones' => $this->faker->text,
            'user_id' => User::factory(),
        ];
    }
}
