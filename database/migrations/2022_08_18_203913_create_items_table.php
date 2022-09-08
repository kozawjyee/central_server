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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('ItemID')->nullable();
            $table->string('AlternateItemID')->nullable();
            $table->string('Name')->nullable();
            $table->string('Name2')->nullable();
            $table->string('PackingTypeID')->nullable();
            $table->string('PackingTypeName')->nullable();
            $table->string('BasedUomID')->nullable();
            $table->string('SalesUomID')->nullable();
            $table->string('ItemGroupID')->nullable();
            $table->string('ItemGroupName')->nullable();
            $table->string('ItemTypeID')->nullable();
            $table->string('ItemTypeName')->nullable();
            $table->boolean('Status')->nullable();
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
        Schema::dropIfExists('items');
    }
};
