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
        Schema::create('customer_price_histories', function (Blueprint $table) {
            $table->id();
            $table->string('CustomerPricehistoryID');
            $table->string('TxnID');
            $table->string('CustomerID');
            $table->date('TxnDate');
            $table->string('SalesPersonID');
            $table->string('ItemID');
            $table->string('UomID');
            $table->integer('Qty');
            $table->integer('UomRate');
            $table->biginteger('UnitPrice');
            $table->string('CurrencyCode');
            $table->integer('CurrencyRate');
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
        Schema::dropIfExists('customer_price_histories');
    }
};
