<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Admin as AdminModel;

class AdminController extends \BaseController {
    
    public function index() {
        if (Session::has('admin_id')) {
            return Redirect::route('admin.dashboard');
        } else {
            return Redirect::route('admin.auth.login');
        }
    }
    
	public function login() {
	    if ($alert = Session::get('alert')) {
	        $param['alert'] = $alert;
	        return View::make('admin.login.index')->with($param);
	    } else {
	        return View::make('admin.login.index');
	    }
	}
	
	public function signin() {
	    $username = Input::get('name');
	    $password = Input::get('password');
	    
	    $admin = AdminModel::whereRaw('username = ? and password = md5(?)', array($username, $password))->get();
	    
	    if ($admin) {
	        Session::set('admin_id', 1);
	        return Redirect::route('admin.dashboard');
	    } else {
	        $alert['msg'] = 'Invalid username and password';
	        $alert['type'] = 'danger';
	        return Redirect::route('admin.auth.login')->with('alert', $alert);
	    }
	}
	
	public function signout() {
	    Session::forget('admin_id');
	    return Redirect::route('admin.auth.login');
	}
}
