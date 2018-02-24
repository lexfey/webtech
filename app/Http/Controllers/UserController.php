<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */

namespace App\Http\Controllers;

use App\Order;
use App\User;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use Hash;


class UserController extends Controller
{

    /*
     * Checking and rebuilding last used Cart of User
     *
     * Is called after Login to check if the user has something in the cart from old Session
     * if so the cart gets updated to the "old cart"
     *
     * @param Request $request
     *
     * @created by Demi
     *
     */
    public function checkForCart(Request $request){
       $user = Auth::user();
        if($user->cart != null){
            $cart = new Cart(unserialize($user->cart));
            $request->session()->put('cart', $cart);
        }
        return view('user.index');
    }

    /**
     * Display the user.index.
     *
     *
     * @created by Demi
     *
     * @return view user.index
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Display user.account.
     *
     * @created by Demi
     *
     * @return view user.account
     */
    public function account()
    {
        return view('user.account');
    }


    /**
     * Display user.changepassword
     *
     * @created by Alex
     *
     * @return view user.changepassword
     */
    public function showChangePasswordForm()
    {
        return view('user.changepassword');
    }

    /**
     * Display user.deleteaccount
     *
     * @created by Alex
     *
     * @return view user.deleteaccount
     */
    public function showDeleteAccountForm()
    {
        return view('user.deleteaccount');
    }


    /**
     * Change Users Password
     *
     * Checks if current password is correct, with Hashing.
     * Checks if new and old password are different.
     * Saves the new password.
     *
     * @param Request $request
     *
     * @created by Alex
     *
     * @return view user.account with success message
     */
    public function changePassword(Request $request)
    {

        $this->validate($request, [
            'current-password' => 'required',
            'new-password' => 'required|string|min:6|confirmed',
        ]);

        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }


        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");
    }


    /**
     * Deletes User account
     *
     * Sets the status to 2. To avoid Problem when Ordered something and Account is gone.
     *
     * @param Request $request
     *
     * @created by Alex
     *
     * @return view about with success message
     */
    public function destroy(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }

        $id = Auth::id();

        DB::table('users')
            ->where('id', $id)
            ->update(['status' => 2]);

        Auth::logout();

        return redirect('/about')->with("success", "Account deleted successfully !");
    }


    /**
     * Display Orders of/for each user
     *
     * Gets all the orders of the currently logged in User and displays them.
     * therefor the cart in the order database needs to be unserialized.
     * If User = Admin it returns all the orders by all useres. where admin can change status and shipping ID.
     *
     *
     * @created by Demi
     *
     * @return view user.account with success message
     */
    public function getOrders()
    {
        $user = Auth::user();

        if ($user->name != 'Admin') {
            $orders = Auth::user()->orders;
            //to unserialise all the orders
            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
            return view('user.orders', ['orders' => $orders]);
        }else{
            $orders= Order::all();
            $orders->transform(function ($order, $key) {
                $order->cart = unserialize($order->cart);
                return $order;
            });
            return view('user.allOrders',  ['orders' => $orders]);
        }
    }

    /**
     * Display Orders of/for each user
     *
     * Gets all the orders of the currently logged in User and displays them.
     * therefor the cart in the order database needs to be unserialized.
     * If User = Admin it returns all the orders by all useres. where admin can change status and shipping ID.
     *
     *
     * @created by Demi
     *
     * @return view user.account with success message
     */
    public function changeOrder(Request $request, $id){

        $this->validate($request, [
            'status' => 'required'
        ]);
        $order = Order::find($id);
        $order->status = $request->input('status');
        if($request->has('shippingID')) {
            $order->shipping_Id = $request->input('shippingID');
        }
        $order->save();
        return view('user.index')->with('success','Successfuly edited');
    }

    /**
     * Display Impressum
     *
     * @created by Demi
     *
     * @return view impressum
     */
    public function displayImpressum(){
        return view('impressum');
    }

}
