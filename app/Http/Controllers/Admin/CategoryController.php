<?php namespace App\Http\Controllers\Admin;

use Input;
use Redirect;
use App\Category;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller {

	protected $rules = [
		'name' => ['required', 'min:3']
	];

	public function index()
	{
		$categories = Category::all();
		return view('admin.categories.index', compact('categories'));
	}

	public function create()
	{
		return view('admin.categories.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		$input = Input::all();
		$category = Category::create($input);

		return Redirect::route('admin.categories.index')->with('message', 'Tạo Category thành công.');
	}

	public function show(Category $category)
	{
		return view('admin.categories.show', compact('category'));
	}

	public function edit(Category $category)
	{
	  return view('admin.categories.edit', compact('category'));
	}

	public function update(Request $request, Category $category)
	{
		$this->validate($request, $this->rules);

		$input = Input::all();
		$category->update($input);

		if ($category->isBuiltIn) {
			return view('admin.categories.editPage');
		}

		return Redirect::route('admin.categories.show', $category->slug)->with('message', 'Cập nhật category '.$category->name.' thành công');
	}

	public function destroy(Category $category)
	{
		$category->delete();

		return Redirect::route('admin.categories.index')->with('message', 'Xóa Category thành công.');
	}

	public function editPage() {
		return view('admin.categories.editPage');
	}

	public function editNews()
	{
		$categories = Category::where('isBuiltIn', '=', false)->get();
		return view('admin.categories.editNews', compact('categories'));
	}

	public function editTraining()
	{
		$category = Category::where('name', 'like', 'Đào tạo')->firstOrFail();
		$articles = $category->articles;
		return view('admin.categories.editTraining', compact('category', 'articles'));
	}

	public function editResearch()
	{
		$category = Category::where('name', 'like', 'Nghiên cứu')->firstOrFail();
		$articles = $category->articles;
		return view('admin.categories.editResearch', compact('category', 'articles'));
	}

	public function editHistory()
	{
		$category = Category::where('name', 'like', 'Lịch sử')->firstOrFail();
		$articles = $category->articles;
		return view('admin.categories.editHistory', compact('category', 'articles'));
	}
	

}
