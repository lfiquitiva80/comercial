<?php

namespace App\Http\Controllers;

use App\Http\Requests\PresentationStoreRequest;
use App\Http\Requests\PresentationUpdateRequest;
use App\Models\Presentation;
use Illuminate\Http\Request;

class PresentationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $presentations = Presentation::all();

        return view('presentation.index', compact('presentations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('presentation.create');
    }

    /**
     * @param \App\Http\Requests\PresentationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(PresentationStoreRequest $request)
    {
        $presentation = Presentation::create($request->validated());

        $request->session()->flash('presentation.id', $presentation->id);

        return redirect()->route('product.index')->with('status', 'Se guardo satisfatoriamente la presentación!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Presentation $presentation)
    {
        return view('presentation.show', compact('presentation'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Presentation $presentation)
    {
        return view('presentation.edit', compact('presentation'));
    }

    /**
     * @param \App\Http\Requests\PresentationUpdateRequest $request
     * @param \App\Models\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function update(PresentationUpdateRequest $request, Presentation $presentation)
    {
        $presentation->update($request->validated());

        $request->session()->flash('presentation.id', $presentation->id);

        return redirect()->route('presentation.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Presentation $presentation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Presentation $presentation)
    {
        $presentation->delete();

        return redirect()->route('presentation.index');
    }
}
