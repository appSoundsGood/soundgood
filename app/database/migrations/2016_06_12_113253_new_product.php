<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewProduct extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
public function up()
    {
        Schema::create('product', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->string('name', 64);
            $t->string('productImg', 128);  

            $t->string('upcCode', 32);
            $t->string('brand', 32);
            $t->string('itemName', 32);
            $t->string('size', 32);   
            $t->integer('user_id')->unsigned();
            $t->integer('store_id')->unsigned();
            
            $t->timestamps();
            
            $t->foreign('user_id')->references('id')->on('user');
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
        $t->dropForeign('product_user_id_foreign');
        $t->dropForeign('product_store_id_foreign');
        
        Schema::drop('product');
    }

}
