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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('CustomerId');
            $table->string('Name');
            $table->string('OtherName');
            $table->string('Address');
            $table->string('Address2');
            $table->string('Address3');
            $table->string('Address4');
            $table->string('City');
            $table->string('PostalCode');
            $table->string('RegionID');
            $table->string('RegionName');
            $table->string('CountryCode');
            $table->string('Phone');
            $table->string('Email');
            $table->string('Website');
            $table->string('CategoryID');
            $table->string('CategoryName');
            $table->string('GroupID');
            $table->string('GroupName'); 
            $table->string('CreditTermID'); 
            $table->string('CreditTermName'); 
            $table->integer('CreditTermInDays'); 
            $table->integer('CreditLimit'); 
            $table->string('PriceGroupID'); 
            $table->string('PriceGroupName'); 
            $table->string('SalesPersonID'); 
            $table->string('SalesPersonName');
            $table->integer('Status');  
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
        Schema::dropIfExists('customers');
    }
};
