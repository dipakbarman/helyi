<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Session;

class UserLoginMiddleware
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
        // session()->flush();
        // return redirect('undermaintain');
        // die();
        $path = $request->path();
        if(Session::has('userid')){
            $udata = get_company_all_data_byid(session()->get('userid'));
            if($udata->is_active == 0){
                session()->flush();
                return redirect('login');
                die();
            }
        }else if(Session::get('userid') && $path == "login"){            
            return redirect('utilitiesandpayments');
        }else if($path != "login" && !Session::get('userid') && $request->method() != 'POST'){
            return redirect('login');
        }
        return $next($request);
    }
}
