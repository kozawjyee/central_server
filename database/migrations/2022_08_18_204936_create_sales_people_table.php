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
        Schema::create('sales_people', function (Blueprint $table) {
            $table->id();
            $table->string('SalesPersonID')->nullable(); 
            $table->string('SalesPersonName')->nullable(); 
            $table->string('SalesPersonLocationID')->nullable(); 
            $table->string('MainLocationID')->nullable(); 
            $table->string('UnloadLocationID')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales_people');
    }
};
