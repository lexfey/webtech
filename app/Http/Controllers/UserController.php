<?php

namespace App\Http\Controllers;

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
        

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Register
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit')->with('user', $user);
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
        
       $this->validate($request, [
       'firstname'=>'required',
        'lastname'=>'required',
        'email'=>'required',
        'password'=>'required',
       ]);

       //Create User 
       $user  = User::find($id);
       /*
        //Create new Message
      $register =new Register;
      $register->firstName =$request->input('firstname');
      $register->lastName =$request->input('lastname');
      $register->email =$request->input('email');
      //$register->password =$request->input('password');
      $register->street =$request->input('street');
      $register->city =$request->input('city');
      $register->zipcode =$request->input('zipcode');
      $register->country =$request->input('country');

      $register->confcode="notavalible";
      $register->status=0; 

      //Save Message
      $register->save();
      */


      //Redirect
      return redirect('/')->with('success','Successfuly updated');
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
