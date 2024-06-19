<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\OrderDetails;
use App\Models\Orders;
use Illuminate\Http\Request;

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
            ['user_id' => 1, 'status' => 'cart'],
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

        $cart = Orders::where('user_id', 1)->where('status', 'cart')->first();

        if (!$cart) {
            return view('orders.cart', ['items' => []]);
        }

        $items = $cart->orderDetails()->with('book')->get();


        return view('orders.cart', ['items' => $items, 'total_amount' => $cart->total_amount]);
    }

    public function checkout()
    {
        $cart = Orders::where('user_id', 1)->where('status', 'cart')->first();

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        foreach ($cart->orderDetails as $orderDetail) {
            $book = $orderDetail->book;
            $book->stock_quantity -= $orderDetail->quantity;
            $book->save();
        }

        $cart->status = 'completed';
        $cart->save();

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
    /**
     * Display the specified resource.
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orders $orders)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orders $orders)
    {
        //
    }
}
