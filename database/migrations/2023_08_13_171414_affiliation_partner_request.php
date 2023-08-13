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
        Schema::create('affiliation_partner_request', function (Blueprint $table) {
            $table->id();
            $table->string('busness_type')->nullable();
            $table->string('company_address')->nullable();
            $table->binary('company_logo')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_owner_name')->nullable();
            $table->string('company_tin')->nullable();
            $table->string('contact_full_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('contact_role')->nullable();
            $table->string('email_address')->nullable();
            $table->string('discount_privilege')->nullable();
            $table->string('link')->nullable();
            $table->binary('sign_img')->nullable();
            $table->string('signing_authority')->nullable();
            $table->binary('back_nid')->nullable();
            $table->binary('front_nid')->nullable();
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
