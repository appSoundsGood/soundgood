<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user', function ($t) {
			
            $t->string('firstName', 255);
            $t->string('lastName', 255);
            $t->string('phoneNumber', 16);
            $t->string('zipCode', 8);
            $t->string('token', 32);
		});
	}
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		
		
	}

}
