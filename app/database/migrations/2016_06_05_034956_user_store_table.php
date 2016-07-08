<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserStoreTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	   Schema::create('user_store', function($t) {
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->integer('user_id')->unsigned();
			$t->integer('store_id')->unsigned();
			$t->string('name', 64);
            $t->timestamps();
			
			$t->foreign('user_id')->references('id')->on('user');
            $t->foreign('store_id')->references('id')->on('store');
		});	  
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$t->dropForeign('user_store_user_id_foreign');
        $t->dropForeign('user_store_store_id_foreign');
        Schema::drop('user_store');
	}

}
