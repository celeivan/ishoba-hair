<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
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
            $table->string('firstNames');
            $table->string('lastName');
            $table->string('emailAddress');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('contactNo');
            $table->timestamp('contact_no_verified_at')->nullable();
            $table->string('distributorCode')->nullable(); //Set this if the client signs up as distributor
            $table->timestamp('distributor_since')->nullable();
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
}
