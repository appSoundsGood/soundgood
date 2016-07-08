<?php namespace Admin;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Customer as CustomerModel;
use Product as ProductModel;

class ProductController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('admin_id')) {
				return Redirect::route('admin.auth.login');
			}
		});
	}
    public function index() {
		$param['products'] = ProductModel::paginate(50);
        $param['pageNo'] = 12;
        
	    if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
    	return View::make('admin.product.index')->with($param);
	}
	public function home() {
        $param['prodcuts'] = ProductModel::paginate(10);
		
		$param['pageNo'] = 12;
	
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
	
		return View::make('admin.product.home')->with($param);
	}
	public function search() {
        
         $search = Input::get('search');
         //$posts = $this->post->where('title', 'like', '%'.$search.'%')->paginate(10);
         $param['products'] = ProductModel::where('itemName', 'LIKE', '%'.$search.'%')->orWhere('upcCode', 'LIKE', '%'.$search.'%')->paginate(50);
         
         $param['pageNo'] = 12;
        
        if ($alert = Session::get('alert')) {
            $param['alert'] = $alert;
        }
        return View::make('admin.product.index')->with($param);
    }
	public function create() {
		$param['pageNo'] = 12;
		
	    return View::make('admin.customer.create')->with($param);
	}
	
	public function edit($id) {
	    $param['product'] = ProductModel::find($id);
	    $param['pageNo'] = 12;
	    
	    return View::make('admin.product.edit')->with($param);
	}
	
	public function store() {
	    
	    $rules = ['upcCode'    => 'required',
				  'itemName'   => 'required',
				  'size'   => 'required',
				  'nbd'	=> 'required',
				 ];
	    $validator = Validator::make(Input::all(), $rules);
	    
	    if ($validator->fails()) {
	        return Redirect::back()
	            ->withErrors($validator)
	            ->withInput();
	    } else {
            $password = Input::get('password');
            
            if (Input::has('product_id')) {
                $id = Input::get('product_id');
                $product = ProductModel::find($id);

            } else {
                   
            }       
            
            $product->upcCode = Input::get('upcCode');
            $product->itemName = Input::get('itemName');
            $product->size = Input::get('size');
            $product->nbd = Input::get('nbd');
            
            $product->save();
            
            $alert['msg'] = 'Product has been saved successfully';
            $alert['type'] = 'success';
              
            return Redirect::route('admin.product.search')->with('alert', $alert);     	        
	    }
	}
	
	public function delete($id) {
	    UserModel::find($id)->delete();
	    
	    $alert['msg'] = 'User has been deleted successfully';
	    $alert['type'] = 'success';
	    
	    return Redirect::route('admin.user')->with('alert', $alert);
	}
}
