<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRecipeTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	    public function up()
    {
        Schema::table('recipe', function ($t) {
            $t->text('content');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('recipe');  
    }
}
