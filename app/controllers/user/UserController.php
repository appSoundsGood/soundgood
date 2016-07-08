<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator , Response;
use User as UserModel;
use City as CityModel;
use Category as CategoryModel;
use Level as LevelModel;
use Language as LanguageModel;
use Type as TypeModel;
use Cart as CartModel;
use Apply as ApplyModel;
use Pattern as PatternModel;
use Job as JobModel;
use Location as LocationModel;
use Post as PostModel;
use Video as VideoModel;
use Image as ImageModel;
use Recipe as RecipeModel;
use PostImage as PostImageModel;
use PostVideo as PostVideoModel;

use UserSkill as UserSkillModel;
use UserLanguage as UserLanguageModel;
use UserEducation as UserEducationModel;
use UserAwards as UserAwardsModel;
use UserExperience as UserExperienceModel;
use UserTestimonial as UserTestimonialModel;
use UserStore as UserStoreModel;
use Store as StoreModel;
use Product as ProductModel;
use Mail;



class UserController extends \BaseController {
	
	public function view($id) {
		$param['user'] = UserModel::find($id);
		return View::make('user.dashboard.view')->with($param);
	}
	
	public function appliedJobs() {
		
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 5;
			$param['user'] = UserModel::find(Session::get('user_id'));
			return View::make('user.dashboard.appliedJobs')->with($param);
		}
	}
	public function home() {
        
		$param['users'] = UserModel::all();
		$param['locations'] = LocationModel::all();
		
		$param['recipes'] = RecipeModel::all(); 
		$param['products'] = CategoryModel::all();
            
		$param['pageNo'] = 5;
	
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
        $data = array();
      
		return View::make('user.home.index')->with($param);
	}
	
    public function post() {
		
		$param['posts'] = PostModel::paginate(10);
		$param['pageNo'] = 5;
			
		return View::make('user.dashboard.appliedPosts')->with($param);
		
	}
	
    public function postView($etc){
		
		$post = PostModel::where('title', $etc)->get(); 
		
		$postVideos = PostVideoModel::where('postId', $post[0]->id)->get(); 
		$postImages = PostImageModel::where('postId', $post[0]->id)->get();
		
		$param['posts'] = $post;
		
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
		
		return View::make('user.dashboard.postView')->with($param);
	}
	public function profileEdit(){
		
		$param['user'] = UserModel::find(Session::get('user_id'));
		$param['locations'] = LocationModel::all();
        
        return View::make('user.dashboard.profileEdit')->with($param);
	}
	
	public function chat() {
	
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 3;
			$param['user'] = UserModel::find(Session::get('user_id'));
			
			return View::make('user.chat.index')->with($param);
		}
	
	}
	
	public function postMake() {
		
		$title = Input::get('title');
		$articleContent = Input::get('articleContent');
		$location = Input::get('locationArticle');
		$email = Input::get('email');
		
		$post = new PostModel;	 
		
		$post->title = $title;
		$post->content = $articleContent;
		$post->location = $location;
		$post->email = $email;
		
		$post->save();
		
		return Response::json(['result' => 'success', 'msg' => 'You have successed in new post' , 'postId' => $post->id ]);
		
	}
	
	public function postData() {
	
		$postId = Input::get('postId');
		
		if (Input::hasFile('postVideo')) {
			$filename = str_random(24).".".Input::file('postVideo')->getClientOriginalExtension();
			Input::file('postVideo')->move(ABS_VIDEO_PATH, $filename);
			
			$url = ABS_VIDEO_PATH.'/'.$filename;
			
			$video =  new VideoModel;
			
			$video->url = $url;
			$video->save();
			
			$postVideo =  new PostVideoModel;
			
			$postVideo->postId = $postId;
			$postVideo->videoId = $video->id;
			
			$postVideo->save();
			
		}
		
		foreach(Input::file('postImage') as $imageFile){
			if($imageFile != ""){
				$filename = str_random(24).".".$imageFile->getClientOriginalExtension();
				$imageFile->move(ABS_IMAGE_PATH, $filename);
				
				$url = ABS_IMAGE_PATH.'/'.$filename;
				$image =  new ImageModel;
					
				$image->url = $url;
				$image->save();
					
				$postImage = new PostImageModel;
				
				$postImage->postId = $postId;
				$postImage->imageId = $image->id;
				
				$postImage->save();
			}
		}
	}
	
	public function postNew() {
		
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 5;
			$param['user'] = UserModel::find(Session::get('user_id'));
			return View::make('user.dashboard.postNew')->with($param);
		}
	}
	
	public function cart() {
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 2;
			$param['user'] = UserModel::find(Session::get('user_id'));
			$param['patterns'] = PatternModel::all();
				
			return View::make('user.dashboard.myApply')->with($param);	
		}
	}
	public function profile() {
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 3;
			$param['user'] = UserModel::find(Session::get('user_id'));
			
			$param['posts'] = PostModel::all();
			
			
			return View::make('user.dashboard.dashboard')->with($param);
		}
	}
	public function profileView($etc){
		$param['pageNo'] = 3;
		$param['user'] = UserModel::where('name',$etc)->get();
		
		
		$param['posts'] = PostModel::all();
			
		return View::make('user.dashboard.profileView')->with($param);
	}
    
    public function store(){
		if (!Session::has('user_id')) {
			return Redirect::route('user.auth.login');
		}else {
			$param['pageNo'] = 12;
            
            $user =  UserModel::find(Session::get('user_id'));
            
            $param['user'] = UserStoreModel::paginate(10); 
			
			return View::make('user.dashboard.userStore')->with($param);
		}
	}
    public function storeCreate(){
       $param['user'] = ""; 
       return View::make('user.dashboard.createStore')->with($param);  
    }
    
    
    public function storeSave(){
        
        $param['pageNo'] = 12;
        
        $rules = ['name'    => 'required'];
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            
            $name = Input::get('name');
            $userId = Session::get('user_id');
            
            $userStore = new UserStoreModel;    
            $store = new StoreModel;
            
            if (Input::has('store_id')) {
                $id = Input::get('recipe_id');
                $category = CategoryModel::find($id);
                
                $alert['msg'] = 'Category has been updated successfully';
                $alert['type'] = 'success';
            } else {
                     
                $alert['msg'] = 'Category has been added successfully';
                $alert['type'] = 'success';
            }
            
            $store->name = $name;
            $store->save();
            
            $userStore->store_id = $store->id;
            $userStore->user_id = $userId;   
            
            $userStore->save();      
              
            return Redirect::route('user.store')->with('alert', $alert);            
        }
        
        return View::make('user.dashboard.userStore')->with($param);
    }
    
    public function product(){
       if (!Session::has('user_id')) {
            return Redirect::route('user.auth.login');
        }else {
            $param['pageNo'] = 13;
            
            $userId = Session::get('user_id');
            
            $product =  ProductModel::where('user_id',$userId)->paginate(50);
            
            $param['product'] = $product; 
            
            return View::make('user.dashboard.userProduct')->with($param);
        } 
    }
    public function productCreate(){
       
       $param['stores'] = StoreModel::all();
       $param['categorys'] = CategoryModel::all(); 
       
       return View::make('user.dashboard.createProduct')->with($param);  
    
    }
    
    public function storeProduct(){
        
        $param['pageNo'] = 12;
        
        $rules = [
            'storeId' => 'required',
            'categoryId' => 'required', 
            'upcCode' => 'required', 
            'itemName' => 'required', 
            'size' => 'required'
        ];
        $validator = Validator::make(Input::all(), $rules);
        
        if ($validator->fails()) {
            return Redirect::back()
                ->withErrors($validator)
                ->withInput();
        } else {
            
            $storeId = Input::get('storeId');  
            $userId = Session::get('user_id');
            $categoryId = Input::get('categoryId');
            $upcCode = Input::get('upcCode');
            $brand = Input::get('brand');
            $itemName = Input::get('itemName');
            $size = Input::get('size');
            
            
            $product = new ProductModel;    
            
            if (Input::has('product_id')) {
                $id = Input::get('recipe_id');
                $category = CategoryModel::find($id);
                
                $alert['msg'] = 'Category has been updated successfully';
                $alert['type'] = 'success';
            } else {
                     
                $alert['msg'] = 'Category has been added successfully';
                $alert['type'] = 'success';
            }
            
            $product->user_id = $userId;
            $product->store_id = $storeId;
            $product->category_id = $categoryId;
            $product->upcCode = $upcCode;
            $product->brand = $brand;
            $product->itemName = $itemName;
            $product->size = $size;
          
            
            $product->save();
            
            return Redirect::route('user.product')->with('alert', $alert);            
        }
        
        return View::make('user.dashboard.userStore')->with($param);
    }
    
    
    
	public function saveProfile() {
		$rules = [
					'name'       => 'required',
					
					];
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		} else {
			$password = Input::get('password');
			$id = Input::get('user_id');
			$user = UserModel::find($id);
			$is_active = Input::get('is_active');
		
			
			$user->is_active = $is_active;		
			$user->name = Input::get('name');
			$user->email = Input::get('email');
			
            $user->companyName = Input::get('company_name');
            $user->state = Input::get('state');
            $user->city = Input::get('city');    
            $user->zipCode = Input::get('zip_code'); 
            
            $user->stock = Input::get('stock');
            $user->coupon = Input::get('coupon');
            $user->price = Input::get('price');
            $user->is_pushSet = Input::get('pushSet');
            
            if (Input::hasFile('profile_image')) {
				$filename = str_random(24).".".Input::file('profile_image')->getClientOriginalExtension();
				Input::file('profile_image')->move(ABS_PHOTO_PATH, $filename);
				$user->profile_image = $filename;
			}
			
			$user->save();
			
			$alert['msg'] = 'Profile has been saved successfully';
			$alert['type'] = 'success';
		
			return Redirect::route('user.dashboard.profile')->with('alert', $alert);
		}
	}

}
