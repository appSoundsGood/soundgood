<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Location as LocationModel;

class LocationController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    
	public function index() {
        $param['countries'] = LocationModel::paginate(10);
        $param['pageNo'] = 1;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        
		return View::make('admin.location.index')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 1;
		
	    return View::make('admin.location.create')->with($param);
	}
	
	public function edit($id) {
	    $param['Location'] = LocationModel::find($id);
	    $param['pageNo'] = 1;
	    
	    return View::make('admin.location.edit')->with($param);
	}
	
	public function store() {
	    
	    $rules = ['name' => 'required'];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
	        $name = Input::get('name');
	        
	        if (Input::has('Location_id')) {
	            $id = Input::get('Location_id');
	            $Location = LocationModel::find($id);
	            
	            $alert['msg'] = 'Location has been updated successfully';
	            $alert['type'] = 'success';
	        } else {
	            $Location = new LocationModel;	     

	            $alert['msg'] = 'Location has been added successfully';
	            $alert['type'] = 'success';
	        }
	        
       
	        
	        $Location->name = $name;
	        $Location->save();
	          
	        return Redirect::route('admin.location')->with('alert', $alert);	        
	    }
	}
	
	public function delete($id) {
	    LocationModel::find($id)->delete();
	    
	    $alert['msg'] = 'Location has been deleted successfully';
	    $alert['type'] = 'success';
	    
	    return Redirect::route('admin.location')->with('alert', $alert);
	}
}
