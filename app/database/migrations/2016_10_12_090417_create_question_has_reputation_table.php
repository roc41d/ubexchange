<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQuestionHasReputationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('question_has_reputation', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->integer('question_id');
			$table->string('points', 11)->nullable();
			$table->string('action', 25);
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
		Schema::drop('question_has_reputation');
	}

}
