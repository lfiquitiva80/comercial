<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegionStoreRequest;
use App\Http\Requests\RegionUpdateRequest;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $regions = Region::all();

        return view('region.index', compact('regions'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('region.create');
    }

    /**
     * @param \App\Http\Requests\RegionStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(RegionStoreRequest $request)
    {
        $region = Region::create($request->validated());

        $request->session()->flash('region.id', $region->id);

        return redirect()->route('region.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Region $region)
    {
        return view('region.show', compact('region'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Region $region)
    {
        return view('region.edit', compact('region'));
    }

    /**
     * @param \App\Http\Requests\RegionUpdateRequest $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function update(RegionUpdateRequest $request, Region $region)
    {
        $region->update($request->validated());

        $request->session()->flash('region.id', $region->id);

        return redirect()->route('region.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Region $region
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Region $region)
    {
        $region->delete();

        return redirect()->route('region.index');
    }
}
