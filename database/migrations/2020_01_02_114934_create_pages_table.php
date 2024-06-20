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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order')->default(0);
            $table->string('title', 512);
            $table->string('alias', 512)->nullable();
            $table->longText('introtext')->nullable();
            $table->longText('fulltext')->nullable();
            $table->string('metakey', 512)->nullable();
            $table->string('metadesc', 512)->nullable();
            $table->boolean('featured')->default(false);
            $table->unsignedBigInteger('hits')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
