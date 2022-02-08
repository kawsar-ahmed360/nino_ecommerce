<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurshesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purshes', function (Blueprint $table) {
            $table->id();
            $table->string('date')->nullable();
            $table->string('purshes_no')->nullable();
            $table->string('supliar_id')->nullable();
            $table->string('cat_id')->nullable();
            $table->string('product_id')->nullable();
            $table->double('bying_qty')->nullable();
            $table->string('bying_price')->nullable();
            $table->text('des')->nullable();
            $table->double('subtotal')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('purshes');
    }
}
