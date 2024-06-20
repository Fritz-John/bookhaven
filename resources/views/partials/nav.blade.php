<nav class="navbar">
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">Book Haven</label>
    <ul>
        <li> <a href="{{route('homepage')}} " class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
        <li> <a href="{{route('shop')}}" class="{{ Request::is('shop') ? 'active' : '' }}">Shop</a></li>
        @auth
        <li> <a href="{{route('cart')}}" class="{{ Request::is('cart') ? 'active' : '' }}">Cart</a></li>
        <li> <a href="{{route('show-orders')}}" class="{{ Request::is('show-orders') ? 'active' : '' }}">Orders</a></li>
        <li> <a href="{{route('profile')}}" class="{{ Request::is('profile') ? 'active' : '' }}">Profile</a></li>
        @endauth

        @guest
        <li> <a href="{{route('login')}}" class="{{ Request::is('login') ? 'active' : '' }}">Log in</a></li>
        @endguest

    </ul>


</nav>