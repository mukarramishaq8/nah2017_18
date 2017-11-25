<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use App\User;
use App\Stage;
class CheckPaymentMethodStage
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
        if(Auth::check()){
            $user = Auth::user();
            $stage = $user->stage()->get();
            if($stage && count($stage)>0){
                $stage = $stage[0];
                
                if(!$stage->is_professional_info_done){
                    return redirect('professionalInformation');
                }
                
                if(!$stage->is_residence_done){
                    // return redirect('chalanMethod');
                    return redirect('resident');
                }
                else if(!$stage->is_payment_method_done){
                    return $next($request);
                }
                else{
                    return redirect('chalanMethod');
                }
                
            }
            else{
                Auth::logout();
                //return $next($request);
                return redirect('login')->with('type','warning')->with('msg','Your account was logged out due to your smartness :) Please login again to proceed');
            }
        }
        else{
            return redirect('login')->with('type','warning')->with('msg','Session Expired. Login agian to proceed');
        }
    }
}
