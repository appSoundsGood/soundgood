<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmin extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admin', function($t) {
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->string('username', 255);
			$t->string('password', 64);
			$t->string('address', 255);
			$t->string('video', 255);
			$t->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admin');
	}

}
