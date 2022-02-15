<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $result = ['name'=>'index', 'payload'=>Product::all()];
        return response($result, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $fields = $request->validate([
            'product_name' => 'required',
            'product_type' => 'required|integer',
            'price' => 'required',
        ]);

        $product = Product::create([
            'product_name' => $fields['product_name'],
            'product_type' => $fields['product_type'],
            'price' => $fields['price'],
        ]);

        $result = ['name'=>'store', 'payload'=> $product];
        return response($result, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = ['name'=>'show', 'payload'=>Product::find($id)];
        return response($result, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product, $id)
    {
        $fields = $request->validate([
            'product_name' => 'required|string',
            'product_type' => 'required|integer',
            'price' => 'required',
        ]);

        $product = Product::where("id",$id)->update($request->all());

        $result = [
            'name' => 'update',
            'payload' => $product,
        ];
        return response($result, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id);
        $product->delete();
        $result = ['name'=>'destroy', 'payload'=>'Deleted.'];
        return $result;
    }
}
