<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class NewUserPostTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
       Schema::create('user_post', function($t) {
            $t->engine ='InnoDB';
            $t->increments('id')->unsigned();
            $t->integer('user_id')->unsigned();
            $t->integer('post_id')->unsigned();
            $t->timestamps();
            
            $t->foreign('user_id')->references('id')->on('user');
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
        $t->dropForeign('user_post_user_id_foreign');
        $t->dropForeign('user_post_post_id_foreign');
        Schema::drop('user_post');
    }

}
