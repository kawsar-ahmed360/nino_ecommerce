<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_manages', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('category_name')->nullable();
            $table->string('slug')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('highlight')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('category_manages');
    }
}
