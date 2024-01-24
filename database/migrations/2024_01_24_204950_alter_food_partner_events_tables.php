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
        Schema::table('food_partner_events', function (Blueprint $table) {
            $table->dropColumn('title');
            $table->integer('event_id')->default(0)->after('food_partner_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_partner_events', function (Blueprint $table) {
            //
        });
    }
};
