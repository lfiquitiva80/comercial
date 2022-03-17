<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChiefStoreRequest;
use App\Http\Requests\ChiefUpdateRequest;
use App\Models\Chief;
use Illuminate\Http\Request;

class ChiefController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $chiefs = Chief::all();

        return view('chief.index', compact('chiefs'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('chief.create');
    }

    /**
     * @param \App\Http\Requests\ChiefStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ChiefStoreRequest $request)
    {
        $chief = Chief::create($request->validated());

        $request->session()->flash('chief.id', $chief->id);

        return redirect()->route('chief.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chief $chief
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Chief $chief)
    {
        return view('chief.show', compact('chief'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chief $chief
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Chief $chief)
    {
        return view('chief.edit', compact('chief'));
    }

    /**
     * @param \App\Http\Requests\ChiefUpdateRequest $request
     * @param \App\Models\Chief $chief
     * @return \Illuminate\Http\Response
     */
    public function update(ChiefUpdateRequest $request, Chief $chief)
    {
        $chief->update($request->validated());

        $request->session()->flash('chief.id', $chief->id);

        return redirect()->route('chief.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Chief $chief
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Chief $chief)
    {
        $chief->delete();

        return redirect()->route('chief.index');
    }
}
