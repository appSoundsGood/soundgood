<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomerStore extends Eloquent {
    
    protected $table = 'customer_store';
    
    public function customer() {
        return $this->belongsTo('Customer');
    }
    
    public function store() {
        return $this->belongsTo('Store');
    }
    
    
}