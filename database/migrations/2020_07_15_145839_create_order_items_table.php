<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->integer('quantity')
                ->default(1);

            // create order_id
            $table->bigInteger('order_id')
                ->unsigned()
                ->nullable();
            // make order_id column a foreign key
            $table->foreign('order_id')
                ->references('id')
                ->on('orders')
                ->onDelete('cascade');

            // create offer_id
            $table->bigInteger('offer_id')
                ->unsigned()
                ->nullable();
            // make offer_id column a foreign key
            $table->foreign('offer_id')
                ->references('id')
                ->on('offers')
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
        Schema::dropIfExists('order_items');
    }
}
