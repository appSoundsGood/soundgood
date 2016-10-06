<?php

use Illuminate\Support\Facades\Cache;

class RecipeAPI {
	static function searchRecipes() {
		$number_of_recipes = 20;
		$recipeUrl = RECIPE_API_URL. "/random?number=". $number_of_recipes;
		
		Unirest\Request::verifyPeer(false);
		$response = Unirest\Request::get($recipeUrl,
				[
					"X-Mashape-Key" => RECIPE_API_KEY,
					"Accept" => "application/json"
				]
			);
				
		return $response->body->recipes;
	}
	
	/**
	 * 
	 * @param $cabinet array list of ingredients
	 * @return array of searched recipes
	 */
	static function searchRecipesBasedCabinet($cabinet) {
		$number_of_recipes = 20;
		$recipeUrl = RECIPE_API_URL. "/findByIngredients?fillIngredients=true&ranking=2&number=". $number_of_recipes. "&ingredients=". implode($cabinet, ",");
		
		Unirest\Request::verifyPeer(false);
		$response = Unirest\Request::get($recipeUrl,
				[	
						"X-Mashape-Key" => RECIPE_API_KEY,
						"Accept" => "application/json"
				]
				);
		
		$recipes = [];
		foreach($response->body as $r) {
			$recipe = static::recipeInfo($r->id);
			$recipe->missedIngredients = $r->missedIngredients;
			$recipes[] = $recipe;
		}
		
		return $recipes;
	}
		
	static function recipeInfo($recipeId) {
		$recipeUrl = RECIPE_API_URL. '/'. $recipeId. '/information';
		
		$cache_key = md5($recipeUrl);
		
		$result = null;
		
		if (!Cache::has($cache_key)) {
			Unirest\Request::verifyPeer(false);
			$result = Unirest\Request::get($recipeUrl,
					[
						"X-Mashape-Key" => RECIPE_API_KEY,
						"Accept" => "application/json"
					]
				);
			
			Cache::put($cache_key, $result, 1440); // cache result
		}
		else {
			$result = Cache::get($cache_key);
		}
		
		return $result->body;
	}
}