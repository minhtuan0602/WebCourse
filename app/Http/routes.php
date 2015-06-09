<?php
use App\Article;
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
    Route::get('/', 'Teacher\TeacherController@index');

    Route::resource('articles', 'Teacher\ArticleController');
  }
);

Route::get('/search', function(){
  $query = Input::only('string');

  $articles = Article::whereRaw(
    "MATCH(title) AGAINST(? IN BOOLEAN MODE)", 
    array($query)
  )->get();

  $body = [];
  foreach ($articles as $article) {
    array_push($body, array("id" => $article->id, "title" => $article->title));
  }
  $result = json_encode(array("title" => $query, "body" => $body));

  echo $result;
});

Route::get('/get-article', function(){
  $query = Input::only('id');

  $article = Article::where('id', '=', $query)->first();

  $body = array("id" => $article->id, "title" => $article->title, "body" => $article->content);
  $result = json_encode($body);

  echo $result;
});

Route::get('/get-category', function(){
  $query = Input::only('id');

  $category = Category::where('id', '=', $query)->first();
  $articles = $category->articles;

  $body = [];
  foreach ($articles as $article) {
    array_push($body, array("id" => $article->id, "title" => $article->title));
  }
  $result = json_encode(array("title" => $category->name, "body" => $body));

  echo $result;
});

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
  Route::get('/', 'Teacher\ProfileController@show');
  Route::get('/edit', 'Teacher\ProfileController@edit');
  Route::post('/update', 'Teacher\ProfileController@update');
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
