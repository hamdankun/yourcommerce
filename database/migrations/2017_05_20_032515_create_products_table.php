<?php

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
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->string('sku')->nullable()->index();
            $table->string('name', 100)->nullable()->index();
            $table->boolean('is_display')->nullable()->default(true);
            $table->decimal('price', 12, 0)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('stock')->nullable();
            $table->string('slug', 150)->nullable();
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
