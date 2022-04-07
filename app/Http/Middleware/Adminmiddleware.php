<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class Adminmiddleware
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
        $path = $request->path();                        
        if(Session::get('adminid') && $path == "adminlogin"){            
            return redirect('dashboard');
        }else if($path != "adminlogin" && !Session::get('adminid') && $request->method() != 'POST'){
            return redirect('adminlogin');
        }
        return $next($request);
    }
}
