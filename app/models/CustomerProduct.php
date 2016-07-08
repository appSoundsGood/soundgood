<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class CustomerProduct extends Eloquent {
    
    protected $table = 'customer_product';
    
    public function customer() {
        return $this->belongsTo('Customer');
    }
    public function product() {
        return $this->belongsTo('Product');
    }
}