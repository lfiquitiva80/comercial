<?php

namespace Tests\Feature\Http\Controllers;

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
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('product.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
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
        $line = Line::factory()->create();
        $marker = Marker::factory()->create();
        $brand = Brand::factory()->create();
        $presentation = Presentation::factory()->create();
        $precio_iva = PrecioIva::factory()->create();
        $observaciones = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->post(route('product.store'), [
            'year_id' => $year->id,
            'month_id' => $month->id,
            'client_id' => $client->id,
            'line_id' => $line->id,
            'marker_id' => $marker->id,
            'brand_id' => $brand->id,
            'presentation_id' => $presentation->id,
            'precio_iva' => $precio_iva->id,
            'observaciones' => $observaciones,
            'user_id' => $user->id,
        ]);

        $products = Product::query()
            ->where('year_id', $year->id)
            ->where('month_id', $month->id)
            ->where('client_id', $client->id)
            ->where('line_id', $line->id)
            ->where('marker_id', $marker->id)
            ->where('brand_id', $brand->id)
            ->where('presentation_id', $presentation->id)
            ->where('precio_iva', $precio_iva->id)
            ->where('observaciones', $observaciones)
            ->where('user_id', $user->id)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $product = Product::factory()->create();

        $response = $this->get(route('product.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $product = Product::factory()->create();
        $year = Year::factory()->create();
        $month = Month::factory()->create();
        $client = Client::factory()->create();
        $line = Line::factory()->create();
        $marker = Marker::factory()->create();
        $brand = Brand::factory()->create();
        $presentation = Presentation::factory()->create();
        $precio_iva = PrecioIva::factory()->create();
        $observaciones = $this->faker->text;
        $user = User::factory()->create();

        $response = $this->put(route('product.update', $product), [
            'year_id' => $year->id,
            'month_id' => $month->id,
            'client_id' => $client->id,
            'line_id' => $line->id,
            'marker_id' => $marker->id,
            'brand_id' => $brand->id,
            'presentation_id' => $presentation->id,
            'precio_iva' => $precio_iva->id,
            'observaciones' => $observaciones,
            'user_id' => $user->id,
        ]);

        $product->refresh();

        $response->assertRedirect(route('product.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($year->id, $product->year_id);
        $this->assertEquals($month->id, $product->month_id);
        $this->assertEquals($client->id, $product->client_id);
        $this->assertEquals($line->id, $product->line_id);
        $this->assertEquals($marker->id, $product->marker_id);
        $this->assertEquals($brand->id, $product->brand_id);
        $this->assertEquals($presentation->id, $product->presentation_id);
        $this->assertEquals($precio_iva->id, $product->precio_iva);
        $this->assertEquals($observaciones, $product->observaciones);
        $this->assertEquals($user->id, $product->user_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('product.destroy', $product));

        $response->assertRedirect(route('product.index'));

        $this->assertDeleted($product);
    }
}
