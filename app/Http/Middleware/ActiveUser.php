<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class ActiveUser
{
  public function handle($request, Closure $next)
  {
    if (Auth::check() && Auth::user()->active) {
      return $next($request);
    }

    $request->user()->token()->revoke();
    return response()->json([ 'message' => 'Your account has not been activated!'], 401);
  }
}
