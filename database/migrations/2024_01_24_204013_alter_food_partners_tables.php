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
        Schema::table('food_partners', function (Blueprint $table) {
            $table->string('description')->nullable()->after('logo');
            $table->text('address')->nullable()->after('description');
            $table->double('ratings')->default(0)->after('bsb_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_partners', function (Blueprint $table) {
            $table->dropColumn('description');
            $table->dropColumn('ratings');
        });
    }
};
