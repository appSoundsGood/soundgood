<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipeIngredientTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       Schema::create('recipe_ingredient', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->integer('recipe_id')->unsigned();
            $t->integer('ingredient_id')->unsigned();
            $t->float('quantity', 8);
            $t->timestamps();
            $t->foreign('recipe_id')->references('id')->on('recipe');
            $t->foreign('ingredient_id')->references('id')->on('ingredient');
        });      
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $t->dropForeign('recipe_ingredient_recipe_id_foreign');
        $t->dropForeign('recipe_ingredient_ingredient_id_foreign');
        Schema::drop('recipe_ingredient');
    }
}



