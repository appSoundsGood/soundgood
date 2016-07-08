<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Ingredient extends Eloquent {
    
    protected $table = 'ingredient';
    
    public function ingredients() {
        return $this->hasMany('RecipeIngredient');
    }
    public function category() {
        return $this->hasMany('Category');
    }
}