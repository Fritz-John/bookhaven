<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $books = Books::find($request->book_id);

        $order = Orders::firstOrCreate(
            ['user_id' => auth()->id(), 'status' => 'cart'],
            ['total_amount' => 0]
        );


        $orderDetail = new OrderDetails();
        $orderDetail->orders_id = $order->id;
        $orderDetail->books_id = $books->id;
        $orderDetail->quantity = $request->quantity;
        $orderDetail->unit_price = $books->price;
        $orderDetail->save();

        $order->total_amount += $request->quantity * $books->price;
        $order->save();

        return redirect()->route("show", $books->id)->with('success', 'Order placed successfully!');
    }

    public function show_cart()
    {

        $cart = Orders::where('user_id', auth()->id())->where('status', 'cart')->first();

        if (!$cart) {
            return view('orders.cart', ['items' => []]);
        }

        $items = $cart->orders()->with('book')->get();

        $user_detail = User::find(auth()->id())->first();

        return view('orders.cart', [
            'items' => $items,
            'total_amount' => $cart->total_amount,
            'user_detail' =>  $user_detail
        ]);
    }

    public function checkout(Request $request)
    {
        $cart = Orders::where('user_id', auth()->id())->where('status', 'cart')->first();


        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }
        
        foreach ($cart->orders as $order) {
            $book = $order->book;
            $book->stock_quantity -= $order->quantity;
            $book->save();
        }

        $cart->status = 'completed';
        $cart->mode_of_payment = $request->payment_method;
        $cart->save();

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
    
    public function show(Orders $orders)
    {
        //
    }

    public function edit(Orders $orders)
    {
        //
    }


    public function update(Request $request, Orders $orders)
    {
        //
    }

    public function destroy(Orders $orders)
    {
        //
    }
}
