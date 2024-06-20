<x-app>
    <div class="main">
        @if(session('success'))
        <div class=" alert-success">
            {{ session('success') }}
        </div>
        @endif
        <h2>Profile</h2>
        <div class="card-profile">

            <div class="card-body">
                <a href="{{route('edit-profile')}}"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                            <td>:</td>
                            <td>{{$users->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>:</td>
                            <td>{{$users->email}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                            <td>:</td>
                            <td>{{$users->address}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                            <td>:</td>
                            <td>{{$users->phone}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <form action="{{route('logout')}}" method="GET">
            @csrf
            <button type="submit">Log out</button>
        </form>
        {{-- <button onclick="window.location.href='{{route('logout')}}'" class="button"></button> --}}
    </div>
</x-app>