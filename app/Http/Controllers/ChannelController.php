<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChannelStoreRequest;
use App\Http\Requests\ChannelUpdateRequest;
use App\Models\Channel;
use Illuminate\Http\Request;

class ChannelController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $channels = Channel::all();

        return view('channel.index', compact('channels'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('channel.create');
    }

    /**
     * @param \App\Http\Requests\ChannelStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChannelStoreRequest $request)
    {
        $channel = Channel::create($request->validated());

        $request->session()->flash('channel.id', $channel->id);

        return redirect()->route('channel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Channel $channel)
    {
        return view('channel.show', compact('channel'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Channel $channel)
    {
        return view('channel.edit', compact('channel'));
    }

    /**
     * @param \App\Http\Requests\ChannelUpdateRequest $request
     * @param \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function update(ChannelUpdateRequest $request, Channel $channel)
    {
        $channel->update($request->validated());

        $request->session()->flash('channel.id', $channel->id);

        return redirect()->route('channel.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Channel $channel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Channel $channel)
    {
        $channel->delete();

        return redirect()->route('channel.index');
    }
}
