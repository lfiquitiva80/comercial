<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Client;
use App\Models\Exercise;
use App\Models\Month;
use App\Models\User;
use App\Models\Year;

class ExerciseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Exercise::class;

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
            'direccion' => $this->faker->word,
            'ciudad' => $this->faker->word,
            'observaciones' => $this->faker->text,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'map' => $this->faker->word,
            'user_id' => User::factory(),
        ];
    }
}
