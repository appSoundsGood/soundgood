<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewReciptIngredientTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		
       Schema::create('recipt_product', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->integer('recipt_id')->unsigned();
            $t->integer('product_id')->unsigned();  
            $t->float('quantity',8)->unsigned(); 
            $t->timestamps();
            $t->foreign('recipt_id')->references('id')->on('Recipt');
            $t->foreign('product_id')->references('id')->on('Product'); 
        });      
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$t->dropForeign('recipt_product_recipt_id_foreign');
        $t->dropForeign('recipt_product_product_id_foreign'); 
        Schema::drop('recipe_ingredient');
	}

}
