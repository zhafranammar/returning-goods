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
        Schema::create('report_damaged_products', function (Blueprint $table) {
            $table->id();
            $table->date('report_date');
            $table->bigInteger('report_incoming_id');
            $table->string('transaction_code')->unique()->nullable();
            $table->string('product_code');
            $table->string('supplier_code');
            $table->integer('quantity');
            $table->text('damage_description')->nullable();
            $table->string('status_report');
            $table->timestamps();
            $table->foreign('product_code')->references('code')->on('products')->onDelete('cascade');
            $table->foreign('supplier_code')->references('code')->on('suppliers')->onDelete('cascade');
            $table->foreign('report_incoming_id')->references('id')->on('report_incoming_products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_damaged_products');
    }
};
