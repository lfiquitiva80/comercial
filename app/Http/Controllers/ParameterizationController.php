<?php

namespace App\Http\Controllers;

use App\Http\Requests\ParameterizationStoreRequest;
use App\Http\Requests\ParameterizationUpdateRequest;
use App\Models\Parameterization;
use Illuminate\Http\Request;

class ParameterizationController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $parameterizations = Parameterization::all();

        return view('parameterization.index', compact('parameterizations'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('parameterization.create');
    }

    /**
     * @param \App\Http\Requests\ParameterizationStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ParameterizationStoreRequest $request)
    {
        $parameterization = Parameterization::create($request->validated());

        $request->session()->flash('parameterization.id', $parameterization->id);

        return redirect()->route('parameterization.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parameterization $parameterization
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Parameterization $parameterization)
    {
        return view('parameterization.show', compact('parameterization'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parameterization $parameterization
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Parameterization $parameterization)
    {
        return view('parameterization.edit', compact('parameterization'));
    }

    /**
     * @param \App\Http\Requests\ParameterizationUpdateRequest $request
     * @param \App\Models\Parameterization $parameterization
     * @return \Illuminate\Http\Response
     */
    public function update(ParameterizationUpdateRequest $request, Parameterization $parameterization)
    {
        $parameterization->update($request->validated());

        $request->session()->flash('parameterization.id', $parameterization->id);

        return redirect()->route('parameterization.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Parameterization $parameterization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Parameterization $parameterization)
    {
        $parameterization->delete();

        return redirect()->route('parameterization.index');
    }
}
