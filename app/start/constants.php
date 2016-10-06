<?php
define('SITE_NAME', 'SoundsGood');

define('PAGINATION_SIZE', 10);
define('BUDGET_MIN', 0);
define('BUDGET_MAX', 10000);
define('LOGO', 'default.png');

define('HTTP_PATH', "http://www.sound.localhost/");

define('HTTP_LOGO_PATH', HTTP_PATH.'assets/logos/');
define('ABS_LOGO_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/logos/');
define('ABS_LOGO_PATH_REL', '/assets/logos/');

define('HTTP_PHOTO_PATH', HTTP_PATH.'assets/photos/');
define('ABS_PHOTO_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/photos/');

define('Yum_Recipe_Url', 'http://api.yummly.com/v1/api/recipes');
define('Yum_Recipe_Url_Of_Id', 'http://api.yummly.com/v1/api/recipe/');

define('Yum_Recipe_App_Id', '882d3a5e');
define('Yum_Recipe_App_Key', '8cc8a8fbade5a154b80400f6eb3d2f49');

define('HTTP_PRODUCT_PATH', HTTP_PATH.'assets/product/');
define('ABS_PRODUCT_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/product/');
define('ABS_PRODUCT_PATH_REL', '/assets/product/');

define('HTTP_CATEGORY_PATH', HTTP_PATH.'assets/category/');
define('ABS_CATEGORY_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/category/');
define('ABS_CATEGORY_PATH_REL', '/assets/category/');

define('HTTP_VIDEO_PATH', HTTP_PATH.'assets/videos/');
define('ABS_VIDEO_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/videos/');

define('HTTP_IMAGE_PATH', HTTP_PATH.'assets/img/');
define('ABS_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'].'/assets/img/');

define('RECIPE_API_URL', 'https://spoonacular-recipe-food-nutrition-v1.p.mashape.com/recipes');
define('RECIPE_API_KEY', 'oF5fgxwXdJmshiBD1xSiJNOKfSXOp1X1neAjsncEdefcy57uca'); // Testing
// define('RECIPE_API_KEY', '4EsI4Mmh20mshkCfKDe2wCk1pYvWp1ZSUsMjsnWxcuLijTe9Ew'); // Production

define('RECEIPT_MAIL_ADDR', 'appsoundsgood@gmail.com');
define('RECEIPT_MAIL_PASSWORD', 'theculinaryrevolution');
