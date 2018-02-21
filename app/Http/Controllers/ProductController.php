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
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\Auth;
use DB;
use PhpParser\Node\Stmt\Catch_;
use App\Mail\confirmationEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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

        $size = Input::get('size');
        $product = Product::find($id);
        //check if there is already a cart and gets it.
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        //make a new cart and add the product
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $size);
        //update the session by giving it the new cart
        $request->session()->put('cart', $cart);
        $this->reduceQty($id, $size);
        return redirect()->route('product.shoppingCart');
    }

    /*
     * Deletes one item from the Cart (no matter the quantity)
     * @created by Demi
     */
    public function getDeleteFromCart(Request $request, $id)
    {

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->remove($id);
        $request->session()->put('cart', $cart);
        //toDo die Größen wieder zurück geben (qty erhöhen) [Außer wir machen das reduzieren der Qty erst bei Kauf]
        //$sizes = //split after ','
        //foreach ($size in $sizes)

       // $this->addQty($id, $s);

        return redirect()->route('product.shoppingCart');
    }

    /*
     * Deletes one item from the Cart (no matter the quantity)
     * @created by Demi
     */
    /*
    public function getRemoveOneFromCart(Request $request, $id, $size){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->reduceByOne($id, $size);
        $request->session()->put('cart', $cart);
        $this->addQty($id, $size);
        return redirect()->route('product.shoppingCart');
    }
    */
    /*
     * Deletes one item from the Cart (no matter the quantity)
     * @created by Demi
     */
    /*
    public function getAddOneToCart(Request $request, $id, $size){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->addOne($id, $size);
        $request->session()->put('cart', $cart);
        $this->reduceQty($id, $size);
        return redirect()->route('product.shoppingCart');
    }
    */

    public function reduceQty($id,$size){
        $product = Product::find($id);
        if($size=='small'){
            $product->sizeS --;
        }else if($size == 'medium'){
            $product->sizeM--;
        }else{
            $product->sizeL--;
        }
        $product->save();

    }
    public function addQty($id, $size){
        $product = Product::find($id);
        if($size=='small'){
            $product->sizeS ++;
        }else if($size == 'medium'){
            $product->sizeM++;
        }else{
            $product->sizeL++;
        }
        $product->save();
    }

    /**-----------Checking out---------------------**/
    /*
   *  @created by Demi
   * @return checkoutView with the total price
   */
    //todo check if produkt (still) available
    public function getCheckout(){
        if(!Session::has('cart')){
            return view("shop.shoppingcart");
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total'=>$total]);
    }

    /*
     *  @created by Alex
     *  @return finalcheckoutView with
    */
    public function postCheckout(Request $request)
    {
        //todo What needs to be validated
        $this->validate($request, [
            'street' => 'required',
            'country' => 'required',
            'city' => 'required',
            'payment' => 'required'
        ]);

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        $firstName = Input::get('name1');
        $lastName = Input::get('name2');
        $street = Input::get('street');
        $number = Input::get('number');
        $country = Input::get('country');
        $zip = Input::get('zip');
        $city = Input::get('city');
        $payment = Input::get('payment');

        return view('shop.finalCheckout', ['total' => $total, 'name1' => $firstName, 'street' => $street,
            'city' => $city, 'country' => $country, 'payment' => $payment,
            'number'=>$number ,'zip'=>$zip  ,'name2'=>$lastName
        ]);

    }

    /*
     *  @created by Demi
     *  @return save order and redirect to store
    */
    public function finalCheckout(Request $request){
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //todo finish up
        //todo checkpayment method -> set status
        //try{
            //getpayment
            //$charge = getsPaymentID
            $order = new Order();
            $order->cart= serialize($cart);
            $order->street = $request->input('street');
            $order->number = $request->input('number');
            $order->city = $request->input('city');
            $order->zip =$request->input('zip');
            $order->country = $request->input('country');
            $order->firstName = $request->input('name1');
            $order->lastName =$request->input('name2');
            $order->payment = $request->input('payment');
            $order->status = 'ordered';
            //$order->payment_id = $charge->id; //works with stripe

            //sending Confirmation email and saving order
            Auth::user()->orders()->save($order);
            $this->sendConfirmationEmail($order);
       // }catch(Exception $e){

        //}

        Session::forget('cart');
        return redirect()->route('shop.index')->with('success', 'Successfully purchased products!');
    }

    public function sendConfirmationEmail($order){
        $thisUser = Auth::user();


        Mail::to($thisUser['email'])->send(new confirmationEmail($order));

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
      $product->color = $request->input('color');
      $product->price = $request->input('price');

      $product->sizeS = $request->input('sizeS');
      $product->sizeM = $request->input('sizeM');
      $product->sizeL = $request->input('sizeL');
        /*$product->sizeArray = array();


          if($product->sizeS > '0') {
              array_add($product->sizeArray, 'S', $product->sizeS);
          }
          */

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
        //todo What needs to be validated
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

      //find Product
      $product = Product::find($id); 
      

      if($request->hasFile('image')){
          $product->image = $fileNameToStore;
      }
      if($request->hasFile('image2')){
        $product->image2 = $fileNameToStore2;
      }
      if($request->hasFile('image3')){
        $product->image3 = $fileNameToStore3;
      }

    $product->name = $request->input('name');
    $product->descr = $request->input('descr');
    $product->color = $request->input('color');
    $product->price = $request->input('price');

    $product->sizeS = $request->input('sizeS');
    $product->sizeM = $request->input('sizeM');
    $product->sizeL = $request->input('sizeL');
        
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
