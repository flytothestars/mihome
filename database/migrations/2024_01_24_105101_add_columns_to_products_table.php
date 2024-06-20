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
        Schema::table('products', function (Blueprint $table) {
            $table->longText('body')->nullable();
            $table->string('metatitle')->nullable();
            $table->text('metadesc')->nullable();
            $table->text('metakey')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('body');
            $table->dropColumn('metatitle');
            $table->dropColumn('metadesc');
            $table->dropColumn('metakey');
        });
    }
};
