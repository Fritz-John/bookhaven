<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'total_amount', 'mode_of_payment'];

    public function addToCart($bookId, $quantity)
    {
        $books = Books::find($bookId);

        $order = Orders::firstOrCreate(
            ['user_id' => Auth::id(), 'status' => 'cart'],
            ['total_amount' => 0]
        );

        $orderDetail = OrderDetails::where('orders_id', $order->id)
            ->where('books_id', $books->id)
            ->first();

        if ($orderDetail) {
            $orderDetail->quantity += $quantity;
            $orderDetail->save();
        } else {
            $orderDetail = new OrderDetails();
            $orderDetail->orders_id = $order->id;
            $orderDetail->books_id = $books->id;
            $orderDetail->quantity = $quantity;
            $orderDetail->unit_price = $books->price;
            $orderDetail->save();
        }

        $order->total_amount += $quantity * $books->price;
        $order->save();

        UserActivityLog::create([
            'user_id' => auth()->id(),
            'activity' => 'Placing an item to cart',
            'details' => 'Added to cart ' . $books->title,
        ]);
    }

    public function removeToCart($cart_item)
    {
        $order = Orders::find($cart_item->orders_id);



        $orderDetailsWithBooks = $order->orders()->with('book')->get();

        foreach ($orderDetailsWithBooks as $orderDetail) {
            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Removing an item to cart',
                'details' => 'Removed to cart ' . $orderDetail->book->title,
            ]);
        }

        $order->total_amount -= $cart_item->quantity * $cart_item->unit_price;
        $order->save();

        $cart_item->delete();
    }

    public function checkOut($request)
    {
        $cart = Orders::where('user_id', auth()->id())->where('status', 'cart')->first();

        if (!$cart) {
            return redirect()->route('cart')->with('error', 'Your cart is empty.');
        }

        foreach ($cart->orders as $order) {
            $book = $order->book;
            $book->stock_quantity -= $order->quantity;
            $book->save();

            UserActivityLog::create([
                'user_id' => auth()->id(),
                'activity' => 'Checked out',
                'details' => 'Checked out items' .  $book->title,
            ]);
        }

        $cart->status = 'completed';
        $cart->mode_of_payment = $request->payment_method;
        $cart->save();
    }

    public function orders()
    {
        return $this->hasMany(OrderDetails::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
