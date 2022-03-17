<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Datatables;
use App\Models\Year;
use App\Models\Month;
use App\Models\Client;
use App\Models\Line;
use App\Models\Maker;
use App\Models\Brand;
use App\Models\Presentation;
use App\Models\Parameterization;
use App\Models\User;
use App\Exports\ProductExport;


class ProductController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
           if (\Auth::id() == 1 || \Auth::id() == 15 || \Auth::id() == 17 || \Auth::id() == 20 || \Auth::id() == 18 ||  \Auth::id() == 39) {
           $products = Product::orderBy('id','DESC')->paginate(20);
        } else {
            $products = Product::where('user_id',\Auth::id())->orderBy('id','DESC')->paginate(20);
        }
        

        $year= Year::pluck('anio','id');
        $mes= Month::pluck('mes','id');
        /*$cliente= \DB::table('clients')
                    ->join('parameterizations', 'parameterizations.client_id', '=', 'clients.id')
                    ->where('seller_id',\Auth::User()->vendedor_id)
                    ->select('clients.*')
                    ->pluck('clients.cliente','clients.id');*/

        $cliente = Client::orderBy('cliente', 'ASC')->pluck('cliente','id');            

  

        $linea= Line::orderBy('linea','ASC')->pluck('linea','id');
        $maker= Maker::orderBy('fabricante','ASC')->pluck('fabricante','id');
        $marca= Brand::orderBy('marca','ASC')->pluck('marca','id');
        $presentacion= Presentation::orderBy('presentacion','ASC')->pluck('presentacion','id');
        $user= User::where('id',\Auth::id())->pluck('name','id');
        $ultima = Product::where('user_id',\Auth::id())->orderBy('id','DESC')->first();
         if (is_null($ultima)) {
            $ultima = Product::orderBy('id','DESC')->first();
        }


        return view('product.index', compact('products','year','mes','cliente','linea','maker','marca','presentacion','user','ultima'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('product.create');
    }

    /**
     * @param \App\Http\Requests\ProductStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductStoreRequest $request)
    {
        $product = Product::create($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('product.index')->with('status', 'Se guardo satisfatoriamente!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Product $product)
    {
        return view('product.show', compact('product'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * @param \App\Http\Requests\ProductUpdateRequest $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductUpdateRequest $request, $id)
    {
            

        $product = Product::findOrFail($request->id);

        $product->update($request->validated());

        $request->session()->flash('product.id', $product->id);

        return redirect()->route('product.index')->with('status', 'Se Actualizó satisfatoriamente!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Product $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Product $product)
    {
        $product->delete();

        return redirect()->route('product.index')->with('status', 'Se eliminó el registro!');;
    }


    public function export(Request $request){

        //dd($request->all());

      return new ProductExport($request->fecha, $request->fechafinal);
    }
}
