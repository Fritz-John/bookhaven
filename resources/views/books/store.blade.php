<x-app>
   
    <div class="book-container">
        <x-flash-message />
        <h1>Add a New Book</h1>

        <form action="{{route('store-book')}}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{old('title')}}">
                @error('title')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4">{{old('description')}}</textarea>
                @error('description')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="author">Author</label>
                <input type="text" id="author" name="author" value="{{old('author')}}">
                @error('author')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="price">Price</label>
                <input type="number" id="price" name="price" value="{{old('price')}}">
                @error('price')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="author">Stock Quantity</label>
                <input type="number" id="stock_quantity" name="stock_quantity" value="{{old('stock_quantity')}}">
                @error('stock_quantity')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="categories">Categories</label>
                <select id="categories" name="categories">
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{(old("categories", $category->id) == $category->id ?
                        "selected" : " ")}}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('categories')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="featured">Featured</label>
                <select id="featured" name="featured" required>
                    <option value="1" {{(old("featured", 1)==1 ? "selected" : " " )}}>Featured</option>
                    <option value="0" {{(old("featured", 0)==0 ? "selected" : " " )}}>Not featured</option>
                </select>
                @error('featured')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>


            <div class="form-group">
                <label for="image">Book Cover Image</label>
                <input type="file" id="image_path" name="image_path">

            </div>

            <button type="submit">Add Book</button>
        </form>
    </div>

</x-app>