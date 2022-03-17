<?php

namespace App\Http\Controllers;

use App\Http\Requests\SellerStoreRequest;
use App\Http\Requests\SellerUpdateRequest;
use App\Models\Seller;
use Illuminate\Http\Request;

class SellerController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sellers = Seller::all();

        return view('seller.index', compact('sellers'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('seller.create');
    }

    /**
     * @param \App\Http\Requests\SellerStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellerStoreRequest $request)
    {
        $seller = Seller::create($request->validated());

        $request->session()->flash('seller.id', $seller->id);

        return redirect()->route('seller.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Seller $seller)
    {
        return view('seller.show', compact('seller'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, Seller $seller)
    {
        return view('seller.edit', compact('seller'));
    }

    /**
     * @param \App\Http\Requests\SellerUpdateRequest $request
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function update(SellerUpdateRequest $request, Seller $seller)
    {
        $seller->update($request->validated());

        $request->session()->flash('seller.id', $seller->id);

        return redirect()->route('seller.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seller $seller
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Seller $seller)
    {
        $seller->delete();

        return redirect()->route('seller.index');
    }
}
