<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUserRecipe extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	 public function up()
    {
       Schema::create('user_recipe', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->integer('user_id')->unsigned();
            $t->integer('recipe_id')->unsigned();
            $t->timestamps();
            
            $t->foreign('user_id')->references('id')->on('user');
            $t->foreign('recipe_id')->references('id')->on('recipe');
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
        Schema::drop('user_recipe');
    }
}
