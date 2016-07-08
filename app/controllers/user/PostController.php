<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Presence as PresenceModel;

class PostController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('user_id')) {
				return Redirect::route('user.auth.login');
			}
		});
	}
    
	public function index() {
        $param['posts'] = PostModel::paginate(90);
        $param['pageNo'] = 9;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        
		return View::make('user.post.index')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 9;
		return View::make('user.post.create')->with($param);
	}
	
	public function edit($id) {
	    $param['post'] = PostModel::find($id);
	    $param['pageNo'] = 9;
	    
	    return View::make('user.post.edit')->with($param);
	}
	
	public function store() {
	    
	    $rules = ['name'    => 'required'];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
	        $name = Input::get('name');
	        
	        if (Input::has('post_id')) {
	            $id = Input::get('post_id');
	            $presence = PostModel::find($id);
	            
	            $alert['msg'] = 'Presence has been updated successfully';
	            $alert['type'] = 'success';
	        } else {
	            $presence = new PostModel;	     

	            $alert['msg'] = 'Presence has been added successfully';
	            $alert['type'] = 'success';
	        }
	        
       
	        
	        $presence->name = $name;
	        $presence->save();
	          
	        return Redirect::route('user.post')->with('alert', $alert);	        
	    }
	}
	
	public function delete($id) {
		
		try {
		    PostModel::find($id)->delete();
		    
		    $alert['msg'] = 'Presence has been deleted successfully';
		    $alert['type'] = 'success';
		} catch(\Exception $ex) {
			$alert['msg'] = 'This presence has been already used';
			$alert['type'] = 'danger';
		}

	    return Redirect::route('user.post')->with('alert', $alert);
	}
}
