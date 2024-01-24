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
        Schema::table('food_menu', function (Blueprint $table) {
            $table->integer('food_partner_id')->default(0)->after('food_menu_id');
            $table->double('amount')->default(0)->after('description');
            $table->double('ratings')->default(0)->after('image');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_menu', function (Blueprint $table) {
            $table->dropColumn('food_partner_id');
            $table->dropColumn('ratings');
        });
    }
};
