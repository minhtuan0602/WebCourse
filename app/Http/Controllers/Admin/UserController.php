<?php namespace App\Http\Controllers\Admin;

use Hash;
use Input;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class UserController extends Controller {

	protected $rules = [
		'username' => ['required', 'min:6'],
		'password' => ['required', 'min:6', 'confirmed'],
		'password_confirmation' => ['required'],
		'email' => ['required', 'email', 'unique:users'],
	];

	protected $rules_edit = [
		'username' => ['required', 'min:6'],
		'email' => ['required', 'email'],
	];

	public function index()
	{
		$users = User::all();
		return view('admin.users.index', compact('users'));
	}

	public function create()
	{
		return view('admin.users.create');
	}

	public function store(Request $request)
	{
		$this->validate($request, $this->rules);

		$input = array_except(Input::all(), ['password', 'password_confirmation']);
		$password = Input::only('password');
		$input['password'] = Hash::make($password['password']);
		User::create($input);

		return Redirect::route('admin.users.index')->with('message', 'Tạo người dùng thành công.');
	}

	public function edit($id)
	{
		$user = User::find($id);
		return view('admin.users.edit', compact('user'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->rules_edit);

		$input = array_except(Input::all(), ['password', 'password_confirmation']);
		$user = User::find($id);

		$password = Input::only('password');
		$password_confirmation = Input::only('password_confirmation');
		if ($password['password'] != '' && $password['password'] == $password_confirmation['password_confirmation']) {
			$input['password'] = Hash::make($password['password']);
		} elseif (($password['password'] != '' || $password_confirmation['password_confirmation'] != '') && $password['password'] != $password_confirmation['password_confirmation']) {
			return redirect()->back()->with('message', 'Xác nhận mật khẩu thất bại');
		}

		$user->update($input);

		return Redirect::route('admin.users.index')->with('message', 'Chỉnh sửa người dùng thành công.');
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		return Redirect::route('admin.users.index')->with('message', 'Xóa người dùng thành công.');
	}

}
