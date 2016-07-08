<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserStore extends Eloquent {
    
    protected $table = 'user_store';
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function store() {
        return $this->belongsTo('Store');
    }
    
    
}