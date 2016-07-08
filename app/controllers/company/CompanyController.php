<?php namespace Company;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator;

use Company as CompanyModel;
use City as CityModel;
use Category as CategoryModel;
use Teamsize as TeamsizeModel;
use Service as ServiceModel;
use CompanyService as CompanyserviceModel;


use Job as JobModel;
use Level as LevelModel;
use Language as LanguageModel;
use Type as TypeModel;
use Presence as PresenceModel;
use Benefits as BenefitsModel;
use JobSkill as JobSkillModel;
use JobLanguage as JobLanguageModel;


class CompanyController extends \BaseController {
	
	public function view($id) {
	
		$param['company'] = CompanyModel::find($id);
		
		if (Session::has('user_id')) {
			$param['userId'] = Session::get('user_id');
		}
	
		return View::make('company.dashboard.view')->with($param);
	}
	
	public function index() {
		
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['pageNo'] = 3;	
			return View::make('company.dashboard.home')->with($param);			
		}
	}
	
	
	public function addJob() {
		
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
	
	public function doAddJob() {
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
			$is_name = 0;
			$is_phonenumber = 0;
			$is_email = 0;
			$is_currentjob = 0;
			$is_previousjobs = 0;
			$is_description = 0;
		
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
	
	public function myjobs($id = 0) {
		
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
	
	public function profile() {
		if (!Session::has('company_id')) {
			return Redirect::route('company.auth.login');
		}else {
			$param['pageNo'] = 4;
			$param['company'] = CompanyModel::find(Session::get('company_id'));
			$param['cities'] = CityModel::all();
			$param['teamsizes'] = TeamsizeModel::all();
			$param['categories'] = CategoryModel::all();
			$param['services']  = ServiceModel::all();
			$param['companyServices']  = CompanyServiceModel::where('company_id', Session::get('company_id'))->get();
			
			if ($alert = Session::get('alert')) {
				$param['alert'] = $alert;
			}
			
			return View::make('company.dashboard.profile')->with($param);			
		}
	}
	
	public function saveProfile() {

		$rules = ['name' 		=> 'required',
				  'email' 		=> 'required|email',
				  'year' 		=> 'numeric',
				  'service_id'	=> 'required',
				  ];
		
		$validator = Validator::make(Input::all(), $rules);
		 
		if ($validator->fails()) {
			return Redirect::back()
			->withErrors($validator)
			->withInput();
		} else {
			$password = Input::get('password');
			$companyId = 0;
		
			$is_published = 0;
		
			if (Input::has('is_published')) {
				$is_published = Input::get('is_published');
			}
		
			if (Input::has('company_id')) {
				$id = Input::get('company_id');
				$company = CompanyModel::find($id);
				$is_active = Input::get('is_active');
		
				if ($password !== '') {
					$company->secure_key = md5($company->salt.$password);
				}
				$company->is_active = $is_active;
		
				$companyId = $id;
		
			} else {
				$company = new CompanyModel;
		
				if ($password === '') {
					$alert['msg'] = 'You have to enter password';
					$alert['type'] = 'danger';
					return Redirect::route('admin.company.create')->with('alert', $alert);
				}
				$company->salt = str_random(8);
				$company->secure_key = md5($company->salt.$password);
			}
		
			$company->name 			= Input::get('name');
			$company->tag 			= Input::get('tag');
			$company->year 			= Input::get('year');
			$company->teamsize_id 	= Input::get('teamsize_id');
			$company->category_id 	= Input::get('category_id');
			$company->city_id		= Input::get('city_id');
			$company->description 	= Input::get('description');
			$company->expertise 	= Input::get('expertise');
			$company->address 		= Input::get('address');
			$company->email 		= Input::get('email');
			$company->phone 		= Input::get('phone');
			$company->website 		= Input::get('website');
			$company->facebook 		= Input::get('facebook');
			$company->linkedin 		= Input::get('linkedin');
			$company->twitter		= Input::get('twitter');
			$company->google 		= Input::get('google');
			$company->lat 			= Input::get('lat');
			$company->long			= Input::get('lng');
			$company->is_published  = $is_published;
			$company->is_finished 	= 1;
		
			if (Input::hasFile('logo')) {
				$filename = str_random(24).".".Input::file('logo')->getClientOriginalExtension();
				Input::file('logo')->move(ABS_LOGO_PATH, $filename);
				$company->logo = $filename;
			}
		
			$company->save();
		
			if ($companyId == 0) $companyId = $company->id;
		
			$count = 0;
		
			CompanyserviceModel::where('company_id', $companyId)->delete();
		
			foreach (Input::get('service_id') as $sId) {
				
				if ($sId == '') break;
				
				$companyService = new CompanyserviceModel;
				 
				$companyService->company_id = $companyId;
				$companyService->service_id = $sId;
				$companyService->description = Input::get('service_description')[$count];
				 
				$companyService->save();
				$count ++;
			}
		
			$alert['msg'] = 'Profile has been saved successfully';
			$alert['type'] = 'success';
		
			return Redirect::route('company.profile')->with('alert', $alert);
		}
	}

}
