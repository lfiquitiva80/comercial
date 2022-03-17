<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonthStoreRequest;
use App\Http\Requests\MonthUpdateRequest;
use App\Models\Month;
use Illuminate\Http\Request;

class MonthController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $months = Month::all();

        return view('month.index', compact('months'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('month.create');
    }

    /**
     * @param \App\Http\Requests\MonthStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(MonthStoreRequest $request)
    {
        $month = Month::create($request->validated());

        $request->session()->flash('month.id', $month->id);

        return redirect()->route('month.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Month $month
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Month $month)
    {
        return view('month.show', compact('month'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Month $month
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Month $month)
    {
        return view('month.edit', compact('month'));
    }

    /**
     * @param \App\Http\Requests\MonthUpdateRequest $request
     * @param \App\Models\Month $month
     * @return \Illuminate\Http\Response
     */
    public function update(MonthUpdateRequest $request, Month $month)
    {
        $month->update($request->validated());

        $request->session()->flash('month.id', $month->id);

        return redirect()->route('month.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Month $month
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Month $month)
    {
        $month->delete();

        return redirect()->route('month.index');
    }
}
