<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Categories;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    protected $bookModel;

    public function __construct()
    {
        $this->bookModel = new Books();
    }
    public function index()
    {
        $orderDetails = OrderDetails::with('book')->get();

        $books =  Books::where('featured', 1)->get();

        return view('books.index', [
            'books' =>  $books
        ]);
        //
    }

    public function all_books()
    {
        return view('books.show-all-books', [
            'books' => Books::latest()->get()
        ]);
    }

    public function show_all(Request $request)
    {
        return view('shop.index', [
            'books' => Books::latest()->filter(request(['category', 'search']))->get()
        ]);
    }

    public function remove_book($books_item)
    {

        $check_status = $this->bookModel->removeBook($books_item);

        if ($check_status) {
            return redirect()->route('all-books')->with('success', 'Removed book successfully!');
        } else {
            return redirect()->route('all-books')->with('error', 'An error has occured!');
        }
      
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('books.store', [
            'categories' => Categories::all()
        ]);
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $this->bookModel->store_book($request);

       
        return redirect()->route('create-book')->with('success', 'Added new book');

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Books $book_id)
    {
        return view('shop.show-book', [

            'book' => $book_id
        ]);
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Books $books)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Books $books)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Books $books)
    {
        //
    }
}
