<?php

namespace App\Http\Controllers;

use App\Product;
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
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Create a new product
        $product = Product::create($request->all());

        //Return a response with a product json
        //representation and a 201 status code
        return response()->json($product,201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product, $id)
    {
        //Look up for the product with the $id
        $product = Product::find($id);
        //if the product exist then send a response with a 200 status and the product
        //else send a response with a 204 status
        if($product){
            return response()->json($product,200);
        }
        return response()->json(204);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product, $id)
    {
        //First find the product to be updated
        $product = Product::find($id);
        if($product){
            //Then assign all the variables and save the product
            $product->name = $request->input('name');
            $product->price = $request->input('price');
            $product->save();
            return response()->json(200);
        }
         return response()->json(204);        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product, $id)
    {
        //Look up for the product with the $id
        $product = Product::find($id);
        //if the product exist then delete the product and send a response with a 200 status
        //else send a response with a 204 status
        if($product){
            $product->delete();
            return response()->json(200);
        }
        return response()->json(204);
    }
}
