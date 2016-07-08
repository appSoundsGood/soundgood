<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Recipe as RecipeModel;
use CustomerStore as CustomerStoreModel;
use Store as StoreModel;
use Customer as CustomerModel;
use CustomerProduct as CustomerProductModel; 
use Recipt as ReciptModel;  
use ReciptProduct as ReciptProductModel;
use DB;

class ReciptController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
        
        
        // $rows = DB::table('customer_store')->
        //            join('customer' , 'customer_store.customer_id' ,'=' , 'customer.id')->
        //            join('store' , 'customer_store.store_id' , '=' , 'store.id')->
        //            get() ;
        // $param['applications'] = $rows;
        
        $param['applications'] = ReciptModel::paginate(10);

        
        $param['pageNo'] = 10;
        
	    return View::make('admin.recipt.index')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 10;
		$param['categories'] = CategoryModel::all();
		
		
	    return View::make('admin.recipt.create')->with($param);
	}
	
	public function edit($id) {
	    $param['category'] = CategoryModel::find($id);
	    $param['pageNo'] = 10;
	    
	    return View::make('admin.recipt.edit')->with($param);
	}
	
	public function store() {
	    
	    $rules = ['name'    => 'required' ,
                   'profile_image' => 'required' ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
	        $name = Input::get('name');
            
	        
	        if (Input::has('recipe_id')) {
	            $id = Input::get('recipe_id');
	            $category = CategoryModel::find($id);
	            
	            $alert['msg'] = 'Category has been updated successfully';
	            $alert['type'] = 'success';
	        } else {
	            $category = new CategoryModel;	     

	            $alert['msg'] = 'Category has been added successfully';
	            $alert['type'] = 'success';
	        }
	    	
            $recipe = new RecipeModel;
	        
	        if (Input::hasFile('profile_image')) {
                $filename = str_random(24).".".Input::file('profile_image')->getClientOriginalExtension();
                Input::file('profile_image')->move(ABS_LOGO_PATH, $filename);
                $recipe->image = $filename;
            }
        
	        
	        $recipe->name = $name;
	        
	        $recipe->save();
	          
	        return Redirect::route('admin.recipt')->with('alert', $alert);	        
	    }
	}
    
    public function viewIngredient($id){
        
        $param['ingredients'] = ReciptProductModel::where('recipt_id', '=', $id)->paginate(10);
        $param['reciptId'] = $id ;
        $param['pageNo'] = 10;
        
        return View::make('admin.ingredientRecipt.index')->with($param);
        
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
	    
	    return Redirect::route('admin.recipt')->with('alert', $alert);
	}
}
