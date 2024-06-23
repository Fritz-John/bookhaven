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

        $check_status = $this->orderModel->addToCart($request->book_id, $request->quantity);

        if ($check_status) {
            return redirect()->route("show", $request->book_id)->with('success', 'Added to cart successfully!');
        } else {
            return redirect()->route("show", $request->book_id)->with('error', 'Quantity should not be higher than the stocks!');
        }
    }

    public function remove_item_cart(OrderDetails $cart_item)
    {
        $this->orderModel->removeToCart($cart_item);

        return redirect()->route("cart")->with('success', 'Removed item from cart successfully!');
    }

    public function show_cart()
    {


        $cart = Orders::where('user_id', auth()->id())->where('status', 'cart')->first();

        $items = [];
        $total_amount = 0;

        if ($cart == null) {
            $items = [];
            $total_amount = 0;
        } else {
            $items = $cart->orders()->with('book')->get();
            $total_amount = $cart->total_amount;
        }

        return view('orders.cart', [
            'user_detail' =>  auth()->user(),
            'items' =>  $items,
            'total_amount' =>   $total_amount,

        ]);
    }

    public function checkout(Request $request)
    {
        $this->orderModel->checkOut($request);

        return redirect()->route('show-orders')->with('success', 'Order placed successfully!');
    }
}
