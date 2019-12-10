<?php

namespace App\Http\Middleware;

use App\FinalStudent;
use Closure;

class CheckVerify
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
        $finalStudent = new FinalStudent;
        if (!$finalStudent->checkIsVerify($request->user()->id)) {
            return redirect()
                ->to(route('final_registration.index'));
        }
        return $next($request);
    }
}
