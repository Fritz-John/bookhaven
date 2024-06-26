<x-app title='All Categories'>

    <div class="whole_container">
        <h1>All Categories</h1>
        <x-flash-message />
        <div class="all_books-container">

            <table>
                <thead>
                    <tr>
                        <th>Category ID</th>
                        <th>Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                    <tr>

                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                     

                        <td>
                            <form action="{{ route('remove-category',$category)}}" method="POST">
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