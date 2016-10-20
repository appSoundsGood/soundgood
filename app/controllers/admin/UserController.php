<?php namespace Admin;

use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Location as LocationModel;
use Customer as CustomerModel;

class UserController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
		$param['users'] = UserModel::paginate(10);
        $param['pageNo'] = 2;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
    	return View::make('admin.user.index')->with($param);
	}
	public function home() {
		$param['users'] = UserModel::paginate(10);
		$param['locations'] = LocationModel::all();
		
		$param['pageNo'] = 2;
	
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
	
		return View::make('admin.user.home')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 2;
		
	    return View::make('admin.user.create')->with($param);
	}
	
	public function edit($id) {
	    $param['user'] = UserModel::find($id);
	    $param['pageNo'] = 2;
	    
	    return View::make('admin.user.edit')->with($param);
	}
	
	public function store() {
	    
	    $rules = ['name'    => 'required',
				  'email'   => 'required|email',
				  'phone'   => 'required',
				  'photo'	=> 'required',
				 ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
            $password = Input::get('password');
            
            if (Input::has('user_id')) {
                $id = Input::get('user_id');
                $user = UserModel::find($id);
                $is_active = Input::get('is_active');
                
                if ($password !== '') {
                    $user->secure_key = md5($company->salt.$password);
                }
                $user->is_active = $is_active;
            } else {
                $user = new CompanyModel;
                
                if ($password === '') {
                    $alert['msg'] = 'You have to enter password';
                    $alert['type'] = 'danger';
                    return Redirect::route('admin.user.create')->with('alert', $alert);
                }
                $user->salt = str_random(8);
                $user->secure_key = md5($user->salt.$password);                
            }       
            
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            $user->phone = Input::get('phone');
            
            if (Input::hasFile('photo')) {
            	$filename = str_random(24).".".Input::file('photo')->getClientOriginalExtension();
            	Input::file('photo')->move(ABS_PHOTO_PATH, $filename);
            	$user->profile_image = $filename;
            }else {
            	$user->profile_image = LOGO;
            }
            
            if (Input::hasFile('video')) {
            	$filename = str_random(24).".".Input::file('video')->getClientOriginalExtension();
            	Input::file('video')->move(ABS_VIDEO_PATH, $filename);
            	$user->video = $filename;
            }
            
            $user->save();
            
            $alert['msg'] = 'User has been saved successfully';
            $alert['type'] = 'success';
              
            return Redirect::route('admin.user')->with('alert', $alert);     	        
	    }
	}
	
	public function delete($id) {
	    UserModel::find($id)->delete();
	    
	    $alert['msg'] = 'User has been deleted successfully';
	    $alert['type'] = 'success';
	    
	    return Redirect::route('admin.user')->with('alert', $alert);
	}
}
