<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Recipe as RecipeModel;
use RecipeIngredient as RecipeIngredientModel;

class RecipeController extends \BaseController {
	
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
	
	public function create() {
		$param['pageNo'] = 4;
		$param['categories'] = CategoryModel::all();
		
		
	    return View::make('admin.recipe.create')->with($param);
	}
	
	public function edit($id) {
	    $param['category'] = CategoryModel::find($id);
	    $param['pageNo'] = 4;
	    
	    return View::make('admin.recipe.edit')->with($param);
	}
    
    public function viewIngredient($id){
        
        $param['ingredients'] = RecipeIngredientModel::where('recipe_id', '=', $id)->paginate(10);
        $param['recipeId'] = $id ;
        $param['pageNo'] = 4;
        
        return View::make('admin.ingredient.index')->with($param);
        
    }
	
	public function store() {
	    
	    $rules = ['name'    => 'required' ,
                   'profile_image' => 'required' ,
                   'prepTime' => 'required' ,
                   'nutriInfo' => 'required' ,
                   'servings' => 'required' ,
                   'quickBios' => 'required' 
                   
                    ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
            $name = Input::get('name');
            $prepTime = Input::get('prepTime');
            $servings = Input::get('servings');
            $nutriInfo = Input::get('nutriInfo');
	        $quickBios = Input::get('quickBios');
            
	        
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
            $recipe->prepTime = $prepTime;
            $recipe->servings = $servings;
            $recipe->nutriInfo = $nutriInfo;
	        $recipe->quickBios = $quickBios;
	        
	        $recipe->save();
	          
	        return Redirect::route('admin.recipe')->with('alert', $alert);	        
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
