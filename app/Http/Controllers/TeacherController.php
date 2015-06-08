<?php namespace App\Http\Controllers;

use App\User;
use App\Article;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class TeacherController extends Controller {

	public function index()
  {
    return view('teacher.index');
  }

  public function listArticle(Request $request)
  {
    $username = $request->user()['attributes']['username'];

    $user = User::where('username', 'like', $username)->firstOrFail();
    $articles = $user->articles;
    // $articles = Article::where('username', 'like', $username)->get();
    return view('teacher.listArticle', compact('articles'));
  }

}
