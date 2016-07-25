<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserPost extends Eloquent {
    
    protected $table = 'user_post';
    
    public function user() {
        return $this->belongsTo('User');
    }
    
    public function post() {
        return $this->belongsTo('Post');
    }
    
    
}