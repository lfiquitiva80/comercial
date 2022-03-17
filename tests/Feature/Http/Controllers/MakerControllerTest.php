<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Maker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\MakerController
 */
class MakerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $makers = Maker::factory()->count(3)->create();

        $response = $this->get(route('maker.index'));

        $response->assertOk();
        $response->assertViewIs('maker.index');
        $response->assertViewHas('makers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('maker.create'));

        $response->assertOk();
        $response->assertViewIs('maker.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MakerController::class,
            'store',
            \App\Http\Requests\MakerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $fabricante = $this->faker->word;

        $response = $this->post(route('maker.store'), [
            'fabricante' => $fabricante,
        ]);

        $makers = Maker::query()
            ->where('fabricante', $fabricante)
            ->get();
        $this->assertCount(1, $makers);
        $maker = $makers->first();

        $response->assertRedirect(route('maker.index'));
        $response->assertSessionHas('maker.id', $maker->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $maker = Maker::factory()->create();

        $response = $this->get(route('maker.show', $maker));

        $response->assertOk();
        $response->assertViewIs('maker.show');
        $response->assertViewHas('maker');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $maker = Maker::factory()->create();

        $response = $this->get(route('maker.edit', $maker));

        $response->assertOk();
        $response->assertViewIs('maker.edit');
        $response->assertViewHas('maker');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\MakerController::class,
            'update',
            \App\Http\Requests\MakerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $maker = Maker::factory()->create();
        $fabricante = $this->faker->word;

        $response = $this->put(route('maker.update', $maker), [
            'fabricante' => $fabricante,
        ]);

        $maker->refresh();

        $response->assertRedirect(route('maker.index'));
        $response->assertSessionHas('maker.id', $maker->id);

        $this->assertEquals($fabricante, $maker->fabricante);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $maker = Maker::factory()->create();

        $response = $this->delete(route('maker.destroy', $maker));

        $response->assertRedirect(route('maker.index'));

        $this->assertDeleted($maker);
    }
}
