<x-app>



    <div class="container-user">
        <div class="form">
            <header>Login</header>
            <form action="{{route('authenticate')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" placeholder="Enter your email" value="{{old('email')}}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter your password">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p> 
                    @enderror
                </div>

                <input type="submit" class="button" value="Log in">
            </form>
            <div class="signup">
                <span class="signup">Don't have an account?
                    <a href="{{route('signup')}}">Sign-up</a>
                </span>
            </div>
        </div>
    </div>


</x-app>