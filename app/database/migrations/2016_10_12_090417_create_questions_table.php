<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('questions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('user_edit_id');
			$table->string('title', 256);
			$table->text('description', 65535);
			$table->enum('status', array('solved'))->nullable();
			$table->bigInteger('votes');
			$table->string('slug', 256);
			$table->dateTime('edit_time');
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
		Schema::drop('questions');
	}

}
