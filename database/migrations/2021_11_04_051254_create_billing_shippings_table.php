<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingShippingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_shippings', function (Blueprint $table) {
            $table->id();
            $table->string('billing_fname')->nullable();
            $table->string('user_id')->nullable();
            $table->string('billing_lname')->nullable();
            $table->string('billing_mobile')->nullable();
            $table->string('billing_email')->nullable();
            $table->string('billing_country_name')->nullable();
            $table->string('billing_city_name')->nullable();
            $table->string('billing_zip_code')->nullable();
            $table->string('billing_state_name')->nullable();
            $table->string('billing_address')->nullable();
            $table->string('other_shipment')->nullable();
            $table->string('shipping_fname')->nullable();
            $table->string('shipping_lname')->nullable();
            $table->string('shipping_mobile')->nullable();
            $table->string('shipping_email')->nullable();
            $table->string('shipping_country_name')->nullable();
            $table->string('shipping_city_name')->nullable();
            $table->string('shipping_zip_code')->nullable();
            $table->string('shipping_state_name')->nullable();
            $table->string('shipping_address')->nullable();
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
        Schema::dropIfExists('billing_shippings');
    }
}
