<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Presentation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\PresentationController
 */
class PresentationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $presentations = Presentation::factory()->count(3)->create();

        $response = $this->get(route('presentation.index'));

        $response->assertOk();
        $response->assertViewIs('presentation.index');
        $response->assertViewHas('presentations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('presentation.create'));

        $response->assertOk();
        $response->assertViewIs('presentation.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PresentationController::class,
            'store',
            \App\Http\Requests\PresentationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $presentacion = $this->faker->word;

        $response = $this->post(route('presentation.store'), [
            'presentacion' => $presentacion,
        ]);

        $presentations = Presentation::query()
            ->where('presentacion', $presentacion)
            ->get();
        $this->assertCount(1, $presentations);
        $presentation = $presentations->first();

        $response->assertRedirect(route('presentation.index'));
        $response->assertSessionHas('presentation.id', $presentation->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $presentation = Presentation::factory()->create();

        $response = $this->get(route('presentation.show', $presentation));

        $response->assertOk();
        $response->assertViewIs('presentation.show');
        $response->assertViewHas('presentation');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $presentation = Presentation::factory()->create();

        $response = $this->get(route('presentation.edit', $presentation));

        $response->assertOk();
        $response->assertViewIs('presentation.edit');
        $response->assertViewHas('presentation');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\PresentationController::class,
            'update',
            \App\Http\Requests\PresentationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $presentation = Presentation::factory()->create();
        $presentacion = $this->faker->word;

        $response = $this->put(route('presentation.update', $presentation), [
            'presentacion' => $presentacion,
        ]);

        $presentation->refresh();

        $response->assertRedirect(route('presentation.index'));
        $response->assertSessionHas('presentation.id', $presentation->id);

        $this->assertEquals($presentacion, $presentation->presentacion);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $presentation = Presentation::factory()->create();

        $response = $this->delete(route('presentation.destroy', $presentation));

        $response->assertRedirect(route('presentation.index'));

        $this->assertDeleted($presentation);
    }
}
