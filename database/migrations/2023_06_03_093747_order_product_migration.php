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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('affiliation_partner_id')->nullable();
            $table->string('paying_merchant')->nullable();
            $table->string('paying_pkaard')->nullable();
            $table->string('discount_tk')->nullable();
            $table->date('date')->nullable();
            $table->string('status')->default('1');
            $table->string('validity')->default('1');

         
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
