<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'user';
    
    public function userStores() {
        return $this->hasMany('UserStore');
    }
    
    public function userProducts() {
        return $this->hasMany('Product');
    }

    public function userPosts() {
        return $this->hasMany('UserPost');
    }
    public function userRecipes() {
        return $this->hasMany('UserRecipe');
    }
    
    public function userRecipeActivities() {
        return $this->hasMany('UserActivity');
    }
    
    /**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

}
