<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;
	
	protected $table = 'users';

	protected $fillable = ['email', 'password', 'username'];

	protected $hidden = ['password', 'remember_token'];

	public function profile()
  {
    return $this->hasOne('App\Profile');
  }

}
