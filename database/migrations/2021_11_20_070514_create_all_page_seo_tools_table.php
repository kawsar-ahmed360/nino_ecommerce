<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAllPageSeoToolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('all_page_seo_tools', function (Blueprint $table) {
            $table->id();
            $table->string('home_meta_title')->nullable();
            $table->text('home_meta_des')->nullable();
            $table->string('home_header_code')->nullable();

            $table->string('shop_meta_title')->nullable();
            $table->text('shop_meta_des')->nullable();
            $table->string('shop_header_code')->nullable();

            $table->string('contact_meta_title')->nullable();
            $table->text('contact_meta_des')->nullable();
            $table->string('contact_header_code')->nullable();
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
        Schema::dropIfExists('all_page_seo_tools');
    }
}
