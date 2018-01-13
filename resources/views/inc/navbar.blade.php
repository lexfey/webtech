<nav class="navbar navbar-inverse">
            <div class="nav">
                
                <!-- Left Side Of Navbar -->
                <a class="nav_item_left" href="#">Home</a>
                <a class="nav_item_left" href="{{ route('shop.index') }}">Shop</a>
                <a class="nav_item_left" href="/">About</a>


                <!-- Right Side Of Navbar -->
                <div class="LogStat_dropdown">
                    <!-- Authentication Links -->
                    @guest
                         <span class="log_status">Not LoggedIn</span>
                         <div class="LogStat_dropdown_content">
                            <a href="#"><img src="{{asset('img/cart.png')}}" class="icon_Cart">Cart</a>
                            <a  href="{{ route('login') }}">Login</a>
                            <a  href="{{ route('register') }}">Register</a>
                         </div>
                    @else
                        <span class="log_status">{{ Auth::user()->name }}</span>
                         <div class="LogStat_dropdown_content">
                            <a href="#"><img src="{{asset('img/cart.png')}}" class="icon_Cart">Cart</a>
                            <a  href="#">Profile</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                         document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>

                         </div>
                    @endguest
                </div>
               
            </div>
        </nav>