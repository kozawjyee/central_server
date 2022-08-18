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
        Schema::create('txn_lines', function (Blueprint $table) {
            $table->id();
            $table->string('TxnOrderLineID');
            $table->string('TxnID');
            $table->integer('TxnTypeID');
            $table->integer('LineNum');
            $table->string('ItemID');
            $table->string('UomID');
            $table->integer('UomRate');
            $table->integer('UnitPrice');
            $table->integer('IssueQty');
            $table->integer('ReturnQty');
            $table->integer('NetQty');
            $table->boolean('IsFOC');
            $table->integer('DiscTotal');
            $table->integer('TaxRate');
            $table->integer('TaxAmount');
            $table->integer('LineTotalBfTax');
            $table->integer('LineTotal');
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
        Schema::dropIfExists('txn_lines');
    }
};
