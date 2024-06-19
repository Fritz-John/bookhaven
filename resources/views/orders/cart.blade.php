<x-app>
    <div class="cart-container" style="margin-top: 100px">
        <h1>Your Cart</h1>

        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (count($items) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Book</th>
                    <th>Quantity</th>
                    <th>Unit Price</th>
                    <th>Total Price</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($items as $item)
                <tr>
                    <td>{{ $item->book->title }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->quantity * $item->unit_price }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total Amount: {{ $total_amount }}</h3>
        <form action="{{ route('checkout') }}" method="POST">
            @csrf
            <button type="submit" class="btn">Checkout</button>
        </form>
        @else
        <p>Your cart is empty.</p>
        @endif
    </div>

</x-app>