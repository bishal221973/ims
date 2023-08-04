<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class SessionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('org_id')) {
            foreach (Auth::user()->roles as $role) {
                if ($role->name != "super-admin") {
                    // return ;
                    Session::set('org_id', Auth()->user()->organization->id);
                } else {
                    $organization = Organization::select('id')->where('status', "1")->first();
                    if ($organization) {
                        Session::set('org_id', $organization->id);
                    }else{
                        Session::put('org_id', "0");

                    }
                }
            }
        }


        return $next($request);
    }
}
