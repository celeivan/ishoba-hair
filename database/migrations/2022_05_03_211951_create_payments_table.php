<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('order_id');
            $table->bigInteger('user_id')->nullable(); //This cannot be null if payment method is manual
            $table->double('amount_paid')->default(0);
            $table->string('reference'); //Default to order reference if payment was online
            $table->string('paymentMethod')->default('online'); //Can also be manual
            $table->string('proofOfPaymentPath')->nullable(); //Store file on upload
            $table->boolean('approved')->default(false);
            $table->bigInteger('approved_by')->nullable(); //Capture the user/admin who approved it
            $table->softDeletes();
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
        Schema::dropIfExists('payments');
    }
}
