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
        Schema::create('product_categories', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('parent_id')->nullable();
            $table->foreign('parent_id')->references('id')->on('product_categories')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->string('name')->nullable(); // Elektronik Rumah
            $table->string('slug')->unique()->nullable(); // elektronik-rumah
            $table->string('tagline')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_categories');
    }
};
