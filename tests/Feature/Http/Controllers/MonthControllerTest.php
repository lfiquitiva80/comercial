<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Month;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MonthController
 */
class MonthControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $months = Month::factory()->count(3)->create();

        $response = $this->get(route('month.index'));

        $response->assertOk();
        $response->assertViewIs('month.index');
        $response->assertViewHas('months');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('month.create'));

        $response->assertOk();
        $response->assertViewIs('month.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MonthController::class,
            'store',
            \App\Http\Requests\MonthStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $mes = $this->faker->word;

        $response = $this->post(route('month.store'), [
            'mes' => $mes,
        ]);

        $months = Month::query()
            ->where('mes', $mes)
            ->get();
        $this->assertCount(1, $months);
        $month = $months->first();

        $response->assertRedirect(route('month.index'));
        $response->assertSessionHas('month.id', $month->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $month = Month::factory()->create();

        $response = $this->get(route('month.show', $month));

        $response->assertOk();
        $response->assertViewIs('month.show');
        $response->assertViewHas('month');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $month = Month::factory()->create();

        $response = $this->get(route('month.edit', $month));

        $response->assertOk();
        $response->assertViewIs('month.edit');
        $response->assertViewHas('month');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MonthController::class,
            'update',
            \App\Http\Requests\MonthUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $month = Month::factory()->create();
        $mes = $this->faker->word;

        $response = $this->put(route('month.update', $month), [
            'mes' => $mes,
        ]);

        $month->refresh();

        $response->assertRedirect(route('month.index'));
        $response->assertSessionHas('month.id', $month->id);

        $this->assertEquals($mes, $month->mes);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $month = Month::factory()->create();

        $response = $this->delete(route('month.destroy', $month));

        $response->assertRedirect(route('month.index'));

        $this->assertDeleted($month);
    }
}
