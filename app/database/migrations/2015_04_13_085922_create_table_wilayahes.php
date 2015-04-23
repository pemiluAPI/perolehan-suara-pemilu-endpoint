<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableWilayahes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('wilayahes', function(Blueprint $table) {
        
            $table->increments('id');
            $table->string('name', 100);
            $table->text('full_name');
            $table->integer('province_id')->unsigned();
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
		Schema::drop('wilayahes');
	}

}
