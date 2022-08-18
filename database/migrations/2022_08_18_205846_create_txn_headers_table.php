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
        Schema::create('txn_headers', function (Blueprint $table) {
            $table->id();
            $table->string('TxnID');
            $table->string('TxnTypeID');
            $table->string('TxnDate');
            $table->string('CustomerID');
            $table->string('SalesPersonID');
            $table->string('CurrencyCode');
            $table->string('TaxRate');
            $table->string('TaxInclusive');
            $table->string('CreditTermID');
            $table->string('PaymentMethodID');
            $table->integer('TotalBeforeDiscount');
            $table->integer('DiscountAmount');
            $table->integer('TaxAmount');
            $table->integer('Total');
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
        Schema::dropIfExists('txn_headers');
    }
};
