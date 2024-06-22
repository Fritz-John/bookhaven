<x-app>


    <div class="container-user">
        <div class="form">
            <header>Signup</header>
            <form action="{{route('create')}}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" id="phone" name="phone" value="{{ old('phone') }}">
                    @error('phone')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address">{{ old('address') }}</textarea>
                    @error('address')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    @error('password')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation">
                </div>
                <input type="submit" class="button" value="Signup">
            </form>
            <div class="signup">
                <span>Already have an account? <a href="{{route('login')}}">Login</a></span>
            </div>
        </div>
    </div>









</x-app>