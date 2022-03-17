<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Chief;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\SellerController
 */
class SellerControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $sellers = Seller::factory()->count(3)->create();

        $response = $this->get(route('seller.index'));

        $response->assertOk();
        $response->assertViewIs('seller.index');
        $response->assertViewHas('sellers');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('seller.create'));

        $response->assertOk();
        $response->assertViewIs('seller.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SellerController::class,
            'store',
            \App\Http\Requests\SellerStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $vendedores = $this->faker->word;
        $chief = Chief::factory()->create();

        $response = $this->post(route('seller.store'), [
            'vendedores' => $vendedores,
            'chief_id' => $chief->id,
        ]);

        $sellers = Seller::query()
            ->where('vendedores', $vendedores)
            ->where('chief_id', $chief->id)
            ->get();
        $this->assertCount(1, $sellers);
        $seller = $sellers->first();

        $response->assertRedirect(route('seller.index'));
        $response->assertSessionHas('seller.id', $seller->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $seller = Seller::factory()->create();

        $response = $this->get(route('seller.show', $seller));

        $response->assertOk();
        $response->assertViewIs('seller.show');
        $response->assertViewHas('seller');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $seller = Seller::factory()->create();

        $response = $this->get(route('seller.edit', $seller));

        $response->assertOk();
        $response->assertViewIs('seller.edit');
        $response->assertViewHas('seller');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\SellerController::class,
            'update',
            \App\Http\Requests\SellerUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $seller = Seller::factory()->create();
        $vendedores = $this->faker->word;
        $chief = Chief::factory()->create();

        $response = $this->put(route('seller.update', $seller), [
            'vendedores' => $vendedores,
            'chief_id' => $chief->id,
        ]);

        $seller->refresh();

        $response->assertRedirect(route('seller.index'));
        $response->assertSessionHas('seller.id', $seller->id);

        $this->assertEquals($vendedores, $seller->vendedores);
        $this->assertEquals($chief->id, $seller->chief_id);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $seller = Seller::factory()->create();

        $response = $this->delete(route('seller.destroy', $seller));

        $response->assertRedirect(route('seller.index'));

        $this->assertDeleted($seller);
    }
}
