<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 10.02.2018
 * Time: 14:35
 */
?>
<h1>ORDER CONFIRMATION</h1>

<h2>Hi {{ $order->firstName }} {{ $order->lastName }},</h2>

<h3>Thank you for shopping with us!</h3>
<p>Your order number is {{$order->id}}</p>
<p>In case of any questions, please don't reply to this email, but send us a message on</p>
<span>gruppe4webtech@gmail.com</span>

<h3>Order details</h3>
<p>Check your order details here: <a href="http://feyertag.family/orders">MY ORDERS</a></p>



