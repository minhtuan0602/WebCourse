<?php namespace App\Http\Controllers\Teacher;

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

}
