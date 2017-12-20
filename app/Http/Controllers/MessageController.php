<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{

    public function signin (Request $request){
      $this->validate($request, [
        'email'=>'required',
        'password'=>'required'
      ]);

      return 'SUCCESS';
   }

   //Wenn neuRegistrierung 
   public function submit(Request $request){
      $this->validate($request, [
        'firstname'=>'required',
        'lastname'=>'required',
        'email'=>'required',
        'password'=>'required',
      ]);

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
       //Create new Message
        $message =new Message;
        $message->name =$request->input('name');
        $message->email =$request->input('email');
        $message->message =$request->input('message');
        //Save Message
        $message->save();


      //Redirect
      return redirect('/')->with('success','Successfuly registered');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store(Request $request)
    {
        //
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
        //
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
        //
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
