<x-app>


    <div class="orders-container">


        <h1>All Orders</h1>

        @foreach ($orders as $orderDetail)
        <div class="order">
            <div class="order-details">
                <p><strong>Order ID:</strong>#{{$orderDetail->id}}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($orderDetail->created_at)->format('Y-m-d') }}</p>
               
                <p><strong>Total:</strong> Php. {{$orderDetail->total_amount}}</p>
            </div>
            <div class="order-actions">
                <button  onclick="window.location.href='{{ route('show-order',$orderDetail)}}'">View Details</button>
            </div>
        </div>
       
        @endforeach

    </div>
</x-app>