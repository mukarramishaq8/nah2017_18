<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class CheckCODMethod
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
        //check user is logged in
        if(Auth::check()){
            $user = Auth::user();
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
                if($payment->resident == 'overseas'){
                    return redirect()->route('overseasMethod');
                }
                if($payment->payment_method == 'chalan'){
                    return redirect()->route('chalanMethod');
                }
                else if($payment->payment_method == 'online'){
                    return  redirect()->route('onlineMethod');
                }
                else if($payment->payment_method == 'cod'){
                    return  $next($request);
                }
                else{
                    if($payment->resident == 'overseas'){
                        return redirect()->route('overseasMethod');
                    }
                    return redirect()->route('home');
                }
            }

            Auth::logout();
            return redirect()->route('login')->with('type','danger')->with('msg',"Don't try to be smart! Otherwise the consequences will not be light!");

        }
        return redirect()->route('login')->with('type','warning')->with('msg','Login first to proceed');
    }
}
