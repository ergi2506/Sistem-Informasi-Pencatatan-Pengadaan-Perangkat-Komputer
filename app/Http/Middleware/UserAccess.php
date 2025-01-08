<?php
 
namespace App\Http\Middleware;
 
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
 
class UserAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    //public function handle(Request $request, Closure $next): Response
   // {
    //    return $next($request);
   // }
 
    public function handle(Request $request, Closure $next, $userType)
    {
        // echo $userType.'||'. auth()->user()->type; 
        if ($userType == 'admin' || $userType == 'user') {
            return $next($request);
        }
        // return $next($request)->with('error', 'You do not have Permision .'); 
        // return redirect()->route('home')->with('error', 'You do not have Permision .'); 

 
        // return response()->json(['You do not have permission to access for this page.']);
        // return response()->view('dashboard'); 
    }
}