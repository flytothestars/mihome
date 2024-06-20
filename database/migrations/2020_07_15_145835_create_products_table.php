<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->string('name');
            $table->string('slug');
            $table->text('description');

            $table->boolean('includes_tax')->default(1);

            // create tax_id
            $table->bigInteger('tax_id')
                ->unsigned()
                ->nullable();
            // make tax_id column a foreign key
            $table->foreign('tax_id')
                ->references('id')
                ->on('taxes')
                ->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
