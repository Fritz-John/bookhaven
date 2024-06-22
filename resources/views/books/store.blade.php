<x-app>
    <div class="book-container">
        <h1>Add a New Book</h1>

        <form action="{{route('store-book')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" required>
            </div>

            <div class="form-group">
                <label for="author">Price</label>
                <input type="number" id="price" name="price" required>
            </div>

            <div class="form-group">
                <label for="author">Stock Quantity</label>
                <input type="number" id="stock_quantity" name="stock_quantity" required>
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select id="categories" name="categories" required>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="categories">Featured</label>
                <select id="featured" name="featured" required>
                    <option value="1">Featured</option>
                    <option value="0">Not featured</option>
                </select>
            </div>


            <div class="form-group">
                <label for="image">Book Cover Image</label>
                <input type="file" id="image_path" name="image_path">
            </div>

            <button type="submit">Add Book</button>
        </form>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</x-app>