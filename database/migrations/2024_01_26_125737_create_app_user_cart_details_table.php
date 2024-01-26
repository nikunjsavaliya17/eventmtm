<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_cart_details', function (Blueprint $table) {
            $table->increments('app_user_cart_detail_id');
            $table->integer('app_user_id')->default(0)->index();
            $table->integer('event_id')->default(0)->index();
            $table->integer('food_partner_id')->default(0)->index();
            $table->integer('food_menu_id')->default(0)->index();
            $table->integer('quantity')->default(0)->index();
            $table->double('amount')->default(0)->index();
            $table->double('total_amount')->default(0)->index();
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
        Schema::dropIfExists('app_user_cart_details');
    }
};
