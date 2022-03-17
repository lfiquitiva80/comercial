<?php

namespace App\Http\Controllers;

use App\Http\Requests\MakerStoreRequest;
use App\Http\Requests\MakerUpdateRequest;
use App\Models\Maker;
use Illuminate\Http\Request;

class MakerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $makers = Maker::all();

        return view('maker.index', compact('makers'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('maker.create');
    }

    /**
     * @param \App\Http\Requests\MakerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MakerStoreRequest $request)
    {
        $maker = Maker::create($request->validated());

        $request->session()->flash('maker.id', $maker->id);

        return redirect()->route('product.index')->with('status', 'Se guardo satisfatoriamente el fabricante!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Maker $maker
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Maker $maker)
    {
        return view('maker.show', compact('maker'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Maker $maker
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Maker $maker)
    {
        return view('maker.edit', compact('maker'));
    }

    /**
     * @param \App\Http\Requests\MakerUpdateRequest $request
     * @param \App\Models\Maker $maker
     * @return \Illuminate\Http\Response
     */
    public function update(MakerUpdateRequest $request, Maker $maker)
    {
        $maker->update($request->validated());

        $request->session()->flash('maker.id', $maker->id);

        return redirect()->route('maker.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Maker $maker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Maker $maker)
    {
        $maker->delete();

        return redirect()->route('maker.index');
    }
}
