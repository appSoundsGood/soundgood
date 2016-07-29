<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class UserActivity extends Eloquent {
    
    protected $table = 'user_activity';
    
    public function user() {
        return $this->belongsTo('User');
    }
    public function post() {
        return $this->belongsTo('Post');
    }
    public function recipe() {
        return $this->belongsTo('Recipe');
    }
}