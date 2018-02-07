<?php

namespace App\Http\Controllers;

use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Product;   
use DB;

class ProductController extends Controller
{
   //Überprüfen ob user eingeloggt ist. Hier nicht notwendig (aber vielleicht wo anders später) 
   /**
     * Create a new controller instance.
     *
     * @return void
   public function __construct()
    {
    $this->middleware('auth', ['except' => ['index', 'show']]);
    }
   */

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
     *  created New Product is saved to Database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)  
    {
       
      //What needs to be validated
       $this->validate($request, [
        'name' =>'required',
        'price' =>'required',
        'image'=>'image|max:1999|required',
       ]);

       //Handel file upload for img |nullable| (here no nullable possible)
       /*
       * Saves file new under unique name and gives the name to database
       */
       if($request->hasFile('image')){
        //Get filename with the extension
          $filenameWithEXT= $request->file('image')->getClientOriginalName();
          //Get just filename
          $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('image')->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore0 =$filename.'_'.time().'.'.$extension; //makes file name unique
          //Upload Image
           // $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
           $path =$request->file('image')->move('images', $fileNameToStore0);
           
       }else{
          $fileNameToStore0 = 'noimage.jpg';
       }

        if($request->hasFile('image2')){
            //Get filename with the extension
            $filenameWithEXT= $request->file('image2')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 =$filename.'_'.time().'.'.$extension; //makes file name unique
            //Upload Image
            // $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $path =$request->file('image2')->move('images', $fileNameToStore2);

        }else{
            $fileNameToStore2 = null;
        }

        if($request->hasFile('image3')){
            //Get filename with the extension
            $filenameWithEXT= $request->file('image3')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore3 =$filename.'_'.time().'.'.$extension; //makes file name unique
            //Upload Image
            // $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $path =$request->file('image3')->move('images', $fileNameToStore3);

        }else{
            $fileNameToStore3 = null;
        }

      //Create new Product 
      $product =new Product; 
      
      $product->name = $request->input('name');
      $product->descr = $request->input('descr');
      $product->image = $fileNameToStore0;
      $product->size = $request->input('size');
      $product->color = $request->input('color');
      $product->status = $request->input('status');
      $product->price = $request->input('price');
      if($fileNameToStore2 != null){
          $product->image2 = $fileNameToStore2;
      }
      if($fileNameToStore3 != null){
        $product->image3 = $fileNameToStore3;
      }
        
      //Save Product
      $product->save();
      

      //Redirect
      return redirect('/shop')->with('success','Successfuly added'.$path.'.');

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
       $product= Product::find($id);
       return view('shop.edit')->with('product', $product);
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
        //What needs to be validated
       $this->validate($request, [
        'name' =>'required',
        'price' =>'required',
        'image'=>'image|max:1999',
       ]);

       //Handel file upload for img |nullable| (here no nullable possible)
       /*
       * Saves file new under unique name and gives the name to database
       */
       if($request->hasFile('image')){
        //Get filename with the extension
          $filenameWithEXT= $request->file('image')->getClientOriginalName();
          //Get just filename
          $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
          //Get just ext
          $extension = $request->file('image')->getClientOriginalExtension();
          //Filename to store
          $fileNameToStore =$filename.'_'.time().'.'.$extension; //makes file name unique
          //Upload Image
          $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
       }else{
           $fileNameToStore = null;
       }

        if($request->hasFile('image2')){
            //Get filename with the extension
            $filenameWithEXT= $request->file('image2')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 =$filename.'_'.time().'.'.$extension; //makes file name unique
            //Upload Image
            // $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $path =$request->file('image2')->move('images', $fileNameToStore2);

        }else{
            $fileNameToStore2 = null;
        }

        if($request->hasFile('image3')){
            //Get filename with the extension
            $filenameWithEXT= $request->file('image3')->getClientOriginalName();
            //Get just filename
            $filename=pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore3 =$filename.'_'.time().'.'.$extension; //makes file name unique
            //Upload Image
            // $path = $request->file('image')->storeAs('public/images', $fileNameToStore);
            $path =$request->file('image3')->move('images', $fileNameToStore3);

        }else{
            $fileNameToStore3 = null;
        }

      //Create new Product 
      $product = Product::find($id); 
      
      $product->name = $request->input('name');
      $product->descr = $request->input('descr');
      if($request->hasFile('image')){
          $product->image = $fileNameToStore;
      }
      if($request->hasFile('image2')){
        $product->image2 = $fileNameToStore2;
      }
      if($request->hasFile('image3')){
        $product->image3 = $fileNameToStore3;
      }
      $product->size = $request->input('size');
      $product->color = $request->input('color');
      $product->status = $request->input('status');
      $product->price = $request->input('price');
        
      //Save Product
      $product->save();
      

      //Redirect
      return redirect('/shop')->with('success','Successfuly edited');
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        //toDo image delete (all)?!
       if($product->image != 'noimage.jpg'){
            // Delete Image
            Storage::delete("{{asset('images/'.$product->image)}}");
        }


        $product->delete();
        return redirect('/shop')->with('success','Successfuly deleted');
        
    }
}
