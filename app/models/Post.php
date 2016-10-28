<?php

use Illuminate\Database\Eloquent\Model as Eloquent;

class Post extends Eloquent {
    
    protected $table = 'post';
    
    public function userPosts() {
        return $this->hasMany('UserPost');
    }
    
    public function userPostActivities() {
        return $this->hasMany('UserActivity');
    }
    
    public function getTags() {
    	return Tag::whereIn('id', explode(',', $this->tags))->get();
    }
}