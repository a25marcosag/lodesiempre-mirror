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
        Schema::create('carrito_producto', function (Blueprint $table) {
            $table->id();
            $table->integer('cantidad')->default(1);

            $table->unsignedBigInteger('producto_id');
            $table->unsignedBigInteger('carrito_id');
            $table->foreign('producto_id')->references('id')->on('productos')->onDelete('cascade');
            $table->foreign('carrito_id')->references('id')->on('carritos')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carrito_producto');
    }
};
