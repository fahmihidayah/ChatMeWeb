<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MessageAndGroupTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		// Schema::create('messages', function($table){
		// 	$table->increments('id');
		// 	$table->string('data_message');
		// 	$table->string('type');
		// 	$table->integer('user_id_sender');
		// 	$table->integer('user_id_receiver');
		// 	$table->integer('group_id');
		// 	$table->timestamps();
		// });

		Schema::create('users', function($table){
			$table->increments('id');
			$table->string('name');
			$table->string('email');
			$table->string('password');
			$table->string('remember_token');
			$table->timestamps();
		});

		// Schema::create('groups', function($table){
		// 	$table->increments('id');
		// 	$table->string('group_name');
		// 	$table->timestamps();
		// });

		// Schema::create('group_user', function($table){
		// 	$table->increments('id');
		// 	$table->string('group_id');
		// 	$table->string('user_id');
		// 	$table->timestamps();
		// });

	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		// Schema::drop('messages');
		Schema::drop('users');
		// Schema::drop('groups');
		// Schema::drop('group_user');
	}

}
