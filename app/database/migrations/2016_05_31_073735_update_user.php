<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUser extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user', function ($t) {
            $t->string('companyName', 255);
            $t->string('state', 16);
            $t->string('city', 16);
            $t->string('stock', 255);
            $t->string('coupon', 16);
            $t->string('price', 16);
            $t->string('is_pushSet', 16);
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		//
	}

}
