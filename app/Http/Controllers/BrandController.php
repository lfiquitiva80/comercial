<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $brands = Brand::all();

        return view('brand.index', compact('brands'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('brand.create');
    }

    /**
     * @param \App\Http\Requests\BrandStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandStoreRequest $request)
    {
        $brand = Brand::create($request->validated());

        $request->session()->flash('brand.id', $brand->id);

        return redirect()->route('product.index')->with('status', 'Se guardo satisfatoriamente la marca!');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Brand $brand)
    {
        return view('brand.show', compact('brand'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Brand $brand)
    {
        return view('brand.edit', compact('brand'));
    }

    /**
     * @param \App\Http\Requests\BrandUpdateRequest $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $brand->update($request->validated());

        $request->session()->flash('brand.id', $brand->id);

        return redirect()->route('brand.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Brand $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();

        return redirect()->route('brand.index');
    }
}
