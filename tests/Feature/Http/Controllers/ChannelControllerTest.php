<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Channel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ChannelController
 */
class ChannelControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    /**
     * @test
     */
    public function index_displays_view()
    {
        $channels = Channel::factory()->count(3)->create();

        $response = $this->get(route('channel.index'));

        $response->assertOk();
        $response->assertViewIs('channel.index');
        $response->assertViewHas('channels');
    }


    /**
     * @test
     */
    public function create_displays_view()
    {
        $response = $this->get(route('channel.create'));

        $response->assertOk();
        $response->assertViewIs('channel.create');
    }


    /**
     * @test
     */
    public function store_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChannelController::class,
            'store',
            \App\Http\Requests\ChannelStoreRequest::class
        );
    }

    /**
     * @test
     */
    public function store_saves_and_redirects()
    {
        $canal = $this->faker->word;

        $response = $this->post(route('channel.store'), [
            'canal' => $canal,
        ]);

        $channels = Channel::query()
            ->where('canal', $canal)
            ->get();
        $this->assertCount(1, $channels);
        $channel = $channels->first();

        $response->assertRedirect(route('channel.index'));
        $response->assertSessionHas('channel.id', $channel->id);
    }


    /**
     * @test
     */
    public function show_displays_view()
    {
        $channel = Channel::factory()->create();

        $response = $this->get(route('channel.show', $channel));

        $response->assertOk();
        $response->assertViewIs('channel.show');
        $response->assertViewHas('channel');
    }


    /**
     * @test
     */
    public function edit_displays_view()
    {
        $channel = Channel::factory()->create();

        $response = $this->get(route('channel.edit', $channel));

        $response->assertOk();
        $response->assertViewIs('channel.edit');
        $response->assertViewHas('channel');
    }


    /**
     * @test
     */
    public function update_uses_form_request_validation()
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ChannelController::class,
            'update',
            \App\Http\Requests\ChannelUpdateRequest::class
        );
    }

    /**
     * @test
     */
    public function update_redirects()
    {
        $channel = Channel::factory()->create();
        $canal = $this->faker->word;

        $response = $this->put(route('channel.update', $channel), [
            'canal' => $canal,
        ]);

        $channel->refresh();

        $response->assertRedirect(route('channel.index'));
        $response->assertSessionHas('channel.id', $channel->id);

        $this->assertEquals($canal, $channel->canal);
    }


    /**
     * @test
     */
    public function destroy_deletes_and_redirects()
    {
        $channel = Channel::factory()->create();

        $response = $this->delete(route('channel.destroy', $channel));

        $response->assertRedirect(route('channel.index'));

        $this->assertDeleted($channel);
    }
}
