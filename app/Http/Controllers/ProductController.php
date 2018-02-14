<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
namespace App\Http\Controllers;

use App\Cart;
use Faker\Provider\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use PhpParser\Node\Stmt\Catch_;

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


    /*** ------------------------for shopping Cart-----------------------*/

    /*
   * Returns the shopping cart View with all the cart items
   * @created by Demi
   */
    public function getCart(){
        if(!Session::has('cart')){
            return view('shop.shoppingCart');
        }
        $cart  = Session::get('cart');
        return view('shop.shoppingCart', ['products'=>$cart->items , 'totalPrice'=> $cart->totalPrice]);
    }

    /*
    * Adds one item from the Cart
    * @created by Demi
    */
    public function getAddToCart(Request $request, $id){
        $product = Product::find($id);
        //check if there is already a cart and gets it.
        $oldCart = Session::has('cart') ? Session::get('cart'): null;
        //make a new cart and add the product
        $cart = new Cart($oldCart);
        $cart->add($product,$product->id);
        //update the session by giving it the new cart
        $request->session()->put('cart', $cart);
        return redirect()->route('product.shoppingCart');
    }

    /*
     * Deletes one item from the Cart (no matter the quantity)
     * @created by Demi
     */
    public function getDeleteFromCart(Request $request, $id){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->remove($id);
        $request->session()->put('cart', $cart);
        return redirect()->route('product.shoppingCart');
    }


    /**-----------Checking out---------------------**/
    /*
   *  @created by Demi
   * @return checkoutView with the total price
   */
    public function getCheckout(){
        if(!Session::has('cart')){
            return view("shop.shoppingcart");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total'=>$total]);
    }

    public function postCheckout(Request $request){
       $oldCart = Session::get('cart');
       $cart = new Cart($oldCart);
        //try{getpayment
            //$charge = getsPaymentID
            $order = new Order();
            $order->cart= serialize($cart);
            $order->street = $request->input('street');
            $order->city = $request->input('city');
            $order->country = $request->input('country');
            $order->name = $request->input('name');
            //$order->payment_id = $charge->id; //works with stripe

            Auth::user()->orders()->save($order);

        //}catch(Exception e){}

        Session::forget('cart');
        return redirect()->route('shop.index')->with('success', 'Successfully purchased products!');
    }



    /**-----------------------For Admin only------------------*/
    /**
     * Show the form for creating a new resource.
     * @created by Demi
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('shop.create');
    }

    /**
     * Store a newly created resource in storage.
     *  created New Product is saved to Database
     * @created by Demi
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
      return redirect('/shop')->with('success','Successfuly added');

    }

    /**
     * Display the specified resource.
     * @created by Demi
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
     * @created by Demi
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
     * @created by Demi
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
     * @created by Demi
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
