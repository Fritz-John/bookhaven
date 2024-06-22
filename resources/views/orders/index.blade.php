<x-app>


    <div class="orders-container">


        <h1>All Orders</h1>
        @unless (count($orders) == 0)

        @foreach ($orders as $order)


        <div class="order">
            <div class="order-details">
                <p><strong>Order ID:</strong>#{{$order->id}}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->created_at)->format('Y-m-d') }}</p>
                <p><strong>Mode of Payment:</strong> {{$order->mode_of_payment}}</p>
                <p><strong>Total:</strong> ₱{{ number_format( $order->total_amount, 2) }}</p>
            </div>
            <div class="order-actions">
                <a href="{{ route('show-order',$order->id)}}"> <button type="submit">View Details</button></a>
                {{-- <form action="" method="GET">

                </form> --}}
            </div>
        </div>

        @endforeach
        @else

        <h1> No orders found! </h1>
        @endunless


    </div>
</x-app>