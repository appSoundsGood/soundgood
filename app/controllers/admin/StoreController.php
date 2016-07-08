<?php 


namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Store as StoreModel;
use Recipe as RecipeModel;


class StoreController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
        

        $param['stores'] = StoreModel::paginate(10);
        $param['pageNo'] = 7;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        
		return View::make('admin.store.index')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 7;
		$param['categories'] = CategoryModel::all();
		
		
	    return View::make('admin.store.create')->with($param);
	}
	
	public function edit($id) {
	    $param['category'] = CategoryModel::find($id);
	    $param['pageNo'] = 7;
	    
	    return View::make('admin.store.edit')->with($param);
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
            
	        
	        if (Input::has('store_id')) {
	            $id = Input::get('recipe_id');
	            $category = CategoryModel::find($id);
	            
	            $alert['msg'] = 'Category has been updated successfully';
	            $alert['type'] = 'success';
	        } else {
	            $store = new StoreModel;	     

	            $alert['msg'] = 'Category has been added successfully';
	            $alert['type'] = 'success';
	        }
	    	
            $store = new StoreModel;
	        
	        $store->name = $name;
	        
	        $store->save();
	          
	        return Redirect::route('admin.store')->with('alert', $alert);	        
	    }
	}
	
	public function delete($id) {
		try {
		    CategoryModel::find($id)->delete();
		    
		    $alert['msg'] = 'Category has been deleted successfully';
		    $alert['type'] = 'success';
	    } catch(\Exception $ex) {
	    	$alert['msg'] = 'This category has been already used';
	    	$alert['type'] = 'danger';
	    }
	    
	    return Redirect::route('admin.category')->with('alert', $alert);
	}
}
