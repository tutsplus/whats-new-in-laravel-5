<?php namespace App\Http\Middleware;

use Closure;
use View;

class ShowUserAgent {

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next)
	{
        $isFirefox = preg_match('/Firefox/', $request->header('User-Agent'));

        View::share('ffUser', (bool) $isFirefox);

		$response = $next($request);

        $response->setContent('YAY FIREFOX!');

        return $response;
	}

}
