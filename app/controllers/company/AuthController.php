<?php namespace Company;
use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Company as CompanyModel;
use Job as JobModel;
use City as CityModel;
use Category as CategoryModel;
use Teamsize as TeamsizeModel;
use Service as ServiceModel;
use CompanyService as CompanyserviceModel;


class AuthController extends \BaseController {
        
    public function login() {
        $param['pageNo'] = 98;
        
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        
        return View::make('company.auth.login')->with($param);        
    }
    
    public function signup() {
        $param['pageNo'] = 99;      
        $param['cities'] = CityModel::all();
        $param['teamsizes'] = TeamsizeModel::all();
        $param['categories'] = CategoryModel::all();
        $param['services']  = ServiceModel::all();
        
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;   
        }
        
        return View::make('company.auth.signup')->with($param);
    }
    
    public function doSignup() {
    	
        $rules = ['name' 		=> 'required',
				  'password'   => 'required|confirmed',
                  'password_confirmation' => 'required',
                  'email' 		=> 'required|email',
                 ];
        
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
            $password = Input::get('password');
            $companyId = 0;
            
            $is_published = 0;
            
            if (Input::has('is_published')) {
            	$is_published = Input::get('is_published');
            }
            
			$company = new CompanyModel;
			
			if ($password === '') {
				$alert['msg'] = 'You have to enter password';
				$alert['type'] = 'danger';
				return Redirect::route('admin.company.create')->with('alert', $alert);
			}
			$company->salt = str_random(8);
			$company->secure_key = md5($company->salt.$password);                      
            $company->teamsize_id = TeamsizeModel::whereRaw(true)->min('id');
            $company->category_id = CategoryModel::whereRaw(true)->min('id');
            $company->city_id = Input::get('city_id');
            $company->name = Input::get('name');
            $company->email = Input::get('email');
            $company->logo = 'default_company_logo.gif';
			$company->is_finished 	= 1;

			$company->save();
			            
            $alert['msg'] = 'Company has been saved successfully';
            $alert['type'] = 'success';
              
            return Redirect::route('company.auth.signup')->with('alert', $alert);        
	    }
    }
    
    public function doLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        
        $user = UserModel::whereRaw('email = ? and password = md5(?)', array($email, $password))->get();
        
        if (count($user) != 0) {
            Session::set('user_id', $user[0]->id);
            return Redirect::route('user.dashboard');
        } else {
            $alert['msg'] = 'Username & Password is incorrect';
            $alert['type'] = 'danger';
            return Redirect::route('user.auth.login')->with('alert', $alert);
        }
    }
    
    public function doLogout() {
        Session::forget('company_id');
        return Redirect::route('user.job.home');
    }
}