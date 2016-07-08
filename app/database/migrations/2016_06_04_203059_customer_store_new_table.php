<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerStoreNewTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customer_store', function($t) {
			$t->engine ='InnoDB';
			$t->increments('id')->unsigned();
			$t->integer('customer_id')->unsigned();
			$t->integer('store_id')->unsigned();
			
            $t->string('name', 64);
            $t->string('receipt', 32);
			$t->timestamps();
			
			$t->foreign('customer_id')->references('id')->on('customer');
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
		$t->dropForeign('customer_store_customer_id_foreign');
        $t->dropForeign('customer_store_store_id_foreign');
        Schema::drop('customer_store');
	}
}
