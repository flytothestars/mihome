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
            $table->string('kaspi', 511)->nullable();
            $table->string('article')->nullable();
            $table->string('gtin')->nullable();
            $table->string('mpn')->nullable();
            $table->unsignedBigInteger('weight')->nullable(); //decimal
            $table->unsignedBigInteger('length')->nullable(); //decimal
            $table->unsignedBigInteger('width')->nullable(); //decimal
            $table->unsignedBigInteger('height')->nullable(); //decimal
            $table->unsignedBigInteger('packaging')->nullable(); //decimal
            $table->boolean('in_stock')->default(false);
            $table->boolean('ordered')->default(false);
            $table->dateTime('available_date')->nullable();
            $table->boolean('special')->default(false);
            $table->boolean('discontinued')->default(false);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('hits')->default(0);
            $table->boolean('published')->default(false);
            $table->unsignedBigInteger('pordering')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('kaspi');
            $table->dropColumn('article');
            $table->dropColumn('gtin');
            $table->dropColumn('mpn');
            $table->dropColumn('weight');
            $table->dropColumn('length');
            $table->dropColumn('width');
            $table->dropColumn('height');
            $table->dropColumn('packaging');
            $table->dropColumn('in_stock');
            $table->dropColumn('ordered');
            $table->dropColumn('available_date');
            $table->dropColumn('special');
            $table->dropColumn('discontinued');
            $table->dropColumn('category_id');
            $table->dropColumn('hits');
            $table->dropColumn('published');
            $table->dropColumn('pordering');
        });
    }
};
