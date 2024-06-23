<x-app title="Profile">
    <div class="main">
        <x-flash-message />
        <h2>Profile</h2>
        <div class="card-profile">

            <div class="card-body">
                <a href="{{route('edit-profile')}}"><i class="fa fa-pen fa-xs edit"></i></a>
                <table>
                    <tbody>
                        <tr>
                            <td>Name</td>
                           
                            <td>{{$users->name}}</td>
                        </tr>
                        <tr>
                            <td>Email</td>
                         
                            <td>{{$users->email}}</td>
                        </tr>
                        <tr>
                            <td>Address</td>
                          
                            <td>{{$users->address}}</td>
                        </tr>
                        <tr>
                            <td>Phone</td>
                         
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
        <div class="card-profile">
            <h2 style="text-align: center">User Activity Logs</h2>
            <div class="logs-list">
                @unless (count($logs) == 0)

                @foreach ($logs as $log)
                <div class="log-item">
                    @if ($log->user_id == auth()->id())
                    <p><strong>Activity:</strong> {{ $log->activity }}</p>
                    <p><strong>Details:</strong> {{ $log->details }}</p>
                    <p><strong>Created At:</strong> {{ $log->created_at }}</p>
                    @endif

                    <hr>
                </div>
                @endforeach
                @else
                <h1>No user activity!</h1>
                @endunless

            </div>
        </div>

        {{-- <button onclick="window.location.href='{{route('logout')}}'" class="button"></button> --}}
    </div>
</x-app>