<x-app>
    <section class="masthead">
        <img src="{{ asset('assets/images/book-cover.png') }}" alt="">
        <div class="hero-text">
            <h1>Perfect place to know what you dont know</h1>
            <p>Read all new knowledge</p>
            <button>Check our Books!</button>
        </div>
    </section>



    <section class="carousel-container">
        <h1>Featured Books</h1>
        <div class="carousel">

            @foreach ($books as $book)
            <div class="carousel-item">
                <img src="https://placehold.co/600x400" alt="Book 1">
                <div class="book-details">
                    <h3>Title: {{$book->title }}</h3>
                    <p>Description: {{$book->description }}</p>
                    <p>Author: {{$book->author }}</p>
                    <p>Category: {{$book->category }}</p>
                    <button class="show-more-btn"
                        onclick="showBookDialog('{{ $book->title }}', '{{ $book->description }}', '{{ $book->author }}', '{{ $book->category }}')">Show
                        More</button>
                </div>
            </div>
            @endforeach


            <!-- Add more carousel items as needed -->
        </div>
        <div class="controls">
            <button class="prev-btn">&lt; Prev</button>
            <button class="next-btn">Next &gt;</button>
        </div>



    </section>
    <div class="backdrop" id="backdrop"></div>
    <dialog id="dialog">
        <h2 id="dialog-title">Title</h2>
        <p id="dialog-description">Description</p>
        <p id="dialog-author">Author</p>
        <p id="dialog-category">Category</p>
        <img src="https://placehold.co/600x400" alt="">
        <button onclick="closeDialog();" aria-label="close" class="x">❌</button>
    </dialog>





    



</x-app>