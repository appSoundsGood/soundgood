<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, Response, Mail;
use Job as JobModel;
use User as UserModel;
use Category as CategoryModel;
use Company as CompanyModel;
use JobSkill as JobSkillModel;
use Type as TypeModel;
use Apply as ApplyModel;
use Cart as CartModel;
use JobRecommend as JobRecommendModel;
use Pattern as PatternModel;

class JobController extends \BaseController {
	
	public function home($id = 0) {
		$param['pageNo'] = 0;
		if ($alert = Session::get('alert')) {
			$param['alert'] = $alert;
		}
	
		if ($id == 0) {
			$param['jobs'] = JobModel::paginate(PAGINATION_SIZE);
		} else {
			$param['jobs'] = JobModel::where('category_id', $id)->paginate(PAGINATION_SIZE);
		}

		if (Session::has('user_id')) {
			$param['user'] = UserModel::find(Session::get('user_id'));
		}
	
		$param['category'] = $id;
		$param['categories'] = CategoryModel::all();
		$param['patterns'] = PatternModel::all();
		
		return View::make('user.job.home')->with($param);
	}
	
	public function viewJob($id) {
		
		$param['job'] = JobModel::find($id);
		$param['jobSkills'] = JobSkillModel::where('job_id', $id)->get();
		$param['patterns'] = PatternModel::all();
		
		if (Session::has('user_id')) {
			$param['userId'] = Session::get('user_id');
		}
		
		$job = JobModel::find($id);
		$job->views = $job->views + 1;		
		$job->save();
		
		return View::make('user.job.view')->with($param);
	}
	
	public function search() {
		$param['pageNo'] = 1;
		
		$param['category_id'] = Input::has('category_id') ? Input::get('category_id') : '';
		$param['category_name'] = Input::has('category_name') ? Input::get('category_name') : '';
		$param['type_id'] = Input::has('type_id') ? Input::get('type_id') : '';
		$param['created_at'] = Input::has('created_at') ? Input::get('created_at') : '';
		$param['company_name'] = Input::has('company_name') ? Input::get('company_name') : '';
		$param['budget_min'] = Input::has('min') ? Input::get('min') : BUDGET_MIN;
		$param['budget_max'] = Input::has('max') ? Input::get('max') : BUDGET_MAX;
		$param['skill_name'] = Input::has('skill_name') ? Input::get('skill_name') : '';
	
		$result = JobModel::whereRaw(true);
	
		if ($param['category_id'] != '') {
			$result = $result->where('category_id', '=', $param['category_id']);
		}
		
		if ($param['category_name'] != '') {
			$categories = CategoryModel::where('name', 'like', '%'.$param['category_name'].'%')->get();
			$categoryIds = array();
			$categoryIds[] = 0;
			foreach($categories as $category) {
				$categoryIds[] = $category->id;
			}
			$result = $result->whereIn('category_id', $categoryIds);			
		}
		
		
		if ($param['type_id'] != '') {
			$result = $result->where('type_id', '=', $param['type_id']);
		}
		
		if ($param['company_name'] != '') {
			$companies = CompanyModel::where('name', 'like', '%'.$param['company_name'].'%')->get();
			$companyIds = array();
			$companyIds[] = 0;
			foreach($companies as $company) {
				$companyIds[] = $company->id;
			}
			$result = $result->whereIn('company_id', $companyIds);
		}
		
		if ($param['created_at'] != '') {
			$result = $result->where('created_at', '>=', $param['created_at']." 00:00:00");
		}
		
		if ($param['budget_min'] != '') {
			$result = $result->where('salary', '>=', $param['budget_min']);
		}
		
		if ($param['budget_max'] != '') {
			$result = $result->where('salary', '<=', $param['budget_max']);
		}
		
		if ($param['skill_name'] != '') {
			$skills = JobSkillModel::where('name', 'like', '%'.$param['skill_name'].'%')->get();
			$jobIds = array();
			$jobIds[] = 0;
			foreach ($skills as $skill) {
				$jobIds[] = $skill->job_id;
			}
			$result = $result->whereIn('id', $jobIds);
		}
	
		if (Session::has('user_id')) {
			$param['user'] = UserModel::find(Session::get('user_id'));
		}
		
		$jobs = $result->paginate(PAGINATION_SIZE);
		$param['jobs'] = $jobs;
		$param['categories'] = CategoryModel::all();
		$param['types'] = TypeModel::all();
		$param['patterns'] = PatternModel::all();
		
	
		return View::make('user.job.search')->with($param);
	}

	
	
	
	
	
	/* Functions for ajax */
	public function asyncCheckApply() {
		if (Session::has('user_id')) {
			if (Input::has('job_id')) {
				$jobId = Input::get('job_id');
				$userId = Session::get('user_id');
				$status = ApplyModel::where('job_id', $jobId)->where('user_id', $userId)->count();
	
				if ($status == 0) {
					return Response::json(['result' => 'success', 'msg' => 'You have been successfully apply']);
				} else {
					return Response::json(['result' => 'failed', 'msg' => 'You have already apply to this job', 'code' => 'CD00']);
				}
			} else {
				return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
			}
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for apply', 'code' => 'CD01']);
		}
	}
	
	public function asyncApply() {
		if (Input::has('job_id')) {
			$jobId = Input::get('job_id');
			$userId = Session::get('user_id');
			$name = Input::get('name');
			$description = Input::get('description');
	
			$apply = new ApplyModel;
				
			$apply->user_id = $userId;
			$apply->job_id = $jobId;
			$apply->name = $name;
			$apply->description = $description;
			$apply->notes = '';
				
			$apply->save();
				
			CartModel::where('user_id', $userId)->where('job_id', $jobId)->delete();
				
			return Response::json(['result' => 'success', 'msg' => 'You have been successfully apply.']);
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
		}
	}
	
	public function asyncAddToCart() {
		if (Session::has('user_id')) {
			if (Input::has('job_id')) {
				$jobId = Input::get('job_id');
				$userId = Session::get('user_id');
				$status_cart = CartModel::where('job_id', $jobId)->where('user_id', $userId)->count();
				$status_apply = ApplyModel::where('job_id', $jobId)->where('user_id', $userId)->count();
	
				if ($status_cart != 0) {
					return Response::json(['result' => 'failed', 'msg' => 'This job is already added to application cart', 'code' => 'CD00']);
				}else if ($status_apply != 0) {
					return Response::json(['result' => 'failed', 'msg' => 'You have already apply to this job', 'code' => 'CD00']);
				}else {
					$cart = new CartModel;
	
					$cart->user_id = $userId;
					$cart->job_id = $jobId;
	
					$cart->save();
	
					return Response::json(['result' => 'success', 'msg' => 'This job have been successfully added to application cart']);
				}
			} else {
				return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
			}
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for add to application cart', 'code' => 'CD01']);
		}
	}
	
	public function asyncRemoveFromCart() {
		if (Session::has('user_id')) {
			if (Input::has('cart_id')) {
				$cartId = Input::get('cart_id');
				CartModel::find($cartId)->delete();
		
				return Response::json(['result' => 'success', 'msg' => 'This job have been removed from your application cart']);
			} else {
				return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
			}
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for remove job', 'code' => 'CD01']);
		}		
	}
	
	public function asyncAddHint() {
		if (Session::has('user_id')) {
			if (Input::has('job_id')) {
				$jobId = Input::get('job_id');
				$userId = Session::get('user_id');
				$name = Input::has('name') ? Input::get('name') : '';
				$phonenumber = Input::has('phonenumber') ? Input::get('phonenumber') : '';
				$email = Input::has('email') ? Input::get('email') : '';
				$currentJob = Input::has('currentJob') ? Input::get('currentJob') : '';
				$previousJobs = Input::has('previousJobs') ? Input::get('previousJobs') : '';
				$description = Input::has('description') ? Input::get('description') : '';
	
				$recommend = new JobRecommendModel;
	
				$recommend->user_id = $userId;
				$recommend->job_id = $jobId;
				$recommend->name = $name;
				$recommend->phone = $phonenumber;
				$recommend->email = $email;
				$recommend->currentJob = $currentJob;
				$recommend->previousJobs = $previousJobs;
				$recommend->description = $description;
	
				$recommend->save();
	
				return Response::json(['result' => 'success', 'msg' => 'Your hint was submitted successfully.']);
					
			} else {
				return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
			}
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for add to application cart', 'code' => 'CD01']);
		}
	}
	
	
	public function asyncSendMessage() {		
		if (Session::has('user_id')) {
			$jobId = Input::get('job_id');
			$message_data = Input::get('message');
		
			$job = JobModel::find($jobId);
		
			$user = array(
					'email'=> $job->company->email,
					'username'=> $job->company->name,
			);
		
			Mail::send('user.mails.message', array('job_link' => HTTP_PATH.'job/'.$job->id, 'content' => $message_data, 'user_link' => HTTP_PATH.'user/'.Session::get('user_id')), function($message) use($user)
			{
				$message->to($user['email'], $user['username'])->subject('SocialHeadHunter');
			});
		
			return Response::json(['result' => 'success', 'msg' => 'Message has been sent successfully.']);
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for add to application cart', 'code' => 'CD01']);
		}
	}
	
}
