<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUbexchangeDatabase extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		/**
	     * Table: users
	     */
		Schema::create('users', function($table) {
                $table->increments('id');
                $table->string('remember_token', 256)->nullable();
                $table->string('name', 128);
                $table->string('email', 128);
                $table->string('password', 128);
                $table->string('photo', 128);
                $table->string('activation_key', 128);
                $table->string('remind', 128);
                $table->enum('activation_state', array('on','off', 'deactivate'));
                $table->dateTime('last_login')->nullable();
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });

		/**
	     * Table: questions
	     */
		Schema::create('questions', function($table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->string('title', 256);
                $table->text('description');
                $table->enum('solved', array('0','1'));
                $table->integer('votes');
                $table->string('slug', 256);
                $table->dateTime('created_at');
                $table->dateTime('updated_at');
            });

		/**
	     * Table: answers
	     */
		Schema::create('answers', function($table) {
                $table->increments('id');
                $table->integer('user_id');
                $table->integer('question_id');
                $table->text('description');
                $table->integer('votes');
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
		Schema::drop('questions');
		Schema::drop('answers');
	}

}
