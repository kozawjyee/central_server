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
        Schema::create('customer_outstanding_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('TxnID');
            $table->date('TxnDate');
            $table->string('CreditTermID');
            $table->string('CurrencyCode');
            $table->string('InvoiceAmt');
            $table->string('PaidAmt');
            $table->string('OverdueAmt');
            $table->date('DueDate');
            $table->integer('DaysOverdue');
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
        Schema::dropIfExists('customer_outstanding_invoices');
    }
};
