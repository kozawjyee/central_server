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
        Schema::create('central_items', function (Blueprint $table) {
            $table->id();
            $table->string('cdomain');
            $table->string('username');
            $table->string('producttypevalue');
            $table->string('productname');
            $table->string('sequenceformatvalue');
            $table->string('productID');
            $table->string('currencyvalue');
            $table->timestamp('asOfDate');
            $table->string('purchaseAccountValue');
            $table->string('purchaseuom');
            $table->string('salesAccountValue');
            $table->string('salesReturnAccountValue');
            $table->string('salesuom');
            $table->string('stockuom');
            $table->string('uom');
            $table->string('warehouseValue');
            $table->string('locationValue');
            $table->string('stockAdjustmentAccountValue');
            $table->string('inventoryAccountValue');
            $table->string('costOfGoodsSoldAccountValue');
            $table->boolean('isWarehouseForProduct');
            $table->boolean('isLocationForProduct');
            $table->string('desc');
            $table->string('additionaldescription');
            $table->boolean('is_success');
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
        Schema::dropIfExists('central_items');
    }
};
