<?php

namespace App\Http\Controllers;

use App\Http\Requests\YearStoreRequest;
use App\Http\Requests\YearUpdateRequest;
use App\Models\Year;
use Illuminate\Http\Request;

class YearController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $years = Year::all();

        return view('year.index', compact('years'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('year.create');
    }

    /**
     * @param \App\Http\Requests\YearStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(YearStoreRequest $request)
    {
        $year = Year::create($request->validated());

        $request->session()->flash('year.id', $year->id);

        return redirect()->route('year.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Year $year
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Year $year)
    {
        return view('year.show', compact('year'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Year $year
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Year $year)
    {
        return view('year.edit', compact('year'));
    }

    /**
     * @param \App\Http\Requests\YearUpdateRequest $request
     * @param \App\Models\Year $year
     * @return \Illuminate\Http\Response
     */
    public function update(YearUpdateRequest $request, Year $year)
    {
        $year->update($request->validated());

        $request->session()->flash('year.id', $year->id);

        return redirect()->route('year.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Year $year
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Year $year)
    {
        $year->delete();

        return redirect()->route('year.index');
    }
}
