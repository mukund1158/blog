<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class Admin
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
        if (Auth::check()) {
            $user = new User();
            // if(Auth::user()->role_id == 1 || 2 || 4){
            if ($user->hasAnyRole(['admin', 'sub-admin', 'super-admin'])) {
                return $next($request);
            } else {
                return redirect('home');
            }
        } else {
            return redirect('login');
        }
    }
}
