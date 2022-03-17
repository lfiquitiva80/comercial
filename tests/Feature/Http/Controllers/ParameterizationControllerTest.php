<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Channel;
use App\Models\Client;
use App\Models\Parameterization;
use App\Models\Region;
use App\Models\Seller;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ParameterizationController
 */
class ParameterizationControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $parameterizations = Parameterization::factory()->count(3)->create();

        $response = $this->get(route('parameterization.index'));

        $response->assertOk();
        $response->assertViewIs('parameterization.index');
        $response->assertViewHas('parameterizations');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('parameterization.create'));

        $response->assertOk();
        $response->assertViewIs('parameterization.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ParameterizationController::class,
            'store',
            \App\Http\Requests\ParameterizationStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $client = Client::factory()->create();
        $region = Region::factory()->create();
        $channel = Channel::factory()->create();
        $seller = Seller::factory()->create();
        $observaciones = $this->faker->text;

        $response = $this->post(route('parameterization.store'), [
            'client_id' => $client->id,
            'region_id' => $region->id,
            'channel_id' => $channel->id,
            'seller_id' => $seller->id,
            'observaciones' => $observaciones,
        ]);

        $parameterizations = Parameterization::query()
            ->where('client_id', $client->id)
            ->where('region_id', $region->id)
            ->where('channel_id', $channel->id)
            ->where('seller_id', $seller->id)
            ->where('observaciones', $observaciones)
            ->get();
        $this->assertCount(1, $parameterizations);
        $parameterization = $parameterizations->first();

        $response->assertRedirect(route('parameterization.index'));
        $response->assertSessionHas('parameterization.id', $parameterization->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $parameterization = Parameterization::factory()->create();

        $response = $this->get(route('parameterization.show', $parameterization));

        $response->assertOk();
        $response->assertViewIs('parameterization.show');
        $response->assertViewHas('parameterization');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $parameterization = Parameterization::factory()->create();

        $response = $this->get(route('parameterization.edit', $parameterization));

        $response->assertOk();
        $response->assertViewIs('parameterization.edit');
        $response->assertViewHas('parameterization');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ParameterizationController::class,
            'update',
            \App\Http\Requests\ParameterizationUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $parameterization = Parameterization::factory()->create();
        $client = Client::factory()->create();
        $region = Region::factory()->create();
        $channel = Channel::factory()->create();
        $seller = Seller::factory()->create();
        $observaciones = $this->faker->text;

        $response = $this->put(route('parameterization.update', $parameterization), [
            'client_id' => $client->id,
            'region_id' => $region->id,
            'channel_id' => $channel->id,
            'seller_id' => $seller->id,
            'observaciones' => $observaciones,
        ]);

        $parameterization->refresh();

        $response->assertRedirect(route('parameterization.index'));
        $response->assertSessionHas('parameterization.id', $parameterization->id);

        $this->assertEquals($client->id, $parameterization->client_id);
        $this->assertEquals($region->id, $parameterization->region_id);
        $this->assertEquals($channel->id, $parameterization->channel_id);
        $this->assertEquals($seller->id, $parameterization->seller_id);
        $this->assertEquals($observaciones, $parameterization->observaciones);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $parameterization = Parameterization::factory()->create();

        $response = $this->delete(route('parameterization.destroy', $parameterization));

        $response->assertRedirect(route('parameterization.index'));

        $this->assertDeleted($parameterization);
    }
}
