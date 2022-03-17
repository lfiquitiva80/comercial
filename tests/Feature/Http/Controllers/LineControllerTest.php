<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Line;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\LineController
 */
class LineControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $lines = Line::factory()->count(3)->create();

        $response = $this->get(route('line.index'));

        $response->assertOk();
        $response->assertViewIs('line.index');
        $response->assertViewHas('lines');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('line.create'));

        $response->assertOk();
        $response->assertViewIs('line.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LineController::class,
            'store',
            \App\Http\Requests\LineStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $linea = $this->faker->word;
        $category = Category::factory()->create();

        $response = $this->post(route('line.store'), [
            'linea' => $linea,
            'category_id' => $category->id,
        ]);

        $lines = Line::query()
            ->where('linea', $linea)
            ->where('category_id', $category->id)
            ->get();
        $this->assertCount(1, $lines);
        $line = $lines->first();

        $response->assertRedirect(route('line.index'));
        $response->assertSessionHas('line.id', $line->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $line = Line::factory()->create();

        $response = $this->get(route('line.show', $line));

        $response->assertOk();
        $response->assertViewIs('line.show');
        $response->assertViewHas('line');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $line = Line::factory()->create();

        $response = $this->get(route('line.edit', $line));

        $response->assertOk();
        $response->assertViewIs('line.edit');
        $response->assertViewHas('line');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\LineController::class,
            'update',
            \App\Http\Requests\LineUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $line = Line::factory()->create();
        $linea = $this->faker->word;
        $category = Category::factory()->create();

        $response = $this->put(route('line.update', $line), [
            'linea' => $linea,
            'category_id' => $category->id,
        ]);

        $line->refresh();

        $response->assertRedirect(route('line.index'));
        $response->assertSessionHas('line.id', $line->id);

        $this->assertEquals($linea, $line->linea);
        $this->assertEquals($category->id, $line->category_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $line = Line::factory()->create();

        $response = $this->delete(route('line.destroy', $line));

        $response->assertRedirect(route('line.index'));

        $this->assertDeleted($line);
    }
}
