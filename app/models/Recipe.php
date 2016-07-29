<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Recipe extends Eloquent {
    
    protected $table = 'recipe';
    
    public function customer() {
        return $this->hasMany('Customer');
    }
    
    public function customerRecipes() {
        return $this->hasMany('CustomerRecipe');
    }
    
    public function userRecipes() {
        return $this->hasMany('UserRecipe');
    }
    
    public function userPostActivities() {
        return $this->hasMany('UserActivity');
    }
    
}