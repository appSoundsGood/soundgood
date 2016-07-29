<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserActivity extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
    {
       Schema::create('user_activity', function($t) {
            
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->string('type', 8);
            
            $t->integer('user_id')->unsigned();
            $t->integer('recipe_id')->unsigned();
            $t->integer('post_id')->unsigned();
            
            $t->timestamps();
            
            $t->foreign('user_id')->references('id')->on('user');
            $t->foreign('recipe_id')->references('id')->on('recipe');
            $t->foreign('post_id')->references('id')->on('post');
        });      
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $t->dropForeign('user_recipe_user_id_foreign');
        $t->dropForeign('user_recipe_recipe_id_foreign');
        $t->dropForeign('user_recipe_post_id_foreign');
        Schema::drop('user_recipe');
    }

}
