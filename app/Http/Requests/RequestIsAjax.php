<?php

namespace App\Http\Requests;

use Closure;

class RequestIsAjax
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!$request->ajax()) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
