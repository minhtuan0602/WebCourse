<?php namespace App\Http\Controllers;

use Input;
use Redirect;
use App\Profile;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller {

	protected $rules = [
    'name' => ['required', 'min:5'],
    'address' => ['required', 'min:10'],
    'numberphone' => ['required', 'min:10', 'max:15']
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

    $input = array_except(Input::all(), '_token');

    $user = $this->getID($request);
    $profile = Profile::where('user_id', '=', $user[0])->first();
    $profile->update($input);

    return Redirect::to('profile/'.$user[0])->with('message', 'Chỉnh sửa sản phẩm người dùng');
  }

}
