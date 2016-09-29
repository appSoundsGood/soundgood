<?php

use Illuminate\Support\Facades\Cache;

class RecipeAPI {
	static function search($q) {
		$recipeUrl = Yum_Recipe_Url.'?_app_id='.Yum_Recipe_App_Id.'&_app_key='.Yum_Recipe_App_Key.'&maxResult=20&q='.$q;
		
		$ch = curl_init($recipeUrl);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
		$data = curl_exec($ch);
		
		$result = json_decode($data);
		
		curl_close($ch);
		
		//include the recipe medium image and ingredient amount
		$data = $result->matches;
		
		return $data;
	}
	
	static function recipeInfo($recipeId) {
		$recipeUrl = Yum_Recipe_Url_Of_Id.$recipeId.'?_app_id='.Yum_Recipe_App_Id.'&_app_key='.Yum_Recipe_App_Key;
		$recipeIds[] = $recipeId;
		
		$cache_key = md5($recipeUrl);
		
		$result = null;
		
		if (!Cache::has($cache_key)) {
			$ch = curl_init($recipeUrl);
			 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
			curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
			$data = curl_exec($ch);
			 
			$result = json_decode($data);
			Cache::put($cache_key, $result, 1440); // cache result
			 
			curl_close($ch);
		}
		else {
			$result = Cache::get($cache_key);
		}
		
		return $result;
	}
}