<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Client;
use App\Models\Exercise;
use App\Models\Month;
use App\Models\User;
use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ExerciseController
 */
class ExerciseControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $exercises = Exercise::factory()->count(3)->create();

        $response = $this->get(route('exercise.index'));

        $response->assertOk();
        $response->assertViewIs('exercise.index');
        $response->assertViewHas('exercises');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('exercise.create'));

        $response->assertOk();
        $response->assertViewIs('exercise.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExerciseController::class,
            'store',
            \App\Http\Requests\ExerciseStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $year = Year::factory()->create();
        $month = Month::factory()->create();
        $client = Client::factory()->create();
        $direccion = $this->faker->word;
        $ciudad = $this->faker->word;
        $observaciones = $this->faker->text;
        $latitude = $this->faker->latitude;
        $longitude = $this->faker->longitude;
        $map = $this->faker->word;
        $user = User::factory()->create();

        $response = $this->post(route('exercise.store'), [
            'year_id' => $year->id,
            'month_id' => $month->id,
            'client_id' => $client->id,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'observaciones' => $observaciones,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'map' => $map,
            'user_id' => $user->id,
        ]);

        $exercises = Exercise::query()
            ->where('year_id', $year->id)
            ->where('month_id', $month->id)
            ->where('client_id', $client->id)
            ->where('direccion', $direccion)
            ->where('ciudad', $ciudad)
            ->where('observaciones', $observaciones)
            ->where('latitude', $latitude)
            ->where('longitude', $longitude)
            ->where('map', $map)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $exercises);
        $exercise = $exercises->first();

        $response->assertRedirect(route('exercise.index'));
        $response->assertSessionHas('exercise.id', $exercise->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->get(route('exercise.show', $exercise));

        $response->assertOk();
        $response->assertViewIs('exercise.show');
        $response->assertViewHas('exercise');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->get(route('exercise.edit', $exercise));

        $response->assertOk();
        $response->assertViewIs('exercise.edit');
        $response->assertViewHas('exercise');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ExerciseController::class,
            'update',
            \App\Http\Requests\ExerciseUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $exercise = Exercise::factory()->create();
        $year = Year::factory()->create();
        $month = Month::factory()->create();
        $client = Client::factory()->create();
        $direccion = $this->faker->word;
        $ciudad = $this->faker->word;
        $observaciones = $this->faker->text;
        $latitude = $this->faker->latitude;
        $longitude = $this->faker->longitude;
        $map = $this->faker->word;
        $user = User::factory()->create();

        $response = $this->put(route('exercise.update', $exercise), [
            'year_id' => $year->id,
            'month_id' => $month->id,
            'client_id' => $client->id,
            'direccion' => $direccion,
            'ciudad' => $ciudad,
            'observaciones' => $observaciones,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'map' => $map,
            'user_id' => $user->id,
        ]);

        $exercise->refresh();

        $response->assertRedirect(route('exercise.index'));
        $response->assertSessionHas('exercise.id', $exercise->id);

        $this->assertEquals($year->id, $exercise->year_id);
        $this->assertEquals($month->id, $exercise->month_id);
        $this->assertEquals($client->id, $exercise->client_id);
        $this->assertEquals($direccion, $exercise->direccion);
        $this->assertEquals($ciudad, $exercise->ciudad);
        $this->assertEquals($observaciones, $exercise->observaciones);
        $this->assertEquals($latitude, $exercise->latitude);
        $this->assertEquals($longitude, $exercise->longitude);
        $this->assertEquals($map, $exercise->map);
        $this->assertEquals($user->id, $exercise->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $exercise = Exercise::factory()->create();

        $response = $this->delete(route('exercise.destroy', $exercise));

        $response->assertRedirect(route('exercise.index'));

        $this->assertDeleted($exercise);
    }
}
