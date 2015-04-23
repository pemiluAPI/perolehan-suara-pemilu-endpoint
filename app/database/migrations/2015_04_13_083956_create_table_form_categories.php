<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableFormCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('formulir_categories', function(Blueprint $table) {

            $table->increments('id');
            $table->string('name', 100);
            $table->text('description');
            $table->integer('formulir_id')->unsigned();
            $table->integer('parent_id')->unsigned();
            $table->integer('master_id')->unsigned();
            $table->integer('has_value')->unsigned();
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
		Schema::drop('formulir_categories');
	}

}
