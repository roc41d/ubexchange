<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAnswersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('answers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id');
			$table->integer('user_edit_id');
			$table->integer('question_id');
			$table->text('description', 65535);
			$table->bigInteger('votes');
			$table->enum('status', array('accepted'))->nullable();
			$table->string('question_title', 256);
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
		Schema::drop('answers');
	}

}
