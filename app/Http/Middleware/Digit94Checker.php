<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class Digit94Checker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */

    public function handle(Request $request, Closure $next)
    {
        
        if (!file_exists(storage_path(base64_decode('aW5zdGFsbGVk'))) || !file_exists(storage_path(base64_decode('YWN0aXZhdGVk'))) || Carbon::parse(get_option('last_check'))->diffInDays(Carbon::now()) > 7) {
            return redirect()->route('activation'); 
        }

        if(Carbon::parse(get_option('last_check'))->diffInDays(Carbon::now()) > 2){
            return redirect()->route('activation'); 
        }



        return $next($request);
    }
}
