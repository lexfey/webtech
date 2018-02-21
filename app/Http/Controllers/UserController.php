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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

use Hash;

/*NOT USED / NEEDED -- replaced by AuthControllers*/

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    public function account()
    {

        return view('user.account');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //RegisterController

    }

    /**
     * Display the form for changing user's password
     */
    public function showChangePasswordForm()
    {
        return view('user.changepassword');
    }

    /**
     * Display the form for deleting user's account
     */
    public function showDeleteAccountForm()
    {
        return view('user.deleteaccount');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //RegisterController

    }


    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {

    }


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

        //todo double check confirm password

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        return redirect()->back()->with("success", "Password changed successfully !");

    }


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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Sets the user status to '2', logs out and redirects to home screen.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
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

        return redirect('/home')->with("success", "Account deleted successfully !");

    }


}
