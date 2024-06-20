<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->string('token');

            $table->enum('state', config('voyager-shop.order_states'))->default('cart');

            // create user_id
            $table->bigInteger('user_id')
                ->unsigned()
                ->nullable();
            // make user_id column a foreign key
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            // billing address
            $table->bigInteger('billing_address_id')
                ->unsigned()
                ->nullable();
            $table->foreign('billing_address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('cascade');

            // shipping address
            $table->bigInteger('shipping_address_id')
                ->unsigned()
                ->nullable();
            $table->foreign('shipping_address_id')
                ->references('id')
                ->on('addresses')
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
        Schema::dropIfExists('orders');
    }
}
