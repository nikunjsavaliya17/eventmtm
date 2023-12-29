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
        Schema::create('sponsor_types', function (Blueprint $table) {
            $table->increments('sponsor_type_id');
            $table->string('title')->nullable();
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
        Schema::dropIfExists('sponsor_types');
    }
};
