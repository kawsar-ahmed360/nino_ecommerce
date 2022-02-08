<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('menu_name');
            $table->string('slug');
            $table->string('page_type')->nullable();
            $table->string('external_link')->nullable();
            $table->string('important_link')->nullable();
            $table->string('target')->nullable();
            $table->string('root_id')->nullable();
            $table->string('sroot_id')->nullable();
            $table->string('troot_id')->nullable();
            $table->string('sequence');
            $table->string('display')->nullable();
            $table->string('user_id')->nullable();
            $table->string('footer1')->nullable();
            $table->string('footer2')->nullable();
            $table->string('my_account')->nullable();
            $table->string('customer_service')->nullable();
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
        Schema::dropIfExists('menus');
    }
}
