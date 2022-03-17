<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExerciseStoreRequest;
use App\Http\Requests\ExerciseUpdateRequest;
use App\Models\Exercise;
use App\Models\Year;
use App\Models\Month;
use App\Models\Client;
use App\Models\User;
use App\Exports\GeolocalizacionExport;
use Illuminate\Http\Request;

class ExerciseController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exercises = Exercise::orderBy('id','DESC')->paginate(5);
        $year= Year::pluck('anio','id');
        $mes= Month::pluck('mes','id');
        $cliente = Client::orderBy('cliente', 'ASC')->pluck('cliente','id');  
        $user= User::where('id',\Auth::id())->pluck('name','id');

        return view('exercise.index', compact('exercises','year','mes','cliente','user'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('exercise.create');
    }

    /**
     * @param \App\Http\Requests\ExerciseStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExerciseStoreRequest $request)
    {
        $exercise = Exercise::create($request->validated());

        $request->session()->flash('exercise.id', $exercise->id);

        return redirect()->route('exercise.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Exercise $exercise)
    {
        return view('exercise.show', compact('exercise'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Exercise $exercise)
    {
        return view('exercise.edit', compact('exercise'));
    }

    /**
     * @param \App\Http\Requests\ExerciseUpdateRequest $request
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(ExerciseUpdateRequest $request,$id)
    {

        $exercise = Exercise::findOrFail($request->id);

        $exercise->update($request->validated());

        $request->session()->flash('exercise.id', $exercise->id);

        return redirect()->route('exercise.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Exercise $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Exercise $exercise)
    {
        $exercise->delete();

        return redirect()->route('exercise.index');
    }



    public function export(Request $request){

        //dd($request->all());

      return new GeolocalizacionExport($request->fecha, $request->fechafinal);
    }
}
