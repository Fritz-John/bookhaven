<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Books;
use App\Models\Orders;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;

class OrdersController extends Controller
{

    protected $orderModel;

    public function __construct()
    {
        $this->orderModel = new Orders();
    }

    public function store(Request $request)
    {

        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $this->orderModel->addToCart($request->book_id, $request->quantity);

        return redirect()->route("show", $request->book_id)->with('success', 'Order placed successfully!');
    }

    public function remove_item_cart(OrderDetails $cart_item)
    {
        $this->orderModel->removeToCart($cart_item);

        return redirect()->route("cart")->with('success', 'Removed item from cart successfully!');
    }

    public function show_cart()
    {

        $cart = Orders::where('user_id', auth()->id())->where('status', 'cart')->first();

        if (!$cart) {
            return view('orders.cart', ['items' => []]);
        }
        
        return view('orders.cart', [
            'items' => $cart->orders()->with('book')->get(),
            'total_amount' => $cart->total_amount,
            'user_detail' =>  auth()->user()
        ]);
    }

    public function checkout(Request $request)
    {
        $this->orderModel->checkOut($request);  

        return redirect()->route('cart')->with('success', 'Order placed successfully!');
    }
}
