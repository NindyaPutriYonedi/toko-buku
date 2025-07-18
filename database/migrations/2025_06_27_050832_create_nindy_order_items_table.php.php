<?php

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
        Schema::create('nindy_order_items', function (Blueprint $table) {
    $table->id();
    $table->foreignId('order_id')->constrained('nindy_orders');
    $table->foreignId('book_id')->constrained('nindy_books');
    $table->integer('quantity');
    $table->decimal('price', 8, 2);
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
