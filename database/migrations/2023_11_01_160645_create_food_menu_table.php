<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('food_menu', function (Blueprint $table) {
            $table->increments('food_menu_id');
            $table->integer('food_type_id')->default()->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('sku')->default(0)->index();
            $table->longText('ingredients')->nullable();
            $table->longText('other_details')->nullable();
            $table->string('image')->nullable();
            $table->integer('display_order')->default(0)->index();
            $table->boolean('is_active')->default(0)->index();
            $table->integer('created_by')->default(0)->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food_menu');
    }
};
