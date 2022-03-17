<?php

namespace App\Http\Controllers;

use App\Http\Requests\LineStoreRequest;
use App\Http\Requests\LineUpdateRequest;
use App\Models\Line;
use Illuminate\Http\Request;

class LineController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $lines = Line::all();

        return view('line.index', compact('lines'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('line.create');
    }

    /**
     * @param \App\Http\Requests\LineStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(LineStoreRequest $request)
    {
        $line = Line::create($request->validated());

        $request->session()->flash('line.id', $line->id);

        return redirect()->route('line.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Line $line
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Line $line)
    {
        return view('line.show', compact('line'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Line $line
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Line $line)
    {
        return view('line.edit', compact('line'));
    }

    /**
     * @param \App\Http\Requests\LineUpdateRequest $request
     * @param \App\Models\Line $line
     * @return \Illuminate\Http\Response
     */
    public function update(LineUpdateRequest $request, Line $line)
    {
        $line->update($request->validated());

        $request->session()->flash('line.id', $line->id);

        return redirect()->route('line.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Line $line
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Line $line)
    {
        $line->delete();

        return redirect()->route('line.index');
    }
}
