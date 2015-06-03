<?php namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {

	use AuthenticatesAndRegistersUsers;

  protected $rule = array(
    'username' => 'required',
    'password' => 'required'
  );

  protected $messages = [
    'required'    => 'Xin vui lòng nhập  :attribute.',
  ];

	public function __construct(Guard $auth, Registrar $registrar)
	{
		$this->auth = $auth;
		$this->registrar = $registrar;

		$this->middleware('guest', ['except' => 'getLogout']);
	}

	public function postLogin(Request $request)
	{
    $this->validate($request, $this->rule, $this->messages);

    $credentials = $request->only('username', 'password');

    if ($this->auth->attempt($credentials, $request->has('remember')))
    {
      return redirect()->intended($this->redirectPath());
    }

    return redirect($this->loginPath())
    ->withInput($request->only('username', 'remember'))
    ->withErrors([
        'username' => 'Username hoặc password không hợp lệ.',
    ]);
	}
}
