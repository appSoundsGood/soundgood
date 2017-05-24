<?php namespace User;
use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Store as StoreModel;
use UserStore as UserStoreModel;
use Location as LocationModel;
use Mail;

class AuthController extends \BaseController {
        
    public function login() {
        $param['pageNo'] = 98;
        $token = Input::get('token'); 
        
        $user = UserModel::whereRaw('token = ? and is_active = ?', array( $token , '0'))->get();
       
        if (count($user) != 0) {
            $id = $user[0]->id;
        
            $user =  new UserModel;
            $user = UserModel::find($id);
         
            $user->is_active = 1;   //set active after approve
            $user->save();
            
            $alert['msg'] = 'You have approved your account.Please login';
            $alert['type'] = 'success';
            $param['alert'] =  $alert;            
        } else {
            //$alert['msg'] = 'The token is invaild';
            //$alert['type'] = 'success';
        }
        
        return View::make('user.auth.login')->with($param);        
    }
    
    public function sendHtmlEmail(){
        $data = array();
        $message = array();
        $email = 'appsoundsgood@gmail.com' ;
        
        Mail::send('mail_template.sendHtmlMail', $data, function ($message) use ($email) {
                $message->from('thesoundsgoodteam@gmail.com');
                $message->to( $email , '')->subject('HtmlMail!');
        });
    }
    
    
    public function signup() {
        $param['pageNo'] = 99;
        $param['locations'] = LocationModel::all();
      
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;   
        }
        return View::make('user.auth.signup')->with($param);
    }
    
    public function doSignup() {
        $rules = [
        		'password'   => 'required|confirmed',
                'password_confirmation' => 'required',
                'name'       => 'required',
               	'email'	   => 'required|email|unique:user',
        		'store_name'	=> 'required|unique:store,name',
               ];
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            $user = new UserModel;
            
            $host = $_SERVER['HTTP_HOST'];
           
            $user->name = Input::get('name');
            $user->email = Input::get('email');
            
            $email = Input::get('email');
            
            $user->salt = str_random(8);
            $token =  str_random(32);
            
            $user->password = md5($user->salt.Input::get('password'));
            $user->token = $token ;
            $user->is_active = 0;
            
            if($user->save()) {            
	            $alert['msg'] = 'User has been signed up successfully. Please verify confirmation email';
	            $alert['type'] = 'success';
	            
	            $store = new StoreModel();
	            $store->name = Input::get('store_name');
	            $store->address = Input::get('store_address');
	            $store->phone = Input::get('store_phone');
	            
	            if ($store->save()) {
	            	$ustore = new UserStoreModel();
	            	$ustore->user_id = $user->id;
	            	$ustore->store_id = $store->id;
	            	$ustore->save();
	            }
	            
	            // send confirmation email
	            $data = array();
	            $data = ['email' => $email , 'url' => 'http://'.$host.'/login?token='.$token];
	            
	            /* Mail::send('mail_template.approveMailToSponsor', $data, function ($message) use ($email) {
	                $message->from('thesoundsgoodteam@gmail.com');
	                $message->to( $email , '')->subject('Welcome!');
	            }) */;
            }
            else {
            	$alert['msg'] = 'Failed to register new user';
            	$alert['type'] = 'danger';
            }
            
            return Redirect::route('user.auth.signup')->with('alert', $alert);            
        }
    }
    
    public function doLogin() {
        $email = Input::get('email');
        $password = Input::get('password');
        
        $user = UserModel::whereRaw('email = ? and password = md5(concat(salt, ?))', array($email, $password))->get();
        
        if (count($user) != 0) {
            Session::set('user_id', $user[0]->id);
			Session::set('user_type', "user");
            Session::set('user_name' , $user[0]->name);
            return Redirect::route('user.dashboard.profile');
        } else {
            $alert['msg'] = 'Email & Password is incorrect';
            $alert['type'] = 'danger';
            return Redirect::route('user.auth.login')->with('alert', $alert);
        }
    }
    
    public function doLogout() {
        Session::forget('user_id');
        return Redirect::route('user.home');
    }
}