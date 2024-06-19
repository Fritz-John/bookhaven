<nav class="navbar">
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">Book Haven</label>
    <ul>
        <li> <a href="{{route('homepage')}} " class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
        <li> <a href="{{route('shop')}}" class="{{ Request::is('shop') ? 'active' : '' }}">Shop</a></li>
    </ul>


</nav>