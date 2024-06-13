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
        Schema::create('report_returning_products', function (Blueprint $table) {
            $table->id();
            $table->date('confirm_date');
            $table->date('return_date')->nullable();
            $table->date('finished_date')->nullable();
            $table->bigInteger('report_damaged_id');
            $table->string('product_code');
            $table->string('supplier_code');
            $table->integer('quantity');
            $table->text('notes')->nullable();
            $table->string('status_return');
            $table->foreign('product_code')->references('code')->on('products')->onDelete('cascade');
            $table->foreign('supplier_code')->references('code')->on('suppliers')->onDelete('cascade');
            $table->foreign('report_damaged_id')->references('id')->on('report_damaged_products')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report_returning_products');
    }
};
