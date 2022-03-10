<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class checkUserAuth
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
        try {
            if (! Auth()->check()){
                throw new Exception('Anda belum login');
            }

            return $next($request);

        }catch (Exception $e) {
            Log::error($e->getMessage());
            Session::flash('errorMessage', $e->getMessage());
            return redirect()->route("starterPage");
        }

    }
}
