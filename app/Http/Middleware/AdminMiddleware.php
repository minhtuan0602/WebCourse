<?php namespace App\Http\Middleware;

use Closure;

class AdminMiddleware {

	public function handle($request, Closure $next)
	{
		if (is_null($request->user()) || $request->user()->type != 'A')
    {
      return redirect('/');
    }

    return $next($request);
	}

}
