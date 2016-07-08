<?php namespace User;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, Response;

use Company as CompanyModel;
use Review as ReviewModel;


class CompanyController extends \BaseController {
	
	/* ajax functions */
	public function asyncAddReview() {
		if (Session::has('user_id')) {
			if (Input::has('company_id')) {
				$companyId = Input::get('company_id');
				$score = Input::get('score');
				$description = Input::get('description');
				$userId = Session::get('user_id');
				
				$status = ReviewModel::where('company_id', $companyId)->where('user_id', $userId)->count();
	
				if ($status == 0) {
					
					$review = new ReviewModel;
					
					$review->user_id = $userId;
					$review->company_id = $companyId;
					$review->score = $score;
					$review->description = $description;
					
					$review->save();
									
					return Response::json(['result' => 'success', 'msg' => 'Review has been submitted successfully.']);
				} else {
					return Response::json(['result' => 'failed', 'msg' => 'You have already leaved a review', 'code' => 'CD00']);
				}
			} else {
				return Response::json(['result' => 'failed', 'msg' => 'Invalid Request', 'code' => 'CD00']);
			}
		} else {
			return Response::json(['result' => 'failed', 'msg' => 'You must login for leave review', 'code' => 'CD01']);
		}
	}
}
