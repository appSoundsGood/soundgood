<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewConsumer extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer', function($t) {
			
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->string('name', 64);
			$t->string('email', 64);
			$t->string('password', 64);
			$t->integer('gender');
			$t->string('birthday', 32);
			$t->integer('year');
			$t->integer('category_id')->unsigned();
			$t->integer('location_id')->unsigned();
			$t->string('profile_image', 256);
			$t->string('cover_image', 256);
			
			$t->string('phone', 32);
			$t->string('address', 256);
			$t->string('website', 512);
			$t->string('facebook', 512);
			$t->string('linkedin', 512);
			$t->string('twitter', 512);
			$t->string('google', 512);
			
			$t->boolean('is_active');
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
		Schema::drop('customer');
	}

}
