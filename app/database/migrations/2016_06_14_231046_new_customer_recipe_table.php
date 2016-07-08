<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewCustomerRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('customer_recipe', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            
            $t->integer('customer_id')->unsigned();
            $t->integer('recipe_id')->unsigned();
            
            $t->timestamps();
            
            $t->foreign('customer_id')->references('id')->on('customer');
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
	    $t->dropForeign('customer_recipe_customer_id_foreign');
        $t->dropForeign('customer_recipe_recipe_id_foreign');

        Schema::drop('customer_product');
	}

}
