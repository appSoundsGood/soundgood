<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Recipe as RecipeModel;
use Ingredient as IngredientModel ;
use ReciptIngredient as ReciptIngredientModel; 

class IngredientReciptController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
        $param['recipes'] = RecipeModel::paginate(10);
     
        $param['pageNo'] = 10;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        return View::make('admin.ingredientRecipt.index')->with($param);
	}
	
	public function create($id) {
		
        $param['pageNo'] = 10;
        $param['ingredients'] = IngredientModel::all();
		$param['reciptId'] = $id;
        
        return View::make('admin.ingredientRecipt.create')->with($param);
	}
	
	public function edit($id) {
	    $param['category'] = CategoryModel::find($id);
	    $param['pageNo'] = 10;
	    
	    return View::make('admin.ingredientRecipt.edit')->with($param);
	}
    
    
	
	public function store() {
	    
	    $rules = [  
                    'quantity' => 'required' ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
	        $quantity = Input::get('quantity');
            $ingredientId = Input::get('ingredientId');
            $reciptId = Input::get('reciptId');
	        
	        
            $reciptIngredient = new ReciptIngredientModel;
            
            
            $reciptIngredient->ingredient_id =  $ingredientId;     
            $reciptIngredient->recipt_id = $reciptId;      
            $reciptIngredient->quantity = $quantity;       
	        
	        
	        $reciptIngredient->save();
	          
	        return Redirect::route('admin.recipt.viewIngredient',array('id' => $reciptId));	        
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
