<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Product extends Eloquent {
    
    protected $table = 'product';
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function store() {
        return $this->belongsTo('Store');
    }
    
    public function category() {
        return $this->belongsTo('Category');
    }
    
    public function customerProducts() {
        return $this->hasMany('CustomerProduct');
    }
}