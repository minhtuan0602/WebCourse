<?php namespace App\Http\Controllers\Teacher;

use Input;
use App\User;
use Redirect;
use App\Article;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ArticleController extends Controller {
	// Transform array to convert english
	protected $trans = array(
		'à' => "a", 'á' => "a", 'ạ' => "a", 'ả' => "a", 'ã' => "a", 'â' => "a", 'ầ' => "a", 'ấ' => "a", 'ậ' => "a", 'ẩ' => "a", 'ẫ' => "a", 'ă' => "a", 'ắ' => "a", 'ặ' => "a", 'ẳ' => "a", 'ẵ' => "a",
		'è' => "e", 'é' => "e", 'ẹ' => "e", 'ẻ' => "e", 'ẽ' => "e", 'ê' => "e", 'ề' => "e", 'ế' => "e", 'ệ' => "e", 'ể' => "e", 'ễ' => "e",
		'ì' => "i", 'í' => "i", 'ị' => "i", 'ỉ' => "i", 'ĩ' => "i",
		'ò' => "o", 'ó' => "o", 'ọ' => "o", 'ỏ' => "o", 'õ' => "o", 'ô' => "o", 'ồ' => "o", 'ố' => "o", 'ộ' => "o", 'ổ' => "o", 'ỗ' => "o", 'ơ' => "o", 'ờ' => "o", 'ớ' => "o", 'ợ' => "o", 'ở' => "o", 'ỡ' => "o",
		'ù' => "u", 'ú' => "u", 'ụ' => "u", 'ủ' => "u", 'ũ' => "u", 'ư' => "u", 'ừ' => "u", 'ứ' => "u", 'ự' => "u", 'ử' => "u", 'ữ' => "u",
		'ỳ' => "y", 'ý' => "y", 'ỵ' => "y", 'ỷ' => "y", 'ỹ' => "y",
		'À' => "a", 'Á' => "a", 'Ạ' => "a", 'Ả' => "a", 'Ã' => "a", 'Â' => "a", 'Ầ' => "a", 'Ầ' => "a", 'Ậ' => "a", 'Ẩ' => "a", 'Ẫ' => "a", 'Ă' => "a", 'Ẳ' => "a", 'Ặ' => "a", 'Ẳ' => "a", 'Ẵ' => "a",
		'È' => "e", 'É' => "e", 'Ẹ' => "e", 'Ẻ' => "e", 'Ẽ' => "e", 'Ê' => "e", 'Ề' => "e", 'Ế' => "e", 'Ệ' => "e", 'Ể' => "e", 'Ễ' => "e",
		'Ì' => "i", 'Í' => "i", 'Ị' => "i", 'Ỉ' => "i", 'Ĩ' => "i",
		'Ò' => "o", 'Ó' => "o", 'Ọ' => "o", 'Ỏ' => "o", 'Õ' => "o", 'Ô' => "o", 'Ồ' => "o", 'Ố' => "o", 'Ộ' => "o", 'Ổ' => "o", 'Ỗ' => "o", 'Ơ' => "o", 'Ờ' => "o", 'Ớ' => "o", 'Ợ' => "o", 'Ở' => "o", 'Ỡ' => "o",
		'Ù' => "u", 'Ú' => "u", 'Ụ' => "u", 'Ủ' => "u", 'Ũ' => "u", 'Ư' => "u", 'Ừ' => "u", 'Ứ' => "u", 'Ự' => "u", 'Ử' => "u", 'Ữ' => "u",
		'Ỳ' => "y", 'Ý' => "y", 'Ỵ' => "y", 'Ỷ' => "y", 'Ỹ' => "y",
		'đ' => "d", 'Đ' => "d",
		'!' => "-", '@' => "-", '%' => "-", '^' => "-", '*' => "-", '(' => "-", ')' => "-", '+' => "-", '=' => "-", '<' => "-", '>' => "-", '?' => "-", '/' => "-", '.' => "-", ':' => "-", ';' => "-", "'" => "-", '"' => "-", '&' => "-", '#' => "-", '[' => "-", ']' => "-", '~' => "-", '$' => "-", ' ' => "-"
	);

	protected $rules = [
		'title' => ['required', 'min:5'],
		'content' => ['required', 'min:10'],
	];

	protected function getCategory(){
		$categories = Category::where('isBuiltIn', '=', 0)->get();
		$array_categories = [];
		foreach ($categories as $category) {
			array_push($array_categories, [$category->id => $category->name ]);
		}
		return $array_categories;
	}

	public function index(Request $request)
	{
		$user_id = $request->user()->id;

    $user = User::find($user_id);
    $articles = $user->articles;
    return view('teacher.articles.index', compact('articles'));
	}

	public function create()
	{
		$array_categories = $this->getCategory();
		return view('teacher.articles.create', compact('array_categories'));
	}

	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), ['image']);

		$title = Input::get('title');
		$slug = strtolower(strtr($title, $this->trans));

		$input['slug'] = $slug;
		$input['user_id'] = $request->user()->id;
		$input['dateWrite'] = date('Y-m-d H:i:s');

		$image = Input::file('image');
		if (!is_null($image)) {
			$filename = time()."-".$image->getClientOriginalName();
			$destinationPath = public_path().'/image/article/image/';
   		$uploadSuccess = $image->move($destinationPath, $filename);
			$input['image'] = '/image/article/image/'.$filename;
		}

		$article = Article::create( $input );
	 
		return Redirect::route('teacher.articles.show', $article->slug)->with('message', 'Tạo Article thành công');
	}

	public function show(Request $request, Article $article)
	{
		if ($request->user()->id != $article->user_id) {
			return view('teacher.articles.error');
		}

		return view('teacher.articles.show', compact('article'));
	}

	public function edit(Request $request, Article $article)
	{
		if ($request->user()->id != $article->user_id) {
			return view('teacher.articles.error');
		}

		$array_categories = $this->getCategory();
		return view('teacher.articles.edit', compact('article', 'array_categories'));
	}

	public function update(Request $request, Article $article)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), ['image']);

		$image = Input::file('image');
		if (!is_null($image)) {
			$filename = time()."-".$image->getClientOriginalName();
			$destinationPath = public_path().'/image/article/image/';
   		$uploadSuccess = $image->move($destinationPath, $filename);
			$input['image'] = '/image/article/image/'.$filename;
		}

		$article->update($input);
		return Redirect::route('teacher.articles.show', $article->slug)->with('message', 'Sửa Article thành công');;
	}

	public function destroy(Request $request, Article $article)
	{
		if ($request->user()->id != $article->user_id) {
			return view('teacher.articles.error');
		}

		$article->delete();

		$user_id = $request->user()->id;

    $user = User::find($user_id);
    $articles = $user->articles;
		return Redirect::route('teacher.articles.index', compact('articles'))->with('message', 'Xóa Article thành công');
	}

}
