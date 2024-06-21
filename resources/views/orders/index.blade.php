<x-app>


    <div class="orders-container">


        <h1>All Orders</h1>

        @foreach ($orders as $order)


        <div class="order">
            <div class="order-details">
                <p><strong>Order ID:</strong>#{{$order->id}}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</p>
                <p><strong>Mode of Payment:</strong> {{$order->mode_of_payment}}</p>
                <p><strong>Total:</strong> Php. {{$order->total_amount}}</p>
            </div>
            <div class="order-actions">
        

                <form action="{{ route('show-order',$order->id)}}" method="GET">
                    @csrf
                    <button type="submit">View Details</button>
                </form>

            </div>
        </div>

        @endforeach

    </div>
</x-app>