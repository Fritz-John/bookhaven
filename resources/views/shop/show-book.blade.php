<x-app>

    <form action="{{ route('store-order') }}" method="POST">
        @csrf

        <div class="show-card-container">

            <div class="imgBx">
                <img src="https://placehold.co/600x400" alt="placeholder">
            </div>
            <div class="details">

                <div class="content">
                    <a class="back" href="{{ route('shop') }}"> <- Back </a>

                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <h2>{{$book->title}}</h2>
                    <span class="author">by: {{$book->author}}</span> <br>
                    <p class="category">Category: <span>{{$book->category}}</span></p>
                    <p class="description">{{$book->description}}</p>
                    <h3>Php. {{$book->price}}</h3>
                    <p class="stocks">Stocks: {{$book->stock_quantity}}</p>
                    <label for="quantity">Quantity:</label>
                    @if ($book->stock_quantity > 0)
                    <input type="number" id="quantity" name="quantity" min="1" value="1">
                    <button>Buy Now</button>
                    @else
                    <button disabled>Out of Stock!</button>
                    @endif

                </div>
            </div>
        </div>
        @if(session('success'))
        <div class=" alert-success">
            {{ session('success') }}
        </div>
        @endif
    </form>
</x-app>