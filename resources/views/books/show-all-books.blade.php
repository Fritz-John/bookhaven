<x-app>

    <div class="whole_container">
        <h1>All Books</h1>
        
        <x-flash-message />

        <div class="all_books-container">

            <table>
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Title</th>
                        <th style="width: 350px;">Description</th>
                        <th style="width: 250px;">Author</th>
                        <th>Category</th>
                        <th style="width: 200px;">Price</th>
                        <th style="width: 250px;" >Stock Quantity</th>
                        <th >Featured</th>
                        <th style="width: 250px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                    <tr>

                        <td>{{ $book->id }}</td>
                        <td >{{ $book->title }}</td>
                        <td >{{ $book->description }}</td>
                        <td >{{ $book->author }}</td>
                        <td>{{ $book->categories->name }}</td>
                        <td >₱ {{number_format( $book->price,'2')}}</td>
                        <td >{{ $book->stock_quantity }}</td>
                        <td >{{ ($book->featured) ? 'Yes' : 'No' }}</td>

                        <td >
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