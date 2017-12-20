@extends('layouts.app2')
<!--user/{{$user->id}}/edit-->

@section('content') 
    <h2>Account</h2>
    
    <div class="btn_box">
         <a class="btn" href="#" > 
             <img class="btn_icon" src="img/lock.png">
             <div class="column">
                 <p class="btn_title">Long In and Safety</p>
                 <p class="btn_description">Edit Logindata, Name and Number</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <img class="btn_icon" src="img/box.png">
             <div class="column">
                 <p class="btn_title">Orders</p>
                 <p class="btn_description">See the status of your Orders</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <img class="btn_icon" src="img/card.png">
             <div class="column">
                 <p class="btn_title">Payment Details</p>
                 <p class="btn_description">bla bla bla</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <img class="btn_icon" src="img/loc.png">
             <div class="column">
                 <p class="btn_title">Adress</p>
                 <p class="btn_description">bla bla bla</p>
             </div>
         </a> 
     </div>
@endsection