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
        Schema::create('item_details', function (Blueprint $table) {
            $table->id();
            $table->string('ItemID')->nullable(); 
            $table->string('UomID')->nullable(); 
            $table->string('UomName')->nullable(); 
            $table->integer('UomRate')->nullable(); 
            $table->integer('DefaultUnitPrice')->nullable(); 
            $table->string('BarcodeNo')->nullable(); 
            $table->string('Remark')->nullable(); 
            $table->string('Remark2')->nullable(); 
            $table->string('Remark3')->nullable(); 
            $table->string('Remark4')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_details');
    }
};
