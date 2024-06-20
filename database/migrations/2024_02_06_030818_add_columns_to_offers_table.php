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
        Schema::table('offers', function (Blueprint $table) {
            $table->string('kaspi_link', 511)->nullable();
            $table->boolean('kaspi')->default(false);
            $table->string('article')->nullable();
            $table->string('gtin')->nullable();
            $table->string('halyk')->nullable();
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
        Schema::table('offers', function (Blueprint $table) {
            $table->dropColumn('kaspi_link');
            $table->dropColumn('kaspi');
            $table->dropColumn('article');
            $table->dropColumn('gtin');
            $table->dropColumn('halyk');
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
            $table->dropColumn('body');
            $table->dropColumn('metatitle');
            $table->dropColumn('metadesc');
            $table->dropColumn('metakey');
        });
    }
};
