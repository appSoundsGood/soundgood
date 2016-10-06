<?php

use Illuminate\Support\Facades\Redirect;
Route::pattern('id', '[0-9]+');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return Redirect::route('user.home');
});
//Route::get('home/{id?}',   	['as' => 'user.job.home',          'uses' => 'User\JobController@home']);

Route::get('cron',        ['as' => 'user.cron',               'uses' => 'HomeController@cronJob']);      
Route::get('phpinfo',        ['as' => 'user.phpinfo',          'uses' => 'HomeController@phpInfo']);



Route::get('signup',        ['as' => 'user.auth.signup',       		'uses' => 'User\AuthController@signup']);
Route::post('doSignup',     ['as' => 'user.auth.doSignup',     		'uses' => 'User\AuthController@doSignup']);

Route::get('login',         ['as' => 'user.auth.login',             'uses' => 'User\AuthController@login']);
Route::get('sendEmail',     ['as' => 'user.auth.sendHtml',          'uses' => 'User\AuthController@sendHtmlEmail']);
Route::get('confirm',       ['as' => 'user.auth.confirm',           'uses' => 'User\AuthController@confirm']);
Route::post('doLogin',      ['as' => 'user.auth.doLogin',      		'uses' => 'User\AuthController@doLogin']);
Route::get('doLogout',      ['as' => 'user.auth.doLogout',     		'uses' => 'User\AuthController@doLogout']);

Route::get('home', 			['as' => 'user.home', 					'uses' => 'User\UserController@home']);
Route::get('search',        ['as' => 'user.post.search',  	   		'uses' => 'User\UserController@search']);
Route::get('dashboard', 	['as' => 'user.dashboard', 				'uses' => 'User\UserController@dashboard']);
Route::get('post', 			['as' => 'user.post', 					'uses' => 'User\UserController@post']);
Route::get('popular',       ['as' => 'user.popular',                'uses' => 'User\UserController@popular']);
Route::get('recipe',        ['as' => 'user.recipe',                 'uses' => 'User\UserController@recipe']);
Route::get('newPost', 		['as' => 'user.postNew', 				'uses' => 'User\UserController@postNew']);
Route::get('newRecipe', 	['as' => 'user.recipeNew', 				'uses' => 'User\UserController@recipeNew']);
Route::get('followers', 		['as' => 'user.followers', 				'uses' => 'User\UserController@followers']);
Route::get('following', 	['as' => 'user.following', 				'uses' => 'User\UserController@following']);
Route::get('profileView/{id}', 	['as' => 'user.viewProfile', 		'uses' => 'User\UserController@viewProfile']);

Route::post('makePost', 	['as' => 'user.post.makeNew', 			'uses' => 'User\UserController@postMake']);
Route::post('makeRecipe',   ['as' => 'user.recipe.makeNew',         'uses' => 'User\UserController@recipeMake']);
Route::post('follow',   	['as' => 'user.follow',         		'uses' => 'User\UserController@follow']);
Route::post('unfollow',   	['as' => 'user.unfollow',         		'uses' => 'User\UserController@unfollow']);



Route::post('postData', 	['as' => 'user.post.postData', 			'uses' => 'User\UserController@postData']);
Route::get('store',         ['as' => 'user.store',                  'uses' => 'User\UserController@store']);
Route::get('storeEdit/{id}',     ['as' => 'user.storeEdit',         'uses' => 'User\UserController@storeEdit']);  
Route::get('product', 		['as' => 'user.product', 				'uses' => 'User\UserController@product']);


Route::get('store/create',     ['as' => 'user.store.create',      'uses' => 'User\UserController@storeCreate']);   
Route::post('store/save',      ['as' => 'user.store.save',       'uses' => 'User\UserController@storeSave']); 


Route::get('product/create',     ['as' => 'user.product.create',      'uses' => 'User\UserController@productCreate']);   
Route::post('product/save',      ['as' => 'user.product.save',       'uses' => 'User\UserController@storeProduct']); 


Route::get('customer/home',    ['as' => 'customer.home',                      'uses' => 'User\CustomerController@home']);
Route::get('customer/recipeView/{etc}',['as' => 'customer.recipeView',        'uses' => 'User\CustomerController@recipeView']);

Route::get('recipe/external/{etc}/{url}',['as' => 'customer.viewRecipe',        'uses' => 'User\CustomerController@viewRecipe']);


Route::get('dashboard',     ['as' => 'customer.dashboard',                 'uses' => 'User\CustomerController@dashboard']);
Route::get('customer/cabinet',     ['as' => 'customer.dashboard.cabinet',         'uses' => 'User\CustomerController@cabinet']);                   
Route::get('customer/ingredient',     ['as' => 'customer.dashboard.ingredient',      'uses' => 'User\CustomerController@ingredient']); 
Route::get('customer/buy', ['as' => 'customer.home.buy',                    'uses' => 'User\CustomerController@buy']);

Route::post('customer/follow',   	['as' => 'customer.follow',         		'uses' => 'User\CustomerController@follow']);
Route::post('customer/unfollow',   	['as' => 'customer.unfollow',         		'uses' => 'User\CustomerController@unfollow']);
Route::post('customer/like',   	['as' => 'customer.like',         				'uses' => 'User\CustomerController@like']);
Route::post('customer/unlike',   	['as' => 'customer.unlike',         		'uses' => 'User\CustomerController@unlike']);
Route::get('customer/recipe',   	['as' => 'customer.recipe',         		'uses' => 'User\CustomerController@recipe']);
Route::get('customer/follower',   	['as' => 'customer.follower',         		'uses' => 'User\CustomerController@follower']);
Route::get('customer/following',   	['as' => 'customer.following',         		'uses' => 'User\CustomerController@following']);
Route::get('customer/shop',   	    ['as' => 'customer.shop',         		'uses' => 'User\CustomerController@shop']);
Route::get('customer/shop/{id}',   	['as' => 'customer.shopView',         	'uses' => 'User\CustomerController@shopView']);
Route::post('customer/likeRecipe',  	['as' => 'customer.likeRecipe',         'uses' => 'User\CustomerController@likeRecipe']);
Route::post('customer/unlikeRecipe',  	['as' => 'customer.unlikeRecipe',         'uses' => 'User\CustomerController@unlikeRecipe']);
Route::post('customer/cookRecipe',  	['as' => 'customer.cookRecipe',         'uses' => 'User\CustomerController@cookRecipe']);

Route::get('customer/shoppinglist',   	['as' => 'customer.shoppinglist',         		'uses' => 'User\CustomerController@shoppinglist']);



Route::get('customer/postApply/{id}', ['as' => 'customer.postApply',             'uses' => 'User\CustomerController@postApply']);
Route::post('customer/deleteApply', ['as' => 'customer.deleteApply',           'uses' => 'User\CustomerController@deleteApply']);
Route::post('customer/deleteLike', ['as' => 'customer.deleteLike',           'uses' => 'User\CustomerController@deleteLike']);

Route::get('customer/popular', ['as' => 'customer.popular',                    'uses' => 'User\CustomerController@popular']);
Route::get('customer/profileView/{id}', ['as' => 'customer.viewProfile',                    'uses' => 'User\CustomerController@viewProfile']);
Route::get('customer/profile', ['as' => 'customer.profile',                    'uses' => 'User\CustomerController@profile']);
Route::get('customer/profile/edit', 	['as' => 'user.dashboard.profileEdit', 	'uses' => 'User\CustomerController@profileEdit']);
Route::post('customer/addItem', 	['as' => 'customer.addItem', 	'uses' => 'User\CustomerController@addItem']);

Route::get('profile', 		['as' => 'user.dashboard.profile', 		'uses' => 'User\UserController@profile']);
Route::get('profile/edit', 	['as' => 'user.dashboard.profileEdit', 	'uses' => 'User\UserController@profileEdit']);
Route::get('profile/{etc}', ['as' => 'user.dashboard.profileView', 	'uses' => 'User\UserController@profileView']);
Route::post('saveProfile', 	['as' => 'user.dashboard.saveProfile', 	'uses' => 'User\UserController@saveProfile']);
Route::get('cart', 			['as' => 'user.dashboard.cart', 		'uses' => 'User\UserController@cart']);
Route::get('appliedJobs', 	['as' => 'user.dashboard.appliedJobs', 	'uses' => 'User\UserController@appliedJobs']);
Route::get('user/{id}', 	['as' => 'user.view', 					'uses' => 'User\UserController@view']);
Route::get('post/view/{etc}', ['as' =>'user.post.postView' ,	'uses' => 'User\UserController@postView']);

Route::get('job/{id}', 		['as' => 'user.dashboard.viewJob', 	    'uses' => 'User\JobController@viewJob']);

Route::group(['prefix' => 'async'], function () {
	
	Route::post('/apply', 			['as' => 'user.job.async.apply', 				'uses' => 'User\JobController@asyncApply']);
	Route::post('job/checkApply',		['as' => 'user.job.async.checkApply', 			'uses' => 'User\JobController@asyncCheckApply']);
	Route::post('job/addToCart', 		['as' => 'user.job.async.addToCart', 			'uses' => 'User\JobController@asyncAddToCart']);
	Route::post('job/add/hint', 		['as' => 'user.job.async.addHint', 				'uses' => 'User\JobController@asyncAddHint']);
	Route::post('job/send/message', 	['as' => 'user.job.async.sendMessage', 			'uses' => 'User\JobController@asyncSendMessage']);	
	Route::post('job/removeFromCart',	['as' => 'user.job.async.removeFromCart',		'uses' => 'User\JobController@asyncRemoveFromCart']);
	
	Route::post('company/add/review', 	['as' => 'user.company.async.addReview', 		'uses' => 'User\CompanyController@asyncAddReview']);
	
});
Route::group(['prefix' => 'customer'], function () {
	Route::get('/login', 				['as' => 'user.customer.login',   'uses' => 'User\CustomerController@login']);
	Route::get('/singUp',				['as' => 'user.customer.signup',  'uses' => 'User\CustomerController@signup']);
	Route::post('/signin',   			['as' => 'user.customer.signin',  'uses' => 'User\CustomerController@signin']);
	Route::get('/signup',   			['as' => 'user.customer.signup',   'uses' => 'User\CustomerController@signup']);
	Route::post('/doSignup',   			['as' => 'user.customer.doSignup', 'uses' => 'User\CustomerController@doSignup']);
	Route::get('/chat/{etc}',   		['as' => 'user.customer.chat',     'uses' => 'User\CustomerController@chat']);

});



Route::group(['prefix' => 'admin'], function () {
    
    Route::get('/',         ['as' => 'admin.auth',         'uses' => 'Admin\AdminController@index']);
    Route::get('login',     ['as' => 'admin.auth.login',   'uses' => 'Admin\AdminController@login']);
    Route::post('signin',   ['as' => 'admin.auth.signin',  'uses' => 'Admin\AdminController@signin']);
    Route::get('signout',   ['as' => 'admin.auth.signout', 'uses' => 'Admin\AdminController@signout']);
    
    Route::get('dashboard', ['as' => 'admin.dashboard',    'uses' => 'Admin\DashboardController@index']);
	
	Route::group(['prefix' => 'location'], function () {		
		Route::get('/',           ['as' => 'admin.location',         'uses' => 'Admin\LocationController@index']);
		Route::get('create',      ['as' => 'admin.location.create',  'uses' => 'Admin\LocationController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.location.edit',    'uses' => 'Admin\LocationController@edit']);
		Route::post('store',      ['as' => 'admin.location.store',   'uses' => 'Admin\LocationController@store']);
		Route::get('delete/{id}', ['as' => 'admin.location.delete',  'uses' => 'Admin\LocationController@delete']);
	});
	
	Route::group(['prefix' => 'post'], function () {
		Route::get('/',           ['as' => 'admin.post',         'uses' => 'Admin\PostController@index']);
		Route::get('create',      ['as' => 'admin.post.create',  'uses' => 'Admin\PostController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.post.edit',    'uses' => 'Admin\PostController@edit']);
		Route::post('store',      ['as' => 'admin.post.store',   'uses' => 'Admin\PostController@store']);
		Route::get('delete/{id}', ['as' => 'admin.post.delete',  'uses' => 'Admin\PostController@delete']);
	});
    
    Route::group(['prefix' => 'product'], function () {
        Route::get('/',           ['as' => 'admin.product',         'uses' => 'Admin\ProductController@index']);
        Route::get('search',     ['as' => 'admin.product.search',  'uses' => 'Admin\ProductController@search']);
        Route::get('create',      ['as' => 'admin.product.create',  'uses' => 'Admin\ProductController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.product.edit',    'uses' => 'Admin\ProductController@edit']);
        Route::post('store',      ['as' => 'admin.product.store',   'uses' => 'Admin\ProductController@store']);
        Route::get('delete/{id}', ['as' => 'admin.product.delete',  'uses' => 'Admin\ProductController@delete']);
    });
	
	Route::group(['prefix' => 'service'], function () {
		Route::get('/',           ['as' => 'admin.service',         'uses' => 'Admin\ServiceController@index']);
		Route::get('create',      ['as' => 'admin.service.create',  'uses' => 'Admin\ServiceController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.service.edit',    'uses' => 'Admin\ServiceController@edit']);
		Route::post('store',      ['as' => 'admin.service.store',   'uses' => 'Admin\ServiceController@store']);
		Route::get('delete/{id}', ['as' => 'admin.service.delete',  'uses' => 'Admin\ServiceController@delete']);
	});
	
	Route::group(['prefix' => 'teamsize'], function () {
		Route::get('/',           ['as' => 'admin.teamsize',         'uses' => 'Admin\TeamsizeController@index']);
		Route::get('create',      ['as' => 'admin.teamsize.create',  'uses' => 'Admin\TeamsizeController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.teamsize.edit',    'uses' => 'Admin\TeamsizeController@edit']);
		Route::post('store',      ['as' => 'admin.teamsize.store',   'uses' => 'Admin\TeamsizeController@store']);
		Route::get('delete/{id}', ['as' => 'admin.teamsize.delete',  'uses' => 'Admin\TeamsizeController@delete']);
	});
	
	Route::group(['prefix' => 'language'], function () {
		Route::get('/',           ['as' => 'admin.language',         'uses' => 'Admin\LanguageController@index']);
		Route::get('create',      ['as' => 'admin.language.create',  'uses' => 'Admin\LanguageController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.language.edit',    'uses' => 'Admin\LanguageController@edit']);
		Route::post('store',      ['as' => 'admin.language.store',   'uses' => 'Admin\LanguageController@store']);
		Route::get('delete/{id}', ['as' => 'admin.language.delete',  'uses' => 'Admin\LanguageController@delete']);
	});
	
	Route::group(['prefix' => 'company'], function () {
		Route::get('/',           ['as' => 'admin.company',         'uses' => 'Admin\CompanyController@index']);
		Route::get('create',      ['as' => 'admin.company.create',  'uses' => 'Admin\CompanyController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.company.edit',    'uses' => 'Admin\CompanyController@edit']);
		Route::post('store',      ['as' => 'admin.company.store',   'uses' => 'Admin\CompanyController@store']);
		Route::get('delete/{id}', ['as' => 'admin.company.delete',  'uses' => 'Admin\CompanyController@delete']);
	});
	
	Route::group(['prefix' => 'business'], function () {
		Route::get('/',           ['as' => 'admin.business',         'uses' => 'Admin\BusinessController@index']);
		Route::get('create',      ['as' => 'admin.business.create',  'uses' => 'Admin\BusinessController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.business.edit',    'uses' => 'Admin\BusinessController@edit']);
		Route::post('store',      ['as' => 'admin.business.store',   'uses' => 'Admin\BusinessController@store']);
		Route::get('delete/{id}', ['as' => 'admin.business.delete',  'uses' => 'Admin\BusinessController@delete']);
	});
	
	Route::group(['prefix' => 'user'], function () {
		Route::get('/',           ['as' => 'admin.user',         'uses' => 'Admin\UserController@index']);
		Route::get('create',      ['as' => 'admin.user.create',  'uses' => 'Admin\UserController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.user.edit',    'uses' => 'Admin\UserController@edit']);
		Route::post('store',      ['as' => 'admin.user.store',   'uses' => 'Admin\UserController@store']);
		Route::get('delete/{id}', ['as' => 'admin.user.delete',  'uses' => 'Admin\UserController@delete']);
	});
    
    Route::group(['prefix' => 'customer'], function () {
        Route::get('/',           ['as' => 'admin.customer',         'uses' => 'Admin\CustomerController@index']);
        Route::get('create',      ['as' => 'admin.customer.create',  'uses' => 'Admin\CustomerController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.customer.edit',    'uses' => 'Admin\CustomerController@edit']);
        Route::post('store',      ['as' => 'admin.customer.store',   'uses' => 'Admin\CustomerController@store']);
        Route::get('delete/{id}', ['as' => 'admin.customer.delete',  'uses' => 'Admin\CustomerController@delete']);
    });
	
	Route::group(['prefix' => 'category'], function () {
		Route::get('/',           ['as' => 'admin.category',         'uses' => 'Admin\CategoryController@index']);
		Route::get('create',      ['as' => 'admin.category.create',  'uses' => 'Admin\CategoryController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.category.edit',    'uses' => 'Admin\CategoryController@edit']);
		Route::post('store',      ['as' => 'admin.category.store',   'uses' => 'Admin\CategoryController@store']);
		Route::get('delete/{id}', ['as' => 'admin.category.delete',  'uses' => 'Admin\CategoryController@delete']);
		Route::get('view/{name}', ['as' => 'user.category.view',  	 'uses' => 'User\CategoryController@view']);
	});
    
    Route::group(['prefix' => 'recipe'], function () {
        Route::get('/',           ['as' => 'admin.recipe',         'uses' => 'Admin\RecipeController@index']);
        Route::get('create',      ['as' => 'admin.recipe.create',  'uses' => 'Admin\RecipeController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.recipe.edit',    'uses' => 'Admin\RecipeController@edit']);
        Route::post('store',      ['as' => 'admin.recipe.store',   'uses' => 'Admin\RecipeController@store']);
        Route::get('delete/{id}', ['as' => 'admin.recipe.delete',  'uses' => 'Admin\RecipeController@delete']);
        Route::get('view/{name}', ['as' => 'admin.recipe.view',       'uses' => 'Admin\RecipeController@view']);
        Route::get('viewIngredient/{id}', ['as' => 'admin.recipe.viewIngredient',       'uses' => 'Admin\RecipeController@viewIngredient']);   
        
    });
    
    Route::group(['prefix' => 'ingredient'], function () {
        
        Route::get('/',           ['as' => 'admin.ingredient',         'uses' => 'Admin\IngredientController@index']);
        Route::get('create/{id}', ['as' => 'admin.ingredient.create',  'uses' => 'Admin\IngredientController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.ingredient.edit',    'uses' => 'Admin\IngredientController@edit']);
        Route::post('store',      ['as' => 'admin.ingredient.store',   'uses' => 'Admin\IngredientController@store']);
        Route::get('delete/{id}', ['as' => 'admin.ingredient.delete',  'uses' => 'Admin\IngredientController@delete']);
        Route::get('view/{name}', ['as' => 'admin.ingredient.view',    'uses' => 'Admin\IngredientController@view']);
    });
    
    Route::group(['prefix' => 'ingredientRecipt'], function () {
        
        Route::get('/',           ['as' => 'admin.ingredientRecipt',         'uses' => 'Admin\IngredientReciptController@index']);
        Route::get('create/{id}', ['as' => 'admin.ingredientRecipt.create',  'uses' => 'Admin\IngredientReciptController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.ingredientRecipt.edit',    'uses' => 'Admin\IngredientReciptController@edit']);
        Route::post('store',      ['as' => 'admin.ingredientRecipt.store',   'uses' => 'Admin\IngredientReciptController@store']);
        Route::get('delete/{id}', ['as' => 'admin.ingredientRecipt.delete',  'uses' => 'Admin\IngredientReciptController@delete']);
        Route::get('view/{name}', ['as' => 'admin.ingredientRecipt.view',    'uses' => 'Admin\IngredientReciptController@view']);
        Route::get('viewIngredient/{id}', ['as' => 'admin.ingredientRecipt.viewIngredient',       'uses' => 'Admin\RecipeController@viewIngredient']);  
    });
    
    
    Route::group(['prefix' => 'apply'], function () {
        Route::get('/',           ['as' => 'admin.apply',         'uses' => 'Admin\ApplyController@index']);
        Route::get('create',      ['as' => 'admin.apply.create',  'uses' => 'Admin\ApplyController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.apply.edit',    'uses' => 'Admin\ApplyController@edit']);
        Route::post('store',      ['as' => 'admin.apply.store',   'uses' => 'Admin\ApplyController@store']);
        Route::get('delete/{id}', ['as' => 'admin.apply.delete',  'uses' => 'Admin\ApplyController@delete']);
        Route::get('view/{name}', ['as' => 'admin.apply.view',    'uses' => 'Admin\ApplyController@view']);
        
    });
    
    Route::group(['prefix' => 'recipt'], function () {
        Route::get('/',           ['as' => 'admin.recipt',         'uses' => 'Admin\ReciptController@index']);
        Route::get('create',      ['as' => 'admin.recipt.create',  'uses' => 'Admin\ReciptController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.recipt.edit',    'uses' => 'Admin\ReciptController@edit']);
        Route::post('store',      ['as' => 'admin.recipt.store',   'uses' => 'Admin\ReciptController@store']);
        Route::get('delete/{id}', ['as' => 'admin.recipt.delete',  'uses' => 'Admin\ReciptController@delete']);
        Route::get('view/{name}', ['as' => 'admin.recipt.view',    'uses' => 'Admin\ReciptController@view']);
        Route::get('viewIngredient/{id}', ['as' => 'admin.recipt.viewIngredient',  'uses' => 'Admin\ReciptController@viewIngredient']);  
        
    });
    
    Route::group(['prefix' => 'recipeApply'], function () {
        Route::get('/',           ['as' => 'admin.recipeApply',         'uses' => 'Admin\RecipeApplyController@index']);
        Route::get('create',      ['as' => 'admin.recipeApply.create',  'uses' => 'Admin\RecipeApplyController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.recipeApply.edit',    'uses' => 'Admin\RecipeApplyController@edit']);
        Route::post('store',      ['as' => 'admin.recipeApply.store',   'uses' => 'Admin\RecipeApplyController@store']);
        Route::get('delete/{id}', ['as' => 'admin.recipeApply.delete',  'uses' => 'Admin\RecipeApplyController@delete']);
        Route::get('view/{name}', ['as' => 'admin.recipeApply.view',    'uses' => 'Admin\RecipeApplyController@view']);
        
    });
    
    Route::group(['prefix' => 'store'], function () {
        Route::get('/',           ['as' => 'admin.store',         'uses' => 'Admin\StoreController@index']);
        Route::get('create',      ['as' => 'admin.store.create',  'uses' => 'Admin\StoreController@create']);
        Route::get('edit/{id}',   ['as' => 'admin.store.edit',    'uses' => 'Admin\StoreController@edit']);
        Route::post('store',      ['as' => 'admin.store.store',   'uses' => 'Admin\StoreController@store']);
        Route::get('delete/{id}', ['as' => 'admin.store.delete',  'uses' => 'Admin\StoreController@delete']);
        Route::get('view/{name}', ['as' => 'admin.store.view',     'uses' => 'Admin\StoreController@view']);
    });
    
	
	Route::group(['prefix' => 'level'], function () {
		Route::get('/',           ['as' => 'admin.level',         'uses' => 'Admin\LevelController@index']);
		Route::get('create',      ['as' => 'admin.level.create',  'uses' => 'Admin\LevelController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.level.edit',    'uses' => 'Admin\LevelController@edit']);
		Route::post('store',      ['as' => 'admin.level.store',   'uses' => 'Admin\LevelController@store']);
		Route::get('delete/{id}', ['as' => 'admin.level.delete',  'uses' => 'Admin\LevelController@delete']);
	});
	
	Route::group(['prefix' => 'type'], function () {
		Route::get('/',           ['as' => 'admin.type',         'uses' => 'Admin\TypeController@index']);
		Route::get('create',      ['as' => 'admin.type.create',  'uses' => 'Admin\TypeController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.type.edit',    'uses' => 'Admin\TypeController@edit']);
		Route::post('store',      ['as' => 'admin.type.store',   'uses' => 'Admin\TypeController@store']);
		Route::get('delete/{id}', ['as' => 'admin.type.delete',  'uses' => 'Admin\TypeController@delete']);
	});
	
	Route::group(['prefix' => 'presence'], function () {
		Route::get('/',           ['as' => 'admin.presence',         'uses' => 'Admin\PresenceController@index']);
		Route::get('create',      ['as' => 'admin.presence.create',  'uses' => 'Admin\PresenceController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.presence.edit',    'uses' => 'Admin\PresenceController@edit']);
		Route::post('store',      ['as' => 'admin.presence.store',   'uses' => 'Admin\PresenceController@store']);
		Route::get('delete/{id}', ['as' => 'admin.presence.delete',  'uses' => 'Admin\PresenceController@delete']);
	});
	
	Route::group(['prefix' => 'job'], function () {
		Route::get('/',           ['as' => 'admin.job',         'uses' => 'Admin\JobController@index']);
		Route::get('create',      ['as' => 'admin.job.create',  'uses' => 'Admin\JobController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.job.edit',    'uses' => 'Admin\JobController@edit']);
		Route::post('store',      ['as' => 'admin.job.store',   'uses' => 'Admin\JobController@store']);
		Route::get('delete/{id}', ['as' => 'admin.job.delete',  'uses' => 'Admin\JobController@delete']);
	});
	
	Route::group(['prefix' => 'pattern'], function () {
		Route::get('/',           ['as' => 'admin.pattern',         'uses' => 'Admin\PatternController@index']);
		Route::get('create',      ['as' => 'admin.pattern.create',  'uses' => 'Admin\PatternController@create']);
		Route::get('edit/{id}',   ['as' => 'admin.pattern.edit',    'uses' => 'Admin\PatternController@edit']);
		Route::post('store',      ['as' => 'admin.pattern.store',   'uses' => 'Admin\PatternController@store']);
		Route::get('delete/{id}', ['as' => 'admin.pattern.delete',  'uses' => 'Admin\PatternController@delete']);
	});
});

Route::group(['prefix' => 'company'], function () {

	Route::get('/',             ['as' => 'company.dashboard',       'uses' => 'Company\CompanyController@index']);
	Route::get('/{id}', 		['as' => 'company.view', 		    'uses' => 'Company\CompanyController@view']);
	Route::get('profile', 		['as' => 'company.profile', 		'uses' => 'Company\CompanyController@profile']);
	Route::post('saveProfile',  ['as' => 'company.saveProfile', 	'uses' => 'Company\CompanyController@saveProfile']);
	
	
	Route::get('signup',		['as' => 'company.auth.signup',     'uses' => 'Company\AuthController@signup']);
	Route::post('doSignup', 	['as' => 'company.auth.doSignup',   'uses' => 'Company\AuthController@doSignup']);
	Route::get('login',         ['as' => 'company.auth.login',      'uses' => 'Company\AuthController@login']);
	Route::post('doLogin',      ['as' => 'company.auth.doLogin',    'uses' => 'Company\AuthController@doLogin']);
	Route::get('doLogout',      ['as' => 'company.auth.doLogout',   'uses' => 'Company\AuthController@doLogout']);
	
	Route::get('addjob', 		['as' => 'company.job.add', 		'uses' => 'Company\JobController@add']);
	Route::post('doAddJob',		['as' => 'company.job.doAddJob', 	'uses' => 'Company\JobController@doAdd']);
	Route::get('myjobs/{id?}',  ['as' => 'company.job.myjobs', 		'uses' => 'Company\JobController@myJobs']);
	Route::get('job/{id}', 		['as' => 'company.job.view', 		'uses' => 'Company\JobController@view']);
	
	
	Route::group(['prefix' => 'async'], function () {
		Route::post('job/save/notes', 		['as' => 'company.job.async.saveNotes', 		'uses' => 'Company\JobController@asyncSaveNotes']);
		Route::post('job/hint/save/notes', 	['as' => 'company.job.async.saveHintNotes', 	'uses' => 'Company\JobController@asyncSaveHintNotes']);
		Route::post('job/user/send/message',['as' => 'company.job.async.sendMessage', 		'uses' => 'Company\JobController@asyncSendMessage']);
		Route::post('job/hint/send/message',['as' => 'company.job.async.sendHintMessage',	'uses' => 'Company\JobController@asyncSendMessageHint']);
		
		Route::post('user/update/status', 	['as' => 'company.user.async.updateStatus', 	'uses' => 'Company\UserController@asyncUpdateStatus']);
	});
});