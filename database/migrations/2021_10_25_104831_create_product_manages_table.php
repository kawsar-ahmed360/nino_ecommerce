<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_manages', function (Blueprint $table) {
            $table->id();
            $table->string('product_name')->nullable();
            $table->json('section_id')->nullable();
            $table->string('cat_id')->nullable();
            $table->json('color_id')->nullable();
            $table->json('tag_id')->nullable();
            $table->string('plation_id')->nullable();
            $table->string('carat')->nullable();
            $table->string('product_price')->nullable();
            $table->string('discount')->nullable();
            $table->text('summary')->nullable();
            $table->string('new_price')->nullable();
            $table->string('product_qty')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('product_sku')->nullable();
            $table->string('slug')->nullable();
            $table->string('status')->nullable();
            $table->string('image')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_des')->nullable();
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
        Schema::dropIfExists('product_manages');
    }
}
