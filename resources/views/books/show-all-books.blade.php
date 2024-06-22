<x-app>

    <div class="whole_container">
        <h1>All Books</h1>
        @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        <div class="all_books-container">

            <table>
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Stock Quantity</th>
                        <th>Featured</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>

                        <td>{{ $book->id }}</td>
                        <td>{{ $book->title }}</td>
                        <td>{{ $book->description }}</td>
                        <td>{{ $book->author }}</td>
                        <td>{{ $book->categories->name }}</td>
                        <td>Php. {{ $book->price }}</td>
                        <td>{{ $book->stock_quantity }}</td>
                        <td>{{ ($book->featured) ? 'Yes' : 'No' }}</td>

                        <td>
                            <form action="{{ route('remove-book',$book)}}" method="POST">
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

    </div>
</x-app>