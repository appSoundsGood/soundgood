<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;

class CategoryController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('user_id')) {
				return Redirect::route('user.home.index');
			}
		});
	}
    
	public function view(){
		
	}
}
