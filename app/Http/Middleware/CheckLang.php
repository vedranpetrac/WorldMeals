<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckLang
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
        $lang = 'ar';
        if($request->route('lang')) {
            $lang = $request->route('lang');
            // and remove the language parameter so we dont have to include it in all controller methods.
            $request->route()->forgetParameter('lang');
        }
        //app()->setLocale($lang);

        return $next($request);
    }
}
