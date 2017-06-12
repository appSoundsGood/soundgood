<?php
namespace User;

use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Store as StoreModel;
use UserStore as UserStoreModel;
use Product as ProductModel;

class StoreController extends \BaseController {
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('user_id') || Session::get('user_type') != 'user') {
				return Redirect::route('user.auth.login');
			}
		});
	}
	
	public function index() {            
        $user_id =  Session::get('user_id');
            
       	$param['ustores'] = UserStoreModel::where('user_id', '=', $user_id)->paginate(10);
       	$param['pageNo'] = 12;
			
		return View::make('user.store.index')->with($param);
	}
	
	public function view($id) {
		$param['model'] = $this->findModel($id);
		
		return View::make('user.store.view')->with($param);
	}
	
	protected function findModel($id) {
		$model = StoreModel::find($id);
		return $model;
	}
	
	public function create() {
		$param['model'] = new StoreModel();
		
		return View::make('user.store.form')->with($param);
	}
	
	public function edit($id) {
		$param['model'] = $this->findModel($id);
		
		return View::make('user.store.form')->with($param);
	}
	
	public function save() {
		$rules = [
				'name' => 'required',
		];
		$validator = Validator::make(Input::all(), $rules);
		 
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		}
		else {
			if (Input::has('id')) {
				$id = Input::get('id');
				$model = StoreModel::find($id);
				 
				$alert['msg'] = 'Store has been updated successfully';
				$alert['type'] = 'success';
			} else {
				$model = new StoreModel;
		
				$alert['msg'] = 'Store has been added successfully';
				$alert['type'] = 'success';
			}
			 
			$model->name = Input::get('name');
			$model->address = Input::get('address');
			$model->phone = Input::get('phone');			
						 
			if($model->save()) {			
				$user_post = UserStoreModel::whereRaw('user_id=? AND store_id=?', [Session::get('user_id'), $model->id])->first();
				if ($user_post == null) {
					$user_post = new UserStoreModel();
					$user_post->user_id = Session::get('user_id');
					$user_post->store_id = $model->id;
					$user_post->save();
				}
		
				Session::flash('message', 'Successfully saved store!');
			}
			 
			return Redirect::route('user.post')->with('alert', $alert);
		}
	}
	
	/* Product related methods */
	
	/**
	 * Product List
	 */
	public function products($store_id) {
		$param['pageNo'] = 12;
				
		$products =  ProductModel::where('store_id', $store_id)->paginate(50);
		
		$param['products'] = $products;
		$param['store_id'] = $store_id;
		
		return View::make('user.store.product')->with($param);
	}
	
	public function createProduct($store_id) {
		$param['model'] = new ProductModel();
		$param['store_id'] = $store_id;
		
		return View::make('user.store.product_form')->with($param);
	}
	
	public function editProduct($store_id, $id) {
		$param['model'] = ProductModel::find($id);
		$param['store_id'] = $store_id;
		
		return View::make('user.store.product_form')->with($param);
	}
	
	public function deleteProduct($id) {
		
	}
}