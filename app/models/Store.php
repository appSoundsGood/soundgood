<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Store extends Eloquent {
    
    protected $table = 'store';
    
    public function customerStores() {
        return $this->hasMany('CustomerStore');
    }
    public function userStores() {
        return $this->hasMany('UserStore');
    }
    public function storeProducts() {
        return $this->hasMany('Product');
    }
    
}