<div class="nav">
        <a class="nav_item_left" href="#">Home</a>
        <a class="nav_item_left" href="shop">Shop</a>
        <a class="nav_item_left" href="/">About</a>

        <div class="LogStat_dropdown">
            <span class="log_status">Not Logged in
                <!--<?php
                //if(isset($_SESSION["email"])){
                  //  echo "Logged in as ".$_SESSION["email"];
                //}else{ echo "Not logged in";}
                ?> -->
            </span>
            <div class="LogStat_dropdown_content">
                <a href="cart.php"><img src="img/cart.png" class="icon_Cart">Cart</a>
                <!-- DropDown Optionen Abhängig vom LogIn status  -->
                        <a  href="#">Log Off</a>
                        <a  href="profile">Profile</a>
                        <a  href="#">Settings</a>
                        <a  onclick="on()">Log In</a>
            </div>
        </div>
</div>