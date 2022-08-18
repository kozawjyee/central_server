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
            $table->string('ItemID');
            $table->string('AlternateItemID');
            $table->string('Name');
            $table->string('Name2');
            $table->string('PackingTypeID');
            $table->string('PackingTypeName');
            $table->string('BasedUomID');
            $table->string('SalesUomID');
            $table->string('ItemGroupID');
            $table->string('ItemGroupName');
            $table->string('ItemTypeID');
            $table->string('ItemTypeName');
            $table->boolean('Status');
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
        Schema::dropIfExists('items');
    }
};
