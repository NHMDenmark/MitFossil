<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AnsweredQuestions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if ($request->user() && $request->user()->role == 'customer') {
            if (!$request->user()->answered_questions) {
                return redirect(route('answer_questions'));
            }
        }

        return $next($request);
    }
}
