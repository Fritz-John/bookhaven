<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    use HasFactory;

    protected $fillable = ['orders_id', 'books_id', 'quantity', 'unit_price'];




    public function book()
    {
        return $this->belongsTo(Books::class, 'books_id', 'id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'orders_id', 'id');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetails::class, 'orders_id');
    }
}
