<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditRecipeTableSecond extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('recipe', function ($t) {
            $t->string('prepTime', 4);
            $t->string('servings', 4);
            $t->string('nutriInfo', 512);
            $t->string('quickBios', 512);
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
