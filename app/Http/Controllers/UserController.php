<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 09.02.2018
 * Time: 11:34
 */
namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    public function account(){

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        //todo error kein zugriff auf pass wort
        $password=$user->password;
        $input=$request->input('oldpassword');

        $passwordIsOk = password_verify($request->input('oldpassword'), $user->password);

        if (password_verify($input, $password)) {
            if($request->input('password')==$request->input('password-confirm')){

                if (!$request->input('password') == '') {
                    $user->password = bcrypt($request->input('password'));
                }
                $user->save();
                return redirect('/user')->with('success', 'Successfuly updated');

            }else{
                return redirect('/user')->with('success', 'NOT same');
            }
        }else{
            return redirect('/user')->with('success', 'Wroooong old');
        }
    }


    public function getOrders(){
        $orders = Auth::user()->orders;
        //to unserialise all the orders
        $orders->transform(function ($order, $key){
            $order->cart = unserialize($order->cart);
            return $order;
        });
            return view('user.orders', ['orders' =>$orders]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id){

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        //todo
    }
}
