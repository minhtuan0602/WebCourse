<?php namespace App\Http\Controllers\Teacher;

use Input;
use Redirect;
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

  public function getID(Request $request)
  {
    $user = $request->user();
    $user_id = $user['attributes']['id'];
    $email = $user['attributes']['email'];
    return array($user_id, $email);
  }

	public function show(Request $request)
  {
    $user = $this->getID($request);
    $profile = Profile::where('user_id', '=', $user[0])->first();
    if (is_null($profile)) {
      $profile = new Profile;
      $profile->user_id = $user[0];
      $profile->email = $user[1];
      $profile->save();
    }
    return view('profiles.show', compact('profile'));
  }

  public function edit(Request $request)
  {
    $user = $this->getID($request);
    $profile = Profile::where('user_id', '=', $user[0])->first();
    return view('profiles.edit', compact('profile'));
  }

  public function update(Request $request)
  {
    $this->validate($request, $this->rules);
    $input = array_except(Input::all(), ['_token', 'avatar', 'birthday']);

    $user = $this->getID($request);
    $profile = Profile::where('user_id', '=', $user[0])->first();
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

    return Redirect::to('profile/'.$user[0])->with('message', 'Chỉnh sửa thông tin người dùng');
  }

}
