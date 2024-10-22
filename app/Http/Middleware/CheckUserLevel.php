<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLevel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $level): Response
    {
        $user = Auth::user();
        if (isset($user->level)  != $level) {
            //   abort(403, 'Unauthorized');
            return redirect()->route('login');
        }elseif (auth()->guest()) {
            return redirect()->route('login');
        }
        return $next($request);
    }
}
