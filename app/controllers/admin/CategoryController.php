<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use Category as CategoryModel;
use Recipe as RecipeModel;

class CategoryController extends \BaseController {
    
    public function __construct() {
        $this->beforeFilter(function(){
            if (!Session::has('admin_id')) {
                return Redirect::route('admin.auth.login');
            }
        });
    }
    public function index() {
         
        $param['categories'] = CategoryModel::paginate(10);
        $param['pageNo'] = 6;
        
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        
        return View::make('admin.category.index')->with($param);
    }
    
    public function create() {
        $param['pageNo'] = 6;
        $param['categories'] = CategoryModel::all();
        
        
        return View::make('admin.category.create')->with($param);
    }
    
    public function edit($id) {
        $param['category'] = CategoryModel::find($id);
        $param['pageNo'] = 6;
        
        return View::make('admin.category.edit')->with($param);
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
            
            $category = new CategoryModel;
            
            if (Input::hasFile('profile_image')) {
                $filename = str_random(24).".".Input::file('profile_image')->getClientOriginalExtension();
                Input::file('profile_image')->move(ABS_CATEGORY_PATH, $filename);
                $category->categoryImg = $filename;
            }
        
            $category->name = $name;
            $category->save();
              
            return Redirect::route('admin.category')->with('alert', $alert);            
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
