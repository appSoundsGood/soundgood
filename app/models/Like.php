<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Like extends Eloquent {
    
    protected $table = 'like';
    
    public function likeUser() {
        return $this->belongsTo('User', 'likeUserId');
    }
    public function likeConsumer() {
        return $this->belongsTo('Consumer', 'likeCustomerId');
    }
	
    public function ownerUser() {
        return $this->belongsTo('User', 'ownerUserId');
    }
	
    public function recipe() {
        return $this->belongsTo('Recipe');
    }
    
    
}