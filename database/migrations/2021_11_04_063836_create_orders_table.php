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
            $table->integer('orderId')->nullable();
            $table->integer('shipping_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('payment_id')->nullable();
            $table->integer('total_ammount')->nullable();
            $table->integer('discount')->nullable();
            $table->integer('status')->nullable();
            $table->string('shipment_name')->nullable();
            $table->integer('shipment_amount')->nullable();
            $table->integer('billing_id')->nullable();
            $table->integer('shipping_status')->nullable();
            $table->integer('order_complete')->nullable();
            $table->string('coupon')->nullable();
            $table->integer('return_status')->nullable();
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
