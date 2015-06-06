<?php namespace App\Http\Controllers\Admin;

use Input;
use Redirect;
use App\User;
use App\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller {

	protected $rules = [
    'lname' => ['required', 'min:5'],
    'fname' => ['required'],
    'position' => ['required', 'min:5'],
  ];

	public function show($id)
	{
		$user = User::find($id);
    $profile = Profile::where('user_id', '=', $user->id)->first();
    if (is_null($profile)) {
      $profile = new Profile;
      $profile->user_id = $user->id;
      $profile->email = $user->email;
      $profile->save();
    }
    return view('admin.profiles.show', compact('profile'));
	}

	public function edit($id)
	{
		$user = User::find($id);
    $profile = Profile::where('user_id', '=', $user->id)->first();
    return view('admin.profiles.edit', compact('user', 'profile'));
	}

	public function update(Request $request, $id)
	{
		$this->validate($request, $this->rules);
    $user = User::find($id);
    $input = array_except(Input::all(), ['_token', 'avatar', 'birthday']);

    $profile = Profile::where('user_id', '=', $user->id)->first();
    $profile->update($input);

    // Update Avatar
    $avatar = Input::file('avatar');

    if (!is_null($avatar)) {
      $filename = time()."-".$avatar->getClientOriginalName();
      $destinationPath = public_path().'/image/profiles/';
      $uploadSuccess = $avatar->move($destinationPath, $filename);
      $profile->avatar = '/image/profiles/'.$filename;
    }

    $profile->save();

    // Update Birthday
    $birthday = Input::only('birthday');
    if (!is_null($birthday['birthday']) && $birthday['birthday'] != "") {
      $profile->birthday = date('Y-m-d h-i-s', strtotime($birthday['birthday']));
    }

    $profile->save();

    return Redirect::to('/admin/profiles/'.$user->id)->with('message', 'Chỉnh sửa thông tin người dùng');
	}

}
