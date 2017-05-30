<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryMethodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_methods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code', 100);
            $table->string('name', 100)->nullable();
            $table->text('description')->nullable();
            $table->decimal('fee', 12, 0)->nullable()->default(0);
            $table->integer('estimated_time')->nullable()->default(0);
            $table->string('image')->nullable();
            $table->boolean('main')->nullable()->default(false);
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
        Schema::dropIfExists('delivery_methods');
    }
}
