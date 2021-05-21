<?php

namespace App\Http\Middleware;

use Closure;
use Session;
use Illuminate\Support\Facades\Auth;
class UserInfoMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
      // if ($request->input('token') !== 'my-secret-token') {
      //       return redirect('dashboard');
      //   }
      if(is_null(Auth::user())) {
        return redirect('/dashboard');
      }

        return $next($request);
        }
}
