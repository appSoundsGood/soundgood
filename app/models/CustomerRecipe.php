<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomerRecipe extends Eloquent {
    
    protected $table = 'customer_recipe';
    
    public function customer() {
        return $this->belongsTo('Customer');
    }
    
    public function recipe() {
        return $this->belongsTo('Recipe');
    }
    
    
}