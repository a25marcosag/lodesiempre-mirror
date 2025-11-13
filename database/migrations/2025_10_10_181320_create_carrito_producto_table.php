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
            $table->foreign('producto_id')->nullable()->constrained('productos');
            $table->foreign('carrito_id')->constrained('carritos');

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
