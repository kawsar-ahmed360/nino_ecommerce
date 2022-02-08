<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionManagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_manages', function (Blueprint $table) {
            $table->id();
            $table->string('section_name')->nullable();
            $table->string('first_add_image')->nullable();
            $table->string('first_add_url')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('second_add_image')->nullable();
            $table->string('second_add_url')->nullable();
            $table->string('slug')->nullable();
            $table->string('highlight')->nullable();
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
        Schema::dropIfExists('section_manages');
    }
}
