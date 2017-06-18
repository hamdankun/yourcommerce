<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 100)->nullable()->index();
            $table->dateTime('joined_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->string('status', 100)->nullable()->default('active')->index();
            $table->string('image_path')->nullable()->default(env('APP_URL').'/uploads/member/no-profile.png');
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
        Schema::dropIfExists('members');
    }
}
