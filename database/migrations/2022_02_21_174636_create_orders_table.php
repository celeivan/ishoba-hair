<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('order_reference');
            $table->double('total')->default(0);
            $table->longText('shippingAddress')->nullable(); //if customer will collect
            $table->longText('shippingNote')->nullable();
            $table->string('discountCode')->nullable();
            $table->string('distributorCode')->nullable();
            $table->enum('status', ['awaiting payment', 'payment received', 'shipped', 'delivered', 'cancelled'])->default('awaiting payment');
            $table->longText('statusDescription')->nullable(); //Store cancellation reason
            $table->longText('log')->nullable();
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
        Schema::dropIfExists('orders');
    }
}
