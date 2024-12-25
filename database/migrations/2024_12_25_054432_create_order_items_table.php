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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Link to orders table
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Link to products table
            $table->integer('quantity'); // Quantity of the product
            $table->decimal('price', 10, 2); // Price of the product at the time of order
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};