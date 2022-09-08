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
        Schema::create('stock_transfer_lines', function (Blueprint $table) {
            $table->id();
            $table->string('TransferID')->nullable();
            $table->integer('LineNo')->nullable();
            $table->string('ItemID')->nullable();
            $table->string('UomID')->nullable();
            $table->integer('Quantity')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stock_transfer_lines');
    }
};
