<?php
use App\Aricle;
use App\Category;

Route::get('/', 'HomeController@index');

Route::get('home', 'HomeController@index');

Route::group(
  ['prefix' => 'admin', 'middleware' => 'App\Http\Middleware\AdminMiddleware', ],
  function() {
    Route::get('/', 'Admin\AdminController@index');

    Route::get('/edit-page', 'Admin\CategoryController@editPage');
    Route::get('/edit-news', 'Admin\CategoryController@editNews');
    Route::get('/edit-training', 'Admin\CategoryController@editTraining');
    Route::get('/edit-research', 'Admin\CategoryController@editResearch');
    Route::get('/edit-history', 'Admin\CategoryController@editHistory');
    

    Route::resource('categories', 'Admin\CategoryController');
    Route::resource('categories.articles', 'Admin\ArticleController');

    Route::resource('users', 'Admin\UserController');
    Route::resource('profiles', 'Admin\ProfileController');
  }
);

Route::group(
  ['prefix' => 'teacher', 'middleware' => 'App\Http\Middleware\TeacherMiddleware', ],
  function() {
    Route::get('/', 'TeacherController@index');
    Route::get('/list-article', 'TeacherController@listArticle');
  }
);

// Provide controller methods with object instead of ID
Route::model('categories', 'Category');
Route::model('articles', 'Article');

// Use slugs rather than IDs in URLs
Route::bind('articles', function($value, $route) {
  return App\Article::whereSlug($value)->first();
});
Route::bind('categories', function($value, $route) {
  return App\Category::whereSlug($value)->first();
});

Route::group(['prefix' => 'profile/{id}', 'middleware' => 'App\Http\Middleware\EditMiddleWare'], function()
{
  Route::get('/', 'ProfileController@show');
  Route::get('/edit', 'ProfileController@edit');
  Route::post('/update', 'ProfileController@update');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
