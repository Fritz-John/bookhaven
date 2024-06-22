<x-app>
    <div class="book-container">

        <h1>Add a New Category</h1>

        <form action="{{route('store-category')}}" method="POST">
            @csrf

            <div class="form-group">
                <label for="title">Name</label>
                <input type="text" id="name" name="name" required>
            </div>
            @error('name')
            <p class="text-danger">{{ $message }}</p>
            @enderror
            <button type="submit">Add Category</button>
        </form>
    </div>

    @if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
    @endif
</x-app>