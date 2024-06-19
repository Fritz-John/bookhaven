<x-app>

    @include('partials.search')
  

    <section class="cards">
        <div class="card-container">
            @foreach ($books as $book)
            <div class="card" onclick="window.location.href='{{ route('show',$book->id)}}'">
                <img src="https://placehold.co/600x400" alt="">
                <div class="card-content">
                    <h4>{{$book->title}}</h4>
                    <p> {{$book->description}}</p>
                    <p> <b> by: {{$book->author}}</b></p>
                    <a class="category-pill" href="/shop?category={{$book->category}}" style="text-decoration: none; color:black;">{{$book->category}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </section>


</x-app>