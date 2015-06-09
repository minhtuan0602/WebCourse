<?php namespace App\Http\Middleware;

use Closure;

class TeacherMiddleware {

	public function handle($request, Closure $next)
	{
		if (is_null($request->user()))
    {
      return redirect('/auth/login');
    }

    return $next($request);
	}

}
