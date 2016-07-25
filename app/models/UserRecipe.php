<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserRecipe extends Eloquent {
    
    protected $table = 'user_recipe';
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function recipe() {
        return $this->belongsTo('Recipe');
    }
    
    
}