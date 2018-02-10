<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Mail\verifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Foundation\Auth\RegistersUsers;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     * changes by Demi: call the sendMail function
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        Session::flash('status', 'Registered! Verify your email to activate your account');
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'verifyToken' => Str::random(40),
        ]);

        $thisUser = User::findOrFail($user->id);
        $this->sendEmail($thisUser);
        return $user;
    }

    /**
     * sendEmail
     * @created by Demi 10.02.2018
     * @param user
     * @return
     */
    public function sendEmail($thisUser){
        Mail::to($thisUser['email'])->send(new verifyEmail($thisUser));

    }


    /**
     * VerifyEmailAdress
     * @created by Demi 10.02.2018
     *
     * @return "view" telling the user to verify email
     */
    public function verifyEmailFirst(){
        return view('email.verifyEmailFirst');
    }

    /**
     * sendEmailDone
     * @created by Demi 10.02.2018
     * @param email, token
     * updating the status to 1 and token to null (so no reuse)
     * @return "view" telling the user to verify email
     */
    public function sendEmailDone($email, $verifyToken){

        $user = User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->first();
        if($user){
            User::where(['email'=>$email, 'verifyToken'=>$verifyToken])->update(['status'=>1, 'verifyToken'=>NULL]);
            return view('login'); //todo with email prefilled
        }else{
            return 'user not found';
        }
    }

}
