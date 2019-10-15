<?php

namespace App\Http\Controllers;

use App\Product;
use App\Http\Requests\ProductRules;
use Illuminate\Http\Request;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Resources\Product as ProductResource;
use App\Http\Resources\Products as ProductCollection;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //If  there is more than 0 rows, search 
        //all the products and send them
        $rows = Product::count();
        if($rows>0){
            $products = Product::all();
            //return response()->json($products,200);
            return response()->json(new ProductCollection($products), 200);
        }
        //else send an empty array
        return response()->json([],200);
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
    public function store(ProductRules $request)
    {
        //All the attributes were validated before entering the method 
        //by the corresponding Form Request
        //$validated = $request->validated();

        //Create a new product
        $product = Product::create($request->__get('data.attributes'));
        //$product->name = $request->input('data.attributes.name'); //this way is the same
        //$product->price = $request->input('data.attributes.price');
        //$product->save();

        //Return a response with a product json
        //representation and a 201 status code
        return response()->json(new ProductResource($product),201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //Look up for the product with the $id
        $product = Product::find($id);
        //if the product exist then send a response with a 200 status and the product 
        if($product){
            //return response()->json($product,200);
            return response()->json(new ProductResource($product), 200);
        }
        //else send a response with a 404 status
        $response = [
            'errors' => [
                [
                    'code' => 'ERROR-2',
                    'title' => 'Not Found',
                    'detail' => 'There is not a product with the id: '.$id
                ]
            ]
        ];
        return response()->json($response,404);    
        //throw new HttpResponseException(response()->json($response), 404);
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
    public function update(ProductRules $request, $id)
    {
        //First find the product to be updated
        $product = Product::find($id);
        if($product){
            //Then assign all the variables and save the product
            $product->name = $request->input('data.attributes.name');
            $product->price = $request->input('data.attributes.price');
            $product->save();
            //return response()->json($product,200);
            return response()->json(new ProductResource($product), 200);
        }
         //else send a response with a 404 status
        $response = [
            'errors' => [
                [
                    'code' => 'ERROR-2',
                    'title' => 'Not Found',
                    'detail' => 'There is not a product with the id: '.$id
                ]
            ]
        ];
        return response()->json($response,404);       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Look up for the product with the $id
        $product = Product::find($id);
        //if the product exist then delete the product and send a response with a 200 status
        //else send a response with a 204 status
        if($product){
            $product->delete();
            return response()->json('',204);
        }
        //else send a response with a 404 status
        $response = [
            'errors' => [
                [
                    'code' => 'ERROR-2',
                    'title' => 'Not Found',
                    'detail' => 'There is not a product with the id: '.$id
                ]
            ]
        ];
        return response()->json($response,404);
    }
}
