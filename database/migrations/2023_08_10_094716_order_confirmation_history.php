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
        Schema::create('order_Confirmation_history', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('customer_registation_no')->nullable();
            $table->string('affiliation_partner_id')->nullable();
            $table->string('payment')->nullable();
            $table->date('date')->nullable();

         
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
