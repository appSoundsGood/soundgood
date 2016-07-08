<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewProductCustomerTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
	    Schema::create('customer_product', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            
            $t->integer('customer_id')->unsigned();
            $t->integer('product_id')->unsigned();
            $t->float('quantity')->unsigned();
            
            $t->timestamps();
            
            $t->foreign('customer_id')->references('id')->on('customer');
            $t->foreign('product_id')->references('id')->on('product');
        });   
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		$t->dropForeign('customer_product_customer_id_foreign');
        $t->dropForeign('customer_product_product_id_foreign');

        Schema::drop('customer_product');
	}

}
