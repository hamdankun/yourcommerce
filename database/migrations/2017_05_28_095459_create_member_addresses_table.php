<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMemberAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('member_addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('member_id')->nullable()->default(0);
            $table->string('member_type')->nullable();
            $table->string('city', 100)->nullable();
            $table->string('country_id', 100)->nullable();
            $table->string('zip',100)->nullable();
            $table->text('address')->nullable();
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
        Schema::dropIfExists('member_addresses');
    }
}
