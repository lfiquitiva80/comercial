<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Chief;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChiefController
 */
class ChiefControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $chiefs = Chief::factory()->count(3)->create();

        $response = $this->get(route('chief.index'));

        $response->assertOk();
        $response->assertViewIs('chief.index');
        $response->assertViewHas('chiefs');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('chief.create'));

        $response->assertOk();
        $response->assertViewIs('chief.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChiefController::class,
            'store',
            \App\Http\Requests\ChiefStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $jefes = $this->faker->word;

        $response = $this->post(route('chief.store'), [
            'jefes' => $jefes,
        ]);

        $chiefs = Chief::query()
            ->where('jefes', $jefes)
            ->get();
        $this->assertCount(1, $chiefs);
        $chief = $chiefs->first();

        $response->assertRedirect(route('chief.index'));
        $response->assertSessionHas('chief.id', $chief->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $chief = Chief::factory()->create();

        $response = $this->get(route('chief.show', $chief));

        $response->assertOk();
        $response->assertViewIs('chief.show');
        $response->assertViewHas('chief');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $chief = Chief::factory()->create();

        $response = $this->get(route('chief.edit', $chief));

        $response->assertOk();
        $response->assertViewIs('chief.edit');
        $response->assertViewHas('chief');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChiefController::class,
            'update',
            \App\Http\Requests\ChiefUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $chief = Chief::factory()->create();
        $jefes = $this->faker->word;

        $response = $this->put(route('chief.update', $chief), [
            'jefes' => $jefes,
        ]);

        $chief->refresh();

        $response->assertRedirect(route('chief.index'));
        $response->assertSessionHas('chief.id', $chief->id);

        $this->assertEquals($jefes, $chief->jefes);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $chief = Chief::factory()->create();

        $response = $this->delete(route('chief.destroy', $chief));

        $response->assertRedirect(route('chief.index'));

        $this->assertDeleted($chief);
    }
}
