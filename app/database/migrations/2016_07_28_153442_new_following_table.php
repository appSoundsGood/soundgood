<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewFollowingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('following', function($t) {
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->integer('followerUserId')->unsigned();
            $t->integer('followerCustomerId')->unsigned(); 
			$t->integer('follwingId')->unsigned();
			$t->string('follwertype', 64);
			
			$t->timestamps();
			
			$t->foreign('followerUserId')->references('id')->on('user');
            $t->foreign('followerCustomerId')->references('id')->on('customer'); 
			$t->foreign('follwingId')->references('id')->on('user');
			
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$t->dropForeign('following_followerUserId_foreign');
        $t->dropForeign('following_followerCustomerId_foreign'); 
		$t->dropForeign('following_follwingId_foreign');
       
        Schema::drop('following');
	}

}
