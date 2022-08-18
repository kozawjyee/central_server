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
        Schema::create('txn_payment_collections', function (Blueprint $table) {
            $table->id();
            $table->string('PaymentCollectiionID');
            $table->string('TxnID');
            $table->integer('TxnTypeID');
            $table->string('PaymentMethodID');
            $table->integer('PaidAmount');
            $table->string('CurrencyCode');
            $table->string('ChequeNo');
            $table->string('BankName');
            $table->string('Remark');
            $table->datetime('PaidDate');
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
        Schema::dropIfExists('txn_payment_collections');
    }
};
