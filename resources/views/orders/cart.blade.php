<x-app>


    <div class="cart-container">
        @if (count($items) > 0)

        <div class="cart-items">
            <h1>Your Cart</h1>
            <div class="cart-table">
                <table class="table" style="background-color:white">
                    <thead>
                        <tr>
                            <th>Book</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                        <tr>
                            <td>{{ $item->book->title }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->unit_price }}</td>
                            <td>{{ $item->quantity * $item->unit_price }}</td>
                            <td>
                                <form action="{{ route('remove',$item->id)}}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button style="background-color: rgb(107, 23, 23); color:white"> Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <h3 style="margin-bottom:20px">Total Amount: {{ $total_amount }}</h3>
        </div>
        <div class="checkout-form">
            <h1>Checkout Details</h1>
            <form action="{{ route('checkout') }}" method="POST">
                @csrf


                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" class="form-control" value="{{ $user_detail->name}}"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ $user_detail->email}}"
                        readonly>
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <textarea id="address" name="address" class="form-control" rows="3"
                        readonly> {{ $user_detail->address}}</textarea>
                </div>

                <div class="form-group">
                    <label for="address">Phone</label>
                    <input id="phone" name="phone" class="form-control" rows="3" readonly
                        value="{{ $user_detail->phone}}">
                    </input>
                </div>

                <div class="form-group">
                    <label for="payment_method">Mode of Payment</label>
                    <select id="payment_method" name="payment_method" class="form-control" required>
                        <option value="cod">COD</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Checkout</button>
            </form>
        </div>

        @else
        <p>Your cart is empty.</p>
        @endif


    </div>
    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</x-app>