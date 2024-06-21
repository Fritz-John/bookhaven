<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{

    public function index()
    {

        return view('orders.index', [
            'orders' => Orders::where('user_id', auth()->id())->where('status', 'completed')->get()
        ]);
    }

    public function show_order($order_id_details)
    {
        $order = Orders::with('user', 'orders.book')->findOrFail($order_id_details);
        
        return view('orders.show-orders', [
            'showDetail' =>  $order,


        ]);
    }
}
