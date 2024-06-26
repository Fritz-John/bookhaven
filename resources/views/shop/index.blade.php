<x-app title="Shop">

    @include('partials.search')
    @if (request()->has('search') && trim(request('search')) !== '')
    <h5>Searching for: <span style="font-size:15px; color:rgb(79, 131, 66);">{{ request('search') }}</span> </h5>
    @endif
    @if (request()->has('category') && trim(request('category')) !== '')
    <h5>Searching for category: <span style="font-size:15px; color:rgb(79, 131, 66);">{{ request('category') }}</span>
    </h5>
    @endif

    <section class="cards">
        <div class="card-container">
            @unless (count($books) == 0)

            @foreach ($books as $book)


            <div class="card" onclick="window.location.href='{{ route('show',$book->id)}}'">
                <div class="image-container">
                    <img src="{{$book->image_path ? asset('storage/'.$book->image_path) : 'https://placehold.co/600x500'}} "
                        alt="">
                </div>

                <div class="card-content">
                    <h4>{{ substr($book->title, 0, 20) }}{{ strlen($book->title) > 20 ? "..." : "" }}</h4>
                    <p>{{ substr($book->description, 0, 20) }}{{ strlen($book->description) > 20 ? "..." : "" }}</p>
                    <p> <b> by: {{$book->author}}</b></p>
                    <a class="category-pill" href="/shop?category={{$book->categories->name}}"
                        style="text-decoration: none; color:black;">{{$book->categories->name}}</a>
                </div>
            </div>
            @endforeach
            @else
            <h1> No books found! </h1>
            @endunless
        </div>
    </section>


</x-app>