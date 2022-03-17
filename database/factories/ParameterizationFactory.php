<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Channel;
use App\Models\Client;
use App\Models\Parameterization;
use App\Models\Region;
use App\Models\Seller;

class ParameterizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Parameterization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'client_id' => Client::factory(),
            'region_id' => Region::factory(),
            'channel_id' => Channel::factory(),
            'seller_id' => Seller::factory(),
            'observaciones' => $this->faker->text,
        ];
    }
}
