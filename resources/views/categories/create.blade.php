<x-app>
    <div class="book-container">

        <h1>Add a New Category</h1>
        <x-flash-message />
        <form action="{{route('store-category')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" id="name" name="name" value="{{old('name')}}">
            </div>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit">Add Category</button>
        </form>
    </div>



</x-app>