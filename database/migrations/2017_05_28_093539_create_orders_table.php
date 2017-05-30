<?php

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
            $table->increments('id');
            $table->integer('member_id')->nullable()->default(0);
            $table->string('member_type')->nullable();
            $table->string('order_number')->nullable()->default(0)->index();
            $table->integer('delivery_method_id')->nullable()->default(0);
            $table->integer('address_id')->nullable()->default(0);
            $table->integer('payment_method_id')->nullable()->default(0);
            $table->string('invoice', 100)->nullable()->index();
            $table->string('date')->nullable();
            $table->decimal('total', 12, 0)->nullable();
            $table->decimal('tax', 12, 0)->nullable();
            $table->decimal('shipping_cost', 12, 0)->nullable();
            $table->decimal('discount_total', 12, 0)->nullable();
            $table->decimal('grand_total', 12, 0)->nullable();
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
