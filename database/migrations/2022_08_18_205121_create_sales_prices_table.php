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
            $table->string('SalesPriceID');
            $table->integer('SalesPriceType');
            $table->string('SalesPriceTypeID');
            $table->string('ItemID');
            $table->string('UomID');
            $table->integer('MinQuantity');
            $table->integer('UnitPrice');
            $table->integer('Discount');
            $table->string('CurrencyCode');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->timestamps();
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
