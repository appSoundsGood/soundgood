<?php 
namespace User;

use View, Input, Redirect, Session, Validator;
use User as UserModel;
use Post as PostModel;
use PostVideo as PostVideoModel;
use PostImage as PostImageModel;
use UserPost as UserPostModel;
use Tag as TagModel;

class PostController extends \BaseController {
	
	public function __construct() {
		$this->beforeFilter(function(){
			if (!Session::has('user_id')) {
				return Redirect::route('user.auth.login');
			}
		});
	}
    
	public function index() {
        $userId = Session::get('user_id');
        $posts = UserPostModel::where('user_id', $userId)->paginate(10);
		
        $param['posts'] = $posts;
		$param['pageNo'] = 11;
		        
		return View::make('user.post.index')->with($param);
	}
	
	public function view($id) {
		$userId = Session::get('user_id');
		
		$post = PostModel::where('id', $id)->first();
		
		$postVideos = PostVideoModel::where('postId', $post->id)->get();
		$postImages = PostImageModel::where('postId', $post->id)->get();
		
		$param['post'] = $post;
		
		$videos = array();
		$images = array();
				
		foreach($postVideos as $postVideo){
			$videos[] = VideoModel::where('id', $postVideo->videoId)->get();
		}
		foreach($postImages as $postImage){
			$images[] = ImageModel::where('id', $postImage->imageId)->get();
		}
		
		$param['postVideos'] = $videos;
		$param['postImages'] = $images;
		
		return View::make('user.post.view')->with($param);
	}
	
	public function create() {
		$param['pageNo'] = 11;
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}
		else {
			$param['user'] = UserModel::find(Session::get('user_id'));
			$param['post'] = new PostModel();
			$param['cuisines'] = TagModel::where('kind', 0)->lists('name', 'id');
			$param['diets'] = TagModel::where('kind', 1)->lists('name', 'id');
			$param['types'] = TagModel::where('kind', 2)->lists('name', 'id');
			
			return View::make('user.post.create')->with($param);
		}
	}
	
	public function edit($id) {
	    $param['post'] = PostModel::find($id);
	    $param['pageNo'] = 11;
	    
	    $param['cuisines'] = TagModel::where('kind', 0)->lists('name', 'id');
	    $param['diets'] = TagModel::where('kind', 1)->lists('name', 'id');
	    $param['types'] = TagModel::where('kind', 2)->lists('name', 'id');
	    
	    return View::make('user.post.edit')->with($param);
	}
	
	public function save() {
	    
	    $rules = [
	    		'title' => 'required',  
	    		'content' => 'required',
	    		'image' => 'mimes:jpeg,jpg,png',
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
	            $presence = PostModel::find($id);
	            
	            $alert['msg'] = 'Presence has been updated successfully';
	            $alert['type'] = 'success';
	        } else {
	            $presence = new PostModel;	     

	            $alert['msg'] = 'Presence has been added successfully';
	            $alert['type'] = 'success';
	        }
	        
	        $presence->title = Input::get('title');
	        $presence->content = Input::get('content');
	        $presence->price_original = Input::get('price_original');
	        $presence->price_sale = Input::get('price_sale');
	        $presence->expire_date = Input::get('expire_date');
	        $presence->vendor = Input::get('vendor');
	        $presence->tags = implode(',', Input::get('tags'));
	        
	        if(Input::hasFile('image')) {
	        	$imageName = uniqid(substr(bin2hex(Input::file('image')->getClientOriginalName()), 0, 4). '_') . '.' .
	        					Input::file('image')->getClientOriginalExtension();
	        	$presence->image = $imageName;
	        }
	        
	        if($presence->save()) {
	        	if(Input::hasFile('image')) {
        			Input::file('image')->move(base_path() . '/public/uploads/ads/', $imageName);
	        	}
	        	Session::flash('message', 'Successfully saved advertisement!');
	        }
	          
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
