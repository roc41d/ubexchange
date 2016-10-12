<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('remember_token', 256)->nullable();
			$table->string('name', 128);
			$table->string('email', 128);
			$table->string('password', 128);
			$table->string('faculty', 128);
			$table->text('about', 65535);
			$table->string('website', 128);
			$table->string('git', 128);
			$table->text('twitter', 65535);
			$table->bigInteger('reputation')->default(1);
			$table->text('real_name', 65535);
			$table->string('photo', 128);
			$table->string('photo_thumbnail', 128);
			$table->string('activation_key', 128);
			$table->string('remind', 128);
			$table->enum('activation_state', array('on','off','deactivate'));
			$table->string('slug', 128);
			$table->dateTime('last_login')->nullable();
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
		Schema::drop('users');
	}

}
