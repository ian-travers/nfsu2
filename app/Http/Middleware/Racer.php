<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Racer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (auth()->user()->isRacer()) {
            return $next($request);
        }

        return redirect()->back()->with('flash', [
            'type' => 'error',
            'message' => __('You should promote to the rider.'),
        ]);
    }
}
