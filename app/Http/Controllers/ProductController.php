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

    /**
     * Displays all the Products.
     *
     * @created by Demi
     *
     * @return view shop.index with Products
     */
    public function index()
    {
        $products = Product::all(); //gets all the Data
        return view('shop.index')->with('products', $products);
    }


    /*------------------------------------------------------- shopping Cart --------------------------------------------------*/


    /**
     * Displays the shopping Cart
     *
     * Checks first if shoppingCart is available.
     * Then Checks if products in the cart still available, if not removes them from cart.
     *
     * @created by Demi
     *
     * @return view product.shoppingCart
     */
    public function getCart(Request $request)
    {

        if (!Session::has('cart')) {
            return view('shop.shoppingCart', ['change' => false]);
        }

        $changes=$this->checkAvailable($request);

        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);

        if($changes == true){
            return view('shop.shoppingCart', ['change' => true, 'products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }else{
            return view('shop.shoppingCart', ['change' => false, 'products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
        }
    }

    public function checkAvailable(Request $request){
        $changes = false;
        $oldcart = Session::get('cart');
        $cart = new Cart($oldcart);
        foreach ($cart->items as $item){
            $product = Product::find($item['item']['id']);
            //counter for each size
            $countS=0;
            $countM=0;
            $countL=0;
            $sizes= explode('|', $item['sizes']);

            //for each size check if there are more then available sizes
            foreach ($sizes as $size) {
                if ($size == 'small') {
                    if (($product->sizeS) < ($countS+1)) {
                        $changes=true;
                        $cart->soldOut($item['item']['id'], $size);
                    }else{
                        $countS++;
                    }
                }else if ($size == 'medium') {
                    if ($product->sizeM < $countM+1) {
                        $cart->soldOut($item['item']['id'], $size);
                        $changes=true;
                    }else{
                        $countM++;
                    }
                } else if ($size == 'large') {
                    if ($product->sizeL < $countL+1) {
                        $cart->soldOut($item['item']['id'], $size);
                        $changes=true;
                    }else{
                        $countL++;
                    }
                }
            }
        }
        $request->session()->put('cart', $cart);
        return $changes;
    }

    /**
     * Adds a Product to the ShoppingCart.
     *
     * The Method adds a Product from the ShoppingCart. Qty = 1.
     * It gets the Product, checks if there is already something in the Cart.
     * Makes a new Cart and adds the Product.
     *
     * @param Int $id Id of the Product
     * @param Request $request
     *
     * @created by Demi
     *
     * @return view product.shoppingCart
     */
    public function getAddToCart(Request $request, $id)
    {

        $this->validate($request, [
            'size' => 'required',
        ]);
        $size = Input::get('size');
        $product = Product::find($id);

        //check if there is already a cart and gets it.
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        //make a new cart and add the product
        $cart = new Cart($oldCart);
        $cart->add($product, $product->id, $size);

        if(!Auth::guest()) {
            $user = Auth::user();
            $user->cart = serialize($cart);
            $user->save();
        }
        //update the session by giving it the new cart
        $request->session()->put('cart', $cart);

        //$this->reduceQty($id, $size);

        return redirect()->route('product.shoppingCart');
    }



    /**
     * Deletes a Product from the ShoppingCart.
     *
     * The Method deletes a Product from the ShoppingCart. No Matter the Qty.
     *
     * @param Int $id Id of the Product
     * @param Request $request
     *
     * @created by Demi
     *
     * @return view product.shoppingCart
     */
    public function getDeleteFromCart(Request $request, $id)
    {

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $cart->remove($id);

        if(!Auth::guest()) {
            $user = Auth::user();
            $user->cart = serialize($cart);
            $user->save();
        }

       // $this->addQty($id);

        $request->session()->put('cart', $cart);

        return redirect()->route('product.shoppingCart');
    }



    /**
     * Reducing Quantity of Products
     *
     * When buying something the metod is called to remove the both item from the store (reduce the quantity)
     *
     * @created by Demi
     *
     * @return void
     */
    public function buyItems()
    {
        $cart = Session::get('cart');
        $cart = new Cart($cart);
        foreach ($cart->items as $item) {
            $product = Product::find($item['item']['id']);
            $sizes = explode('|', $item['sizes']);

            foreach ($sizes as $size) {
                if ($size == 'small') {
                    $product->sizeS--;

                } else if ($size == 'medium') {
                    $product->sizeM--;

                } else if ($size == 'large') {
                    $product->sizeL--;
                }
            }

            $product->save();
        }

    }

    /**---------------------------------------- Checking out  ---------------------------**/

    /**
     * Leads to Checkout
     *
     * Checks if Cart is filled. Middleware checks if you are logged in.
     * If so you will be directed to the checkout form.
     *
     * @created by Demi
     *
     * @return view shop.checkout  or shop.shoppingcart
     */
    public function getCheckout()
    {

        if (!Session::has('cart')) {
            return view("shop.shoppingcart");
        }
        return view('shop.checkout');
    }


    /**
     * Checks the Address Input and gives it to the confirmation page.
     *
     * The Method gets all the needed Input for the Order and gives it to the
     * finalCheckout view for confirmation
     *
     * @param Request $request Getting the form data, Address & Payment
     *
     * @created by Alex & Demi
     *
     * @return view finalCheckout.blade with all Information on the Order
     */
    public function postCheckout(Request $request)
    {

        $this->validate($request, [
            'street' => 'required',
            'name1'=> 'required',
            'name2'=> 'required',
            'zip'=> 'required',
            'number'=> 'required',
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
            'number' => $number, 'zip' => $zip, 'name2' => $lastName, 'products' => $cart->items
        ]);

    }

    /**
     * Gets all the Data for the Order and creates an Order.
     *
     * Gets all the data for the order. Creates a new Order, saves it.
     * Sends a confirmation Email to the User. Deletes the cart.
     *
     * @param Request $request Getting the form data, Address & Payment
     *
     * @created by Demi & Alex
     *
     * @return view shop.index with success Message
     */
    public function finalCheckout(Request $request)
    {
        //check if all Products are still available
       if(!$this->checkAvailable($request)){
           if (Session::has('cart')) {

               $this->validate($request, [
                   'street' => 'required',
                   'name1'=> 'required',
                   'name2'=> 'required',
                   'zip'=> 'required',
                   'number'=> 'required',
                   'country' => 'required',
                   'city' => 'required',
                   'payment' => 'required'
               ]);


               $order = new Order();
               $oldCart = Session::get('cart');
               $cart = new Cart($oldCart);
               $order->cart = serialize($cart);

               $order->street = $request->input('street');
               $order->number = $request->input('number');
               $order->city = $request->input('city');
               $order->zip = $request->input('zip');
               $order->country = $request->input('country');
               $order->firstName = $request->input('name1');
               $order->lastName = $request->input('name2');

               $user = Auth::user();
               $order->email = $user->email;

               $order->payment = $request->input('payment');
               $order->status = 'ordered';

               //sending Confirmation email and saving order
               Auth::user()->orders()->save($order);
               $this->sendConfirmationEmail($order);

               //reduces Qty of Product
               $this->buyItems();

               Session::forget('cart');
               $user = Auth::user();
               $user->cart = null;
               $user->save();

               return redirect()->route('shop.index')->with('success', 'Successfully purchased products! Check your email inbox for the ORDER CONFIRMATION');
           } else {
               return redirect()->route('shop.index')->with('error', 'You already placed your order!');
           }
       }else{
           $oldCart = Session::get('cart');
           $cart = new Cart($oldCart);
           return view('shop.shoppingCart', ['change' => true, 'products' => $cart->items, 'totalPrice' => $cart->totalPrice]);
       }
    }



    /**
     * Sending Confirmation Email after Buying
     *
     *
     * @param Order $order
     *
     * @created by Alex
     *
     * @return void
     */
    public function sendConfirmationEmail($order)
    {
        $thisUser = Auth::user();


        Mail::to($thisUser['email'])->send(new confirmationEmail($order));

    }


    /**---------------------------------------------For Admin only: Editing Products---------------------------------------*/


    /**
     * Displays the Form to create a new Product
     *
     * @created by Demi
     *
     * @return view shop.create
     */
    public function create()
    {
        return view('shop.create');
    }


    /**
     * Stores a new created Product.
     *
     * It takes the date from the form and saves it after validating.
     * For the Img (one required) it creates a unique name and saves it to the database.
     *
     * @param Request $request
     *
     * @created by Demi
     *
     * @return view shop with success message
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'color'=> 'required',
            'desc'=> 'required',
            'sizeL'=> 'required',
            'sizeM'=> 'required',
            'sizeS'=> 'required',
            'image' => 'image|max:1999|required',
        ]);

        //Saves file new under unique name and gives the name to database
        if ($request->hasFile('image')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore0 = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image')->move('images', $fileNameToStore0);

        } else {
            $fileNameToStore0 = null;
        }

        if ($request->hasFile('image2')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image2')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image2')->move('images', $fileNameToStore2);

        } else {
            $fileNameToStore2 = null;
        }

        if ($request->hasFile('image3')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image3')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore3 = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image3')->move('images', $fileNameToStore3);

        } else {
            $fileNameToStore3 = null;
        }

        //Create new Product
        $product = new Product;

        $product->name = $request->input('name');
        $product->descr = $request->input('descr');
        $product->color = $request->input('color');
        $product->price = $request->input('price');

        $product->sizeS = $request->input('sizeS');
        $product->sizeM = $request->input('sizeM');
        $product->sizeL = $request->input('sizeL');

        $product->image = $fileNameToStore0;
        if ($fileNameToStore2 != null) {
            $product->image2 = $fileNameToStore2;
        }
        if ($fileNameToStore3 != null) {
            $product->image3 = $fileNameToStore3;
        }

        //Save Product
        $product->save();

        //Redirect
        return redirect('/shop')->with('success', 'Successfuly added');
    }


    /**
     * Displays a Product.
     *
     * @param Int $id is ProductID
     *
     * @created by Demi
     *
     * @return view shop.show with product
     */
    public function show($id)
    {
        $product = Product::find($id);
        return view('shop.show')->with('product', $product);
    }


    /**
     * Display the form for editing the specified Product.
     *
     * @param Int $id ProductID
     *
     * @created by Demi
     *
     * @return view shop.edit with product
     */
    public function edit($id)
    {
        $product = Product::find($id);
        return view('shop.edit')->with('product', $product);
    }


    /**
     * Updates a existing Product.
     *
     * It takes the date from the form and saves it after validating.
     * For the Img (none required) it creates a unique name and saves it to the database and replaces the old pic.
     *
     * @param Request $request
     * @param Int $id ProductID
     *
     * @created by Demi
     *
     * @return view shop with success message
     */
    public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => 'required',
            'price' => 'required',
            'color'=> 'required',
            'desc'=> 'required',
            'sizeL'=> 'required',
            'sizeM'=> 'required',
            'sizeS'=> 'required',
            'image' => 'image|max:1999',
        ]);

        //Saves file new under unique name and gives the name to database
        if ($request->hasFile('image')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image')->move('images', $fileNameToStore);
        } else {
            $fileNameToStore = null;
        }

        if ($request->hasFile('image2')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image2')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image2')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore2 = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image2')->move('images', $fileNameToStore2);

        } else {
            $fileNameToStore2 = null;
        }

        if ($request->hasFile('image3')) {
            //Get filename with the extension
            $filenameWithEXT = $request->file('image3')->getClientOriginalName();
            //Get just filename
            $filename = pathinfo($filenameWithEXT, PATHINFO_FILENAME);
            //Get just ext
            $extension = $request->file('image3')->getClientOriginalExtension();
            //Filename to store
            $fileNameToStore3 = $filename . '_' . time() . '.' . $extension; //makes file name unique
            //Upload Image
            $path = $request->file('image3')->move('images', $fileNameToStore3);

        } else {
            $fileNameToStore3 = null;
        }

        //find Product
        $product = Product::find($id);

        if ($request->hasFile('image')) {
            $product->image = $fileNameToStore;
        }
        if ($request->hasFile('image2')) {
            $product->image2 = $fileNameToStore2;
        }
        if ($request->hasFile('image3')) {
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
        return redirect('/shop')->with('success', 'Successfuly edited');
    }



    /**
     * Removes the specified Product.
     *
     * @param Int $id ProductID
     *
     * @created by Demi
     *
     * @return view shop with success message
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if ($product->image != 'noimage.jpg') {
            // Delete Image
            Storage::delete("{{asset('images/'.$product->image)}}");
        }
        if ($product->image2 != null) {
            // Delete Image
            Storage::delete("{{asset('images/'.$product->image2)}}");
        }
        if ($product->image3 != null) {
            // Delete Image
            Storage::delete("{{asset('images/'.$product->image3)}}");
        }

        $product->delete();
        return redirect('/shop')->with('success', 'Successfuly deleted');

    }

    /**
     * Displays Sizetable
     *
     * @created by Demi
     *
     * @return view sizetable
     */
    public function displaySizetable(){
        return view('sizetable');
    }

}
