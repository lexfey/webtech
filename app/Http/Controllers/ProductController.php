<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;   //The model

class ProductController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $products = Product::all(); //gets all the Data
        return view('shop.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //make New Product

       $this->validate($request, [
       //What needs to be validated
       ]);

       //Create Product 
       $product  = new Product;
    
      /*       
      $pruduct->para =$request->input('para');
      .....
      

      //Save Message
      $product->save();
      */


      //Redirect
      return redirect('/')->with('success','Successfuly registered');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product= Product::find($id);
        return view('shop.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       return view('shop.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         //make New Product

       $this->validate($request, [
       //What needs to be validated
       ]);

       //Create Product 
       $product  = Product::find($id);       
       
      /*
      $pruduct->para =$request->input('para');
      .....
      

      //Save Message
      $product->save();
      */

      //Redirect
      return redirect('shop.index')->with('success','Successfuly registered');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
