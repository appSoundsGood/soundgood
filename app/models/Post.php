<?php

use Illuminate\Database\Eloquent\Model as Eloquent;
use Carbon\Carbon;

class Post extends Eloquent {
    
    protected $table = 'post';
    
    public function userPosts() {
        return $this->hasMany('UserPost');
    }
    
    public function userPostActivities() {
        return $this->hasMany('UserActivity');
    }
    
    public function getStartDateAttribute($value) {
    	return (new Carbon($value))->format('m/d/y');
    }
    
    public function setStartDateAttribute($value) {
    	$this->attributes['start_date'] = (new Carbon($value))->format('Y-m-d');
    }
    
    public function getTags() {
    	return Tag::whereIn('id', explode(',', $this->tags))->get();
    }
}