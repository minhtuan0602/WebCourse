<?php namespace App\Http\Controllers;

use App\Article;
use App\Category;
class HomeController extends Controller {

	// public function __construct()
	// {
	// 	$this->middleware('auth');
	// }

	public function index()
	{
    $category_main = Category::where('isBuiltIn', '=', 1)->get();
    $category_news = Category::where('isBuiltIn', '=', 0)->get();
    $articles_training = Article::where('category_id', '=', 1)->get();
    $articles_research_type_1 = Article::where('category_id', '=', 3)->where('type', '=', 1)->get();
    $articles_research_type_2 = Article::where('category_id', '=', 3)->where('type', '=', 2)->get();
    $articles_history = Article::where('category_id', '=', 4)->get();
		return view('home', compact('category_main', 'category_news', 'articles_training', 'articles_research_type_1', 'articles_research_type_2', 'articles_history'));
	}

}
