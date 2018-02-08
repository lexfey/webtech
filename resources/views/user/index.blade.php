@extends('layouts.app')

@section('content') 
    <h2>Account</h2>
    
    <div class="btn_box">
         <a class="btn" href="#" >
             <div class="column btn_column">
                 <p class="btn_title"><i class="fas fa-lock"></i> Long In and Safety</p>
                 <p class="btn_description">Edit Logindata, Name and Number</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <div class="column  btn_column">
                 <p class="btn_title"><i class="fas fa-truck"></i> Orders</p>
                 <p class="btn_description">See the status of your Orders</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <div class="column  btn_column">
                 <p class="btn_title"><i class="fab fa-paypal"></i> Payment Details</p>
                 <p class="btn_description">bla bla bla</p>
             </div>
         </a> 
         <a class="btn" href="#">
             <div class="column  btn_column">
                 <p class="btn_title"><i class="fas fa-map-marker"></i> Adress</p>
                 <p class="btn_description">bla bla bla</p>
             </div>
         </a> 
     </div>
@endsection