<?php namespace Company;

use Illuminate\Routing\Controllers\Controller;
use View, Input, Redirect, Session, Validator, Response, Mail;

use User as UserModel;
use Apply as ApplyModel;


class UserController extends \BaseController {
	
	/* Functions for ajax */
	
	public function asyncUpdateStatus() {
		
		$applyId = Input::get('apply_id');
		
		$apply = ApplyModel::find($applyId);
	
		$apply->status = 1;
		$apply->save();
		
		return Response::json(['result' => 'success', 'msg' => 'Status has been updated successfully.']);
		
	}

}
