<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCollagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('state');
            $table->string('thumbnail')->nullable();
            $table->timestamps();
            $table->integer('user_id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('collages');
    }
}
