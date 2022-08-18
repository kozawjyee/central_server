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
            $table->string('ItemID'); 
            $table->string('UomID'); 
            $table->string('UomName'); 
            $table->integer('UomRate'); 
            $table->integer('DefaultUnitPrice'); 
            $table->string('BarcodeNo'); 
            $table->string('Remark'); 
            $table->string('Remark2'); 
            $table->string('Remark3'); 
            $table->string('Remark4'); 
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
        Schema::dropIfExists('item_details');
    }
};
