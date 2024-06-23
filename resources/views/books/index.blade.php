<x-app>
    <div style="margin-top:100px">
        <x-flash-message />
    </div>

    <section class="masthead">

        <img src="{{ asset('assets/images/book-cover.png') }}" alt="">
        <div class="hero-text">
            <h1>Perfect place to know what you dont know</h1>
            <p>Read all new knowledge</p>
            <button onclick="window.location.href='{{ route('shop') }}'">Check our Books!</button>
        </div>


    </section>



    <section class="carousel-container">
        <h1>Featured Books</h1>
        @unless (count($books) == 0)
        <div class="carousel">
            @foreach ($books as $book)
            <div class="carousel-item">
                <div class="carousel-image-container">
                    <img src="{{$book->image_path ? asset('storage/'.$book->image_path) : 'https://placehold.co/600x400'}} "
                        alt=" {{$book->title }}">
                </div>

                <div class="book-details">
                    <h3>Title: {{$book->title }}</h3>
                    <p>{{ substr($book->description, 0, 20) }}{{ strlen($book->description) > 20 ? "..." : "" }}</p>
                    <p>Author: {{$book->author }}</p>
                    <p>Category: {{$book->categories->name }}</p>
                    <button class="show-more-btn"
                        onclick="showBookDialog('{{ $book->title }}', '{{ $book->description }}', '{{ $book->author }}', '{{ $book->category }}', '{{asset('storage/'.$book->image_path)}}')">Show
                        More</button>
                </div>
            </div>
            @endforeach
        </div>
        <div class="controls">
            <button class="prev-btn">&lt; Prev</button>
            <button class="next-btn">Next &gt;</button>
        </div>
        @else

        <h1>No featured books found!</h1>

        @endunless

    </section>


    <div class="backdrop" id="backdrop"></div>
    <dialog id="dialog">
        <h2 id="dialog-title">Title</h2>
        <p id="dialog-description">Description</p>
        <p id="dialog-author">Author</p>
        <p id="dialog-category">Category</p>
        <div class="dialog-image-container">
            <img id="dialog-image" src="" alt="">
        </div>
        <button onclick="closeDialog();" aria-label="close" class="x">❌</button>
    </dialog>









</x-app>