<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\sigespServices;
use Illuminate\Support\Facades\Auth;



class statusPersonal
{
    protected $sigespServices;
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //dd($request);
        $status = $this->detect_status_personal();
        if($status->staper == 1){
            
            return $next($request);
        }
        Auth::guard('web')->logout();
        session()->flush();  
        return redirect()->route('login')->withErrors([
            'login' => 'Acceso no autorizado, empleado no activo.'
        ])->withInput(); 
    }

    public function __construct(sigespServices $sigespServices)
    {
        $this->sigespServices = $sigespServices;
    }
    public function detect_status_personal(){
       return  $this->sigespServices->detect_status_personal(Auth::user()->codper);
    }
}
