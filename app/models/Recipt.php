<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Recipt extends Eloquent {
    
    protected $table = 'recipt';
    
    public function customer() {
        return $this->belongsTo('Customer');
    }
    
}