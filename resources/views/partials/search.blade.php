<div class="search-bar-container">
    <form action=" {{route('shop')}} " method="GET">
        
        <input type="text" name="search" placeholder="Search for books,author,category..." class="search-input" value="{{ old('search', request('search')) }}">
        <button type="submit" class="search-button">Search</button>
    </form>
</div>