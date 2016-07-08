<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class ReciptProduct extends Eloquent {
    
    protected $table = 'recipt_product';
    
    public function recipt() {
        return $this->belongsTo('Recipt');
    }
    
    public function product() {
        return $this->belongsTo('Product');
    }
    
    
}