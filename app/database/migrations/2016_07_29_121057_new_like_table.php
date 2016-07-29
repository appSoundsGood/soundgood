<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewLikeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('like', function($t) {
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->integer('likeUserId')->unsigned();
            $t->integer('likeCustomerId')->unsigned(); 
			$t->integer('ownerUserId')->unsigned(); 
			
			$t->integer('recipeId')->unsigned();
			$t->string('usertype', 64);
			
			$t->timestamps();
			
			$t->foreign('likeUserId')->references('id')->on('user');
            $t->foreign('likeCustomerId')->references('id')->on('customer'); 
            $t->foreign('ownerUserId')->references('id')->on('user'); 
			$t->foreign('recipeId')->references('id')->on('recipe');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$t->dropForeign('like_likeUserId_foreign');
        $t->dropForeign('like_likeCustomerId_foreign'); 
        $t->dropForeign('like_ownerUserId_foreign'); 
		$t->dropForeign('like_recipeId_foreign');
       
        Schema::drop('like');
	}

}
