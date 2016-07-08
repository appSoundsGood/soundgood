<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Recipe as RecipeModel;
use Ingredient as IngredientModel ;
use RecipeIngredient as RecipeIngredientModel; 

class IngredientController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
        $param['recipes'] = RecipeModel::paginate(10);
     
        $param['pageNo'] = 4;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        return View::make('admin.recipe.index')->with($param);
	}
	
	public function create($id) {
		
        $param['pageNo'] = 4;
        $param['categories'] = CategoryModel::all();
		$param['recipeId'] = $id;
        return View::make('admin.ingredient.create')->with($param);
	}
	
	public function edit($id) {
	    $param['category'] = CategoryModel::find($id);
	    $param['pageNo'] = 4;
	    
	    return View::make('admin.recipe.edit')->with($param);
	}
    
    
	
	public function store() {
	    
	    $rules = [  'name'    => 'required' 
                     
                     ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
	        $name = Input::get('name');
            $nbd = Input::get('nbd');
            $preperation = Input::get('preperation');
            $recipeId = Input::get('recipeId');
	        
	        $ingredientModel = IngredientModel::where('name' , $name )->get();  
            
             if (count($ingredientModel) == 0) { 
                $ingredient = new IngredientModel;
                $recipeIngredient = new RecipeIngredientModel;
                
                
                $ingredient->name = $name;
                $ingredient->nbd = $nbd;
                $ingredient->preperation = $preperation;
                $ingredient->save();
                
                $recipeIngredient->recipe_id =  $recipeId;     
                $recipeIngredient->ingredient_id = $ingredient->id;      
                //$recipeIngredient->quantity = $quantity;       
                
                $recipeIngredient->save(); 
             }
              
	        return Redirect::route('admin.recipe.viewIngredient',array('id' => $recipeId));	        
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
