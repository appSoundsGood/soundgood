<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIngredient extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('ingredient', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->string('name', 255);
            $t->integer('category_id')->unsigned(); 
            $t->timestamps();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{   
        Schema::drop('ingredient'); 
	}

}
