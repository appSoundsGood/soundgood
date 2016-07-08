<?php namespace Company;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, Response, Mail;

use Company as CompanyModel;
use City as CityModel;
use Category as CategoryModel;
use Teamsize as TeamsizeModel;
use Service as ServiceModel;
use CompanyService as CompanyserviceModel;
use Apply as ApplyModel;
use JobRecommend as JobRecommendModel;

use Job as JobModel;
use Level as LevelModel;
use Language as LanguageModel;
use Type as TypeModel;
use Presence as PresenceModel;
use Benefits as BenefitsModel;
use JobSkill as JobSkillModel;
use JobLanguage as JobLanguageModel;


class JobController extends \BaseController {
	
	public function index() {
		
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['pageNo'] = 3;	
			return View::make('company.dashboard.home')->with($param);			
		}
	}
	
	public function view($id) {
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['company'] = CompanyModel::find(Session::get('company_id'));
			$param['job'] = JobModel::find($id);
			
			return View::make('company.job.view')->with($param);
		}		
	}
	
	
	public function add() {
		
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['pageNo'] = 1;
			
			$param['company_id'] = Session::get('company_id');
			$param['companies'] = CompanyModel::all();
			$param['categories'] = CategoryModel::all();
			$param['presences'] = PresenceModel::all();
			$param['cities'] = CityModel::all();
			$param['languages'] = LanguageModel::all();
			$param['types'] = TypeModel::all();
			$param['levels'] = LevelModel::all();
			
			if ($alert = Session::get('alert')) {
				$param['alert'] = $alert;
			}
			
			return View::make('company.job.add')->with($param);			
		}
	}
	
	public function doAdd() {
		$rules = ['name' => 'required',
				  'email' => 'required|email',
				  'phone' => 'required',
				  'description' => 'required',
				  'year' => 'numeric',
				  'salary' => 'required|numeric'
				];
		
		$validator = Validator::make(Input::all(), $rules);
		 
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		} else {
		
			$jobId = 0;
			$is_published = 0;
			$is_name = 1;
			$is_phonenumber = 0;
			$is_email = 1;
			$is_currentjob = 0;
			$is_previousjobs = 0;
			$is_description = 1;
		
			if (Input::has('is_published')) {
				$is_published = Input::get('is_published');
			}
		
			if (Input::has('is_name')) {
				$is_name = Input::get('is_name');
			}
		
			if (Input::has('is_phonenumber')) {
				$is_phonenumber = Input::get('is_phonenumber');
			}
		
			if (Input::has('is_email')) {
				$is_email = Input::get('is_email');
			}
		
			if (Input::has('is_currentjob')) {
				$is_currentjob = Input::get('is_currentjob');
			}
		
			if (Input::has('is_previousjobs')) {
				$is_previousjobs = Input::get('is_previousjobs');
			}
		
			if (Input::has('is_description')) {
				$is_description = Input::get('is_description');
			}
		
			$job = new JobModel;
		
			$job->company_id = Input::get('company_id');
			$job->name = Input::get('name');
			$job->level_id = Input::get('level_id');
			$job->description = Input::get('description');
			$job->category_id = Input::get('category_id');
			$job->presence_id = Input::get('presence_id');
			$job->year = Input::get('year');
			$job->city_id = Input::get('city_id');
			$job->native_language_id = Input::get('native_language_id');
			$job->requirements = Input::get('requirements');
			$job->is_name = $is_name;
			$job->is_phonenumber = $is_phonenumber;
			$job->is_email = $is_email;
			$job->is_currentjob = $is_currentjob;
			$job->is_previousjobs = $is_previousjobs;
			$job->is_description = $is_description;
			$job->bonus = Input::get('bonus');
			$job->type_id = Input::get('type_id');
			$job->salary = Input::get('salary');
			$job->email = Input::get('email');
			$job->phone = Input::get('phone');
			$job->lat = Input::get('lat');
			$job->long = Input::get('lng');
			$job->is_finished = Input::get('is_finished');
			$job->salary = Input::get('salary');
			$job->paid_after = Input::get('paid_after');
			$job->bonus_description = Input::get('bonus_description');
			 
			$job->save();
		
			if ($jobId == 0) $jobId = $job->id;
		
		
			//save Benefit Names
		
			if (Input::has('benefit_name')) {
				BenefitsModel::where('job_id', $jobId)->delete();
				 
				foreach (Input::get('benefit_name') as $bname) {
		
					$benefits = new BenefitsModel;
		
					$benefits->job_id = $jobId;
					$benefits->name = $bname;
					 
					$benefits->save();
				}
			}
		
			//save Job Skills
			if (Input::has('skill_name')) {
				$count = 0;
				 
				foreach (Input::get('skill_name') as $sname) {
					 
					$jobskill = new JobSkillModel;
					 
					$jobskill->job_id = $jobId;
					$jobskill->name = $sname;
					$jobskill->value = Input::get('skill_value')[$count];
					 
					$jobskill->save();
		
					$count ++;
				}
			}
		
		
			//save Job Foreign Language
			if (Input::has('foreign_language_id')) {
				$count = 0;
				 
				foreach (Input::get('foreign_language_id') as $lid) {
					 
					$joblanguage = new JobLanguageModel;
					 
					$joblanguage->job_id = $jobId;
					$joblanguage->language_id = $lid;
					$joblanguage->understanding = Input::get('understanding')[$count];
					$joblanguage->speaking = Input::get('speaking')[$count];
					$joblanguage->writing = Input::get('writing')[$count];
					$joblanguage->name = '';
					 
					$joblanguage->save();
					 
					$count ++;
				}
			}
		
		
			$alert['msg'] = 'Job has been saved successfully';
			$alert['type'] = 'success';
		
			return Redirect::route('company.job.add')->with('alert', $alert);
		}
	}
	
	public function myJobs($id = 0) {
		
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['pageNo'] = 2;
			if ($alert = Session::get('alert')) {
				$param['alert'] = $alert;
			}
			
			if ($id == 0) {
				$param['jobs'] = JobModel::where('company_id', Session::get('company_id'))->paginate(PAGINATION_SIZE);
			} else {
				$param['jobs'] = JobModel::where('company_id', Session::get('company_id'))->where('category_id', $id)->paginate(PAGINATION_SIZE);
			}
			$param['category'] = $id;
			$param['categories'] = CategoryModel::all();
			
			return View::make('company.job.myjobs')->with($param);			
		}	
	}
	
	
	
	
	/* Functions for ajax */
	
	public function asyncSaveNotes() {
		
		$applyId = Input::get('apply_id');
		$notes = Input::get('notes');
		
		$apply = ApplyModel::find($applyId);
		
		$apply->notes = $notes;
		$apply->save();
		
		return Response::json(['result' => 'success', 'msg' => 'Notes has been saved successfully.']);
		
	}
	
	public function asyncSaveHintNotes() {
	
		$hintId = Input::get('hint_id');
		$notes = Input::get('notes');
	
		$hint = JobRecommendModel::find($hintId);
	
		$hint->notes = $notes;
		$hint->save();
	
		return Response::json(['result' => 'success', 'msg' => 'Notes has been saved successfully.']);
	
	}
	
	public function asyncSendMessage() {

		$applyId = Input::get('apply_id');
		$message_data = Input::get('message');
		
		$apply = ApplyModel::find($applyId);
		
		$user = array(
				'email'=> $apply->user->email,
				'username'=> $apply->user->name,
		);
		
		Mail::send('company.mails.message', array('job_link' => HTTP_PATH.'job/'.$apply->job->id, 'content' => $message_data), function($message) use($user)
		{
			$message->to($user['email'], $user['username'])->subject('SocialHeadHunter');
		});
		
		return Response::json(['result' => 'success', 'msg' => 'Message has been sent successfully.']);
	}
	
	public function asyncSendMessageHint() {
	
		$hintId = Input::get('hint_id');
		$message_data = Input::get('message');
	
		$hint = JobRecommendModel::find($hintId);
	
		$user = array(
				'email'=> $hint->user->email,
				'username'=> $hint->user->name,
		);
	
		Mail::send('company.mails.message', array('job_link' => HTTP_PATH.'job/'.$hint->job->id, 'content' => $message_data), function($message) use($user)
		{
			$message->to($user['email'], $user['username'])->subject('SocialHeadHunter');
		});
	
		return Response::json(['result' => 'success', 'msg' => 'Message has been sent successfully.']);
	}
}
