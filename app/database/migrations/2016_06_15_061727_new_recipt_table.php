<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewReciptTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('recipt', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            
            $t->integer('customer_id')->unsigned();
            $t->string('code',32);
            
            $t->timestamps();
            
            $t->foreign('customer_id')->references('id')->on('customer');
            
        }); 
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
	    $t->dropForeign('recipt_customer_id_foreign');
        Schema::drop('recipt');
	}

}
