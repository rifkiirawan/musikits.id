<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AnggotaCheck
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
        if($request->session()->get('role')=='Anggota'){
            return $next($request);
        }else{
            return redirect()->back();
        }
    }
}
