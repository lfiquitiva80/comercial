<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Year;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\YearController
 */
class YearControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $years = Year::factory()->count(3)->create();

        $response = $this->get(route('year.index'));

        $response->assertOk();
        $response->assertViewIs('year.index');
        $response->assertViewHas('years');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('year.create'));

        $response->assertOk();
        $response->assertViewIs('year.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\YearController::class,
            'store',
            \App\Http\Requests\YearStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $anio = $this->faker->word;

        $response = $this->post(route('year.store'), [
            'anio' => $anio,
        ]);

        $years = Year::query()
            ->where('anio', $anio)
            ->get();
        $this->assertCount(1, $years);
        $year = $years->first();

        $response->assertRedirect(route('year.index'));
        $response->assertSessionHas('year.id', $year->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $year = Year::factory()->create();

        $response = $this->get(route('year.show', $year));

        $response->assertOk();
        $response->assertViewIs('year.show');
        $response->assertViewHas('year');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $year = Year::factory()->create();

        $response = $this->get(route('year.edit', $year));

        $response->assertOk();
        $response->assertViewIs('year.edit');
        $response->assertViewHas('year');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\YearController::class,
            'update',
            \App\Http\Requests\YearUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $year = Year::factory()->create();
        $anio = $this->faker->word;

        $response = $this->put(route('year.update', $year), [
            'anio' => $anio,
        ]);

        $year->refresh();

        $response->assertRedirect(route('year.index'));
        $response->assertSessionHas('year.id', $year->id);

        $this->assertEquals($anio, $year->anio);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $year = Year::factory()->create();

        $response = $this->delete(route('year.destroy', $year));

        $response->assertRedirect(route('year.index'));

        $this->assertDeleted($year);
    }
}
