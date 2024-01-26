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
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('order_id');
            $table->integer('app_user_id')->default(0)->index();
            $table->integer('event_id')->default(0)->index();
            $table->string('order_no')->nullable()->index();
            $table->double('amount')->default(0)->index();
            $table->text('notes')->nullable();
            $table->text('payment_details')->nullable();
            $table->string('qr_image')->nullable();
            $table->integer('status')->default(0)->index();
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
};
