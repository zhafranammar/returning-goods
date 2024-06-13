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
        Schema::create('report_incoming_products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code');
            $table->string('supplier_code');
            $table->date('received_date');
            $table->integer('quantity');
            $table->string('quality_status');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->foreign('product_code')->references('code')->on('products')->onDelete('cascade');
            $table->foreign('supplier_code')->references('code')->on('suppliers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_incoming_products');
    }
};
