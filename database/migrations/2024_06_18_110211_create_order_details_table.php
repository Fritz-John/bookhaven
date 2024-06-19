<?php

use App\Models\Books;
use App\Models\Orders;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Orders::class)->onDelete('cascade');
            $table->foreignIdFor(Books::class)->onDelete('cascade');
            // $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            // $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->integer('quantity');
            $table->decimal('unit_price', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
