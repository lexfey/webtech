<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 10.02.2018
 * Time: 14:35
 */
?>


<h1>To verify email <a href="{{route('sendEmailDone',["email"=> $user->email, "verifyToken" => $user->verifyToken])}}">click here</a> </h1>



