<x-app>

    <form action="{{ route('store-order') }}" method="POST">
        @csrf

        <div class="show-card-container">

            <div class="imgBx">
                <img src="{{$book->image_path ? asset('storage/'.$book->image_path) : 'https://placehold.co/600x400'}} "
                    alt="">
            </div>
            <div class="details">

                <div class="content">
                    <a class="back" href="{{ route('shop') }}">
                        <- Back </a>

                            <input type="hidden" name="book_id" value="{{ $book->id }}">
                            <h2>{{$book->title}}</h2>
                            <span class="author">by: {{$book->author}}</span> <br>
                            <p class="category">Category: <span>{{$book->categories->name}}</span></p>
                            <p class="description">{{$book->description}}</p>
                            <h3>₱ {{number_format($book->price,'2') }}</h3>
                            <p class="stocks">Stocks: {{$book->stock_quantity}}</p>
                            <label for="quantity">Quantity:</label>
                            @if ($book->stock_quantity > 0)
                            <input type="number" id="quantity" name="quantity" min="1" value="1">
                            <button>Add to Cart</button>
                            @else
                            <button disabled>Out of Stock!</button>
                            @endif

                </div>
            </div>
        </div>
        <x-flash-message />

    </form>
</x-app>