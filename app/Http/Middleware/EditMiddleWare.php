<?php namespace App\Http\Middleware;

use Closure;

class EditMiddleWare {

	public function handle($request, Closure $next)
	{
		$id = $request->route()->parameters();

		if (is_null($request->user()) || $request->user()->id != $id['id'])
    {
      return redirect('/');
    }

		return $next($request);
	}

}
