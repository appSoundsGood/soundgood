<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Customer extends Eloquent {
    
    protected $table = 'customer';
    
    public function customerStores() {
        return $this->hasMany('CustomerStore');
    }
    public function customerRecipes() {
        return $this->hasMany('CustomerRecipe');
    }
    
    public function stores() {
        return $this->hasManyThrough('Store', 'CustomerStore');
    }
    public function customerProducts() {
        return $this->hasMany('CustomerProduct');
    }
    
    
}