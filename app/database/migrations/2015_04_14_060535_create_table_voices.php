<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVoices extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('voices', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('pemilu_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->integer('wilayah_id')->unsigned();
            $table->integer('value')->unsigned();
            $table->nullableTimestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('voices');
	}

}
