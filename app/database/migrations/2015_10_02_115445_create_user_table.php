<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function($table) {
                $table->increments('id');
                $table->string('remember_token', 256)->nullable();
                $table->string('name', 128);
                $table->string('email', 128);
                $table->string('password', 128);
                $table->string('profile_photo', 128);
                $table->string('activation_key', 128);
                $table->string('remind', 128);
                $table->enum('activation_state', array('on','off', 'deactivate'));
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
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
