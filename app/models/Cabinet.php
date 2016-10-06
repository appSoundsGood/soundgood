<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Cabinet extends Eloquent {
    
    protected $table = 'cabinet';
    
    public function customer() {
        return $this->belongsTo('Customer');
    }
    public function product() {
        return $this->belongsTo('Product');
    }
}