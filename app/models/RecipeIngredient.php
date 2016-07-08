<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class RecipeIngredient extends Eloquent {
    
    protected $table = 'recipe_ingredient';
    
    public function recipe() {
        return $this->belongsTo('Recipe');
    }
    
    public function ingredient() {
        return $this->belongsTo('Ingredient');
    }
    
    
}