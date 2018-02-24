<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 10.02.2018
 * Time: 14:35
 */
?>


<h1>EMAIL CONFIRMATION</h1>

<h2>Hi {{ $user->name }}, </h2>

<h3>Thank you for registering with us!</h3>

<h2>To verify email
    <a href="{{route('sendEmailDone',["email"=> $user->email, "verifyToken" => $user->verifyToken])}}">
        click here
    </a>
</h2>

<p>In case of any questions, please don't reply to this email, but send us a message to</p>
<span>gruppe4webtech@gmail.com</span>
