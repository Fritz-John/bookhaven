<nav class="navbar">
    <input type="checkbox" id="check">
    <label for="check" class="checkbtn">
        <i class="fas fa-bars"></i>
    </label>
    <label class="logo">Book Haven</label>
    <ul>

        <li> <a href="{{ route('homepage') }}" class="{{ Request::is('/') ? 'active' : '' }}">Home</a></li>
        <li> <a href="{{ route('shop') }}" class="{{ Request::is('shop') ? 'active' : '' }}">Shop</a></li>
        @auth
        @if (auth()->user()->role === 'admin')
        <li class="select-wrapper ">
            <select onchange="location = this.value;"
                class="{{ Request::is('all-categories') ? 'active' : '' }} {{ Request::is('all-books') ? 'active' : '' }} {{ Request::is('create-book') ? 'active' : '' }} {{ Request::is('create-category') ? 'active' : '' }}">
                <option value="" selected>Admin Actions</option>
                <option value="{{ route('all-categories') }}" {{ Request::is('all-categories') ? 'selected' : '' }}>All
                    Categories</option>
                <option value="{{ route('create-category') }}" {{ Request::is('create-category') ? 'selected' : '' }}>
                    Add Categories</option>
                <option value="{{ route('all-books') }}" {{ Request::is('all-books') ? 'selected' : '' }}>All Books
                </option>
                <option value="{{ route('create-book') }}" {{ Request::is('create-book') ? 'selected' : '' }}>Add Book
                </option>

            </select>
        </li>

        @endif

        <li> <a href="{{ route('cart') }}" class="{{ Request::is('cart') ? 'active' : '' }}">Cart</a></li>
        <li> <a href="{{ route('show-orders') }}" class="{{ Request::is('show-orders') ? 'active' : '' }}">Orders</a>
        </li>
        <li> <a href="{{ route('profile') }}" class="{{ Request::is('profile') ? 'active' : '' }}">Profile</a></li>
        @endauth


        @guest
        <li> <a href="{{ route('login') }}" class="{{ Request::is('login') ? 'active' : '' }}">Log in</a></li>
        @endguest
    </ul>
</nav>