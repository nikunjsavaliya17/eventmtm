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
        Schema::create('sponsors', function (Blueprint $table) {
            $table->increments('sponsor_id');
            $table->integer('sponsor_type_id')->default(0)->index();
            $table->integer('event_id')->default(0)->index();
            $table->string('company_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('logo')->nullable();
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
        Schema::dropIfExists('sponsors');
    }
};
