<x-app>

    @php
    $total_amount = 0;


    @endphp
    <div class="order-detail-container">
        <h1>Order Details</h1>
        <div class="order">
            <div class="order-info">

                <p><strong>Order ID:</strong> # {{ $showDetail->id }}</p>
                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($showDetail->created_at)->format('Y-m-d') }}</p>
                <p><strong>Customer Name:</strong> {{ $showDetail->user->name }}</p>
                <p><strong>Customer email:</strong> {{ $showDetail->user->email }}</p>
                <p><strong>Customer Address:</strong> {{ $showDetail->user->address }}</p>
                <p><strong>Customer Phone:</strong> {{ $showDetail->user->phone }}</p>
            </div>
            <div class="order-items">
                <h2>Order Items</h2>
                @foreach ($showDetail->orders as $order)
                <p>{{ $order->book->title }} - {{ $order->quantity }} qty - ₱{{ $order->unit_price }}
                    @php

                    $total_amount += $order->quantity * $order->unit_price

                    @endphp
                </p>
                @endforeach
                <br>
                <p><strong>Total Price:</strong> ₱{{ number_format( $total_amount, 2) }}</p>

                <!-- Add more items if needed -->
            </div>
        </div>

        <h1>Book Details</h1>
        @foreach ($showDetail->orders as $order)
        <p><strong>Title:</strong> {{ $order->book->title }}</p>
        <p><strong>Description:</strong> {{ $order->book->description }}</p>
        <p><strong>Author:</strong> {{ $order->book->author }}</p>
        <p><strong>Category:</strong> {{ $order->book->categories->name }}</p>
        <br>
        @endforeach

        <div class="actions">
            <button onclick="window.location.href='{{ route('show-orders') }}'" class="back-button">Back to
                Orders</button>
        </div>
    </div>
</x-app>