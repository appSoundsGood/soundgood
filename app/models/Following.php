<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Following extends Eloquent {
    
    protected $table = 'following';
    
    public function followerUser() {
        return $this->belongsTo('User', 'followerUserId');
    }
	
    public function followingUser() {
        return $this->belongsTo('User', 'follwingId');
    }
    public function followingCustomer() {
        return $this->belongsTo('Customer', 'followerCustomerId');
    }
	
    public function post() {
        return $this->belongsTo('Post');
    }
    
    
}