<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales_prices', function (Blueprint $table) {
            $table->id();
            $table->string('SalesPriceID')->nullable();
            $table->integer('SalesPriceType')->nullable();
            $table->string('SalesPriceTypeID')->nullable();
            $table->string('ItemID')->nullable();
            $table->string('UomID')->nullable();
            $table->integer('MinQuantity')->nullable();
            $table->integer('UnitPrice')->nullable();
            $table->integer('Discount')->nullable();
            $table->string('CurrencyCode')->nullable();
            $table->date('StartDate')->nullable();
            $table->date('EndDate')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_prices');
    }
};
