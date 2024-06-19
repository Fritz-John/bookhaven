<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\User;
use Illuminate\Http\Request;

class OrderDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = 1;
        $orders = Orders::where('user_id', $user_id)->where('status', 'completed')->get();

        return view('orders.index', [
            'orders' => $orders
        ]);
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

        //
    }

    /**
     * Display the specified resource.
     */
    public function show(OrderDetails $order_id_details)
    {
        $orders = OrderDetails::get();

        return view('orders.show-orders', [
            'showDetail' => $order_id_details
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, OrderDetails $orderDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(OrderDetails $orderDetails)
    {
        //
    }
}
