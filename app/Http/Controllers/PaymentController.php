<?php

namespace App\Http\Controllers;
use App\Payment;
use App\User;
use App\Stage;
use App\Chalan;
use App\Price;
use App\Guest;
use App\Bank;
use App\Status;
use NumberFormatter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use PDF;

class PaymentController extends Controller
{
    //

    public function changePaymentMethod($user_id,$token){
        if(Auth::check()){
            $user = Auth::user();
            if($user->id == $user_id && \Session::token() == $token){
                $stage = Stage::where('user_id',$user->id)->first();
                if($stage){
                    $stage->is_payment_method_done = false;
                    $stage->save();
                    return redirect()->route('paymentMethod')->with('type','warning')->with('msg','Please choose your payment method wisely!');
                }
                else{
                    Auth::logout();
                    return redirect()->route('login')->with('type','error')->with('msg','Illogical Jump! ;(. Please login again to proceed');
                }
            }
            else{
                return redirect()->route('NotFound');
            }
        }
        else{
            return redirect()->route('NotFound');
        }
    }


    public function residentIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = Payment::create(array(
                    'user_id'=>$user->id,
                ));
            }
            
            return view('resident')->with('payment',$payment);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }
    public function paymentMethodIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = new Payment;
            }
            return view('paymentMethod')->with('payment',$payment);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function chalanMethodIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = new Payment;
            }
            return view('chalanMethod')->with('payment',$payment);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function onlineMethodIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            $price = Price::where('default',1)->first();
            $guests = $user->guest()->get();
            $bank = Bank::where('id',1)->first();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = new Payment;
            }
            return view('onlineMethod')->with('payment',$payment)->with('bank',$bank)->with('price',$price)->with('guests',$guests);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function codMethodIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = new Payment;
            }
            return view('codMethod')->with('payment',$payment);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function overseasMethodIndex(){
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
            }
            else{
                $payment = new Payment;
            }
            $status = \DB::table('statuses')->where('user_id',$user->id)->first();
            if(!$status){
                $status = new Status;
            }
            return view('overseasMethod')->with('payment',$payment)->with('status',$status);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 

    }



    public function afterPaymentIndex(){
        $user = Auth::user();
        if($user){
            $status = \DB::table('statuses')->where('user_id',$user->id)->first();
            if(!$status){
                $status = new Status;
            }
            return view('afterPayment')->with('status',$status);
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }


    public function residentSubmit(Request $request){
        $this->validate($request,[
            'resident'=>'required|alpha',
        ]);
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
                $payment->resident = $request->input('resident');
                $payment->save();

                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_residence_done = true;
                    $stage->save();
                }

                if($payment->resident == 'overseas'){
                    return redirect()->route('overseasMethod');
                }

                return redirect()->route('paymentMethod');
            }
            else{
                $payment = Payment::create(array(
                    'user_id'=>$user->id,
                    'resident'=>$request->input('resident')
                ));
                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_residence_done = true;
                    $stage->save();
                }
                if($payment->resident == 'overseas'){
                    return redirect()->route('overseasMethod');
                }

                return redirect()->route('paymentMethod');
            }
            return redirect('resident')->with('type','danger')->with('unknown error. Please try again');
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function paymentMethodSubmit(Request $request){
        $this->validate($request,[
            'payment-method'=>'required|alpha',
        ]);
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
                $payment->payment_method = $request->input('payment-method');
                $payment->save();

                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_payment_method_done = true;
                    $stage->save();
                }
                else{
                    return redirect('personalInformation')->with('type','warning')->with('msg','Kindly fill these details first');
                }

                if($request->input('payment-method') == 'chalan'){
                    return redirect('chalanMethod');
                }
                else if($request->input('payment-method') == 'online'){
                    return redirect('onlineMethod');
                }
                else if($request->input('payment-method') == 'cod'){
                    return redirect('codMethod');
                }
                else{
                    return redirect('paymentMethod')->with('type','danger')->with('msg','Unknown Payment Method');
                }

                return redirect('paymentMethod')->with('type','danger')->with('msg','Unknown Payment Method');
                
            }
            else{
                return redirect('resident')->with('type','warning')->with('msg','Please choose your residence first');
            }
            return redirect('resident')->with('type','danger')->with('Unknown error. Please try again');
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function chalanMethodSubmit(Request $request){
        $this->validate($request,[
            'amount'=>'required|numeric',
            'branch-address'=>'required|string',
        ]);
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
                $payment->amount = $request->input('amount');
                $payment->branch_address = $request->input('branch-address');
                $payment->save();

                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_final_payment_done = true;
                    $stage->save();
                }

                return redirect('afterPayment');
            }
            else{
                
                return redirect('resident')->with('type','danger')->with('msg','Please select your resident first');
            }
            return redirect('resident')->with('type','danger')->with('unknown error. Please try again');
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }


    public function onlineMethodSubmit(Request $request){
        $this->validate($request,[
            'amount'=>'required|numeric',
            'account-no'=>'required|numeric',
        ]);
        $user = Auth::user();
        if($user){
            $payment = $user->payment()->get();
            if($payment && count($payment)>0){
                $payment = $payment[0];
                $payment->amount = $request->input('amount');
                $payment->account_no = $request->input('account-no');
                $price = Price::where('default',1)->first();
                $payment->registration_type = $price->registration_type;
                $payment->save();

                $stage = $user->stage()->get();
                if($stage && count($stage)>0){
                    $stage = $stage[0];
                    $stage->is_final_payment_done = true;
                    $stage->save();
                }

                return redirect('afterPayment');
            }
            else{
                
                return redirect('resident')->with('type','danger')->with('msg','Please select your resident first');
            }
            return redirect('resident')->with('type','danger')->with('unknown error. Please try again');
        }
        else{
            return view('login')->with('type','warning')->with('msg','Session Expired. Please Login again');
        } 
    }

    public function downloadChalan(Request $request){
        $user = Auth::user();
        if($user){
            $chalan = $user->chalan()->get();
            $bank = Bank::where('id',1)->first();
            $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
            if($chalan && count($chalan)>0){
                $chalan = $chalan[0];
                $guests = $user->guest()->get();
                $price = Price::where('registration_type',$chalan->registration_type)->first();
                $totalAmount = 0;
                $totalAmount += $price->alumni_price;
                if($guests && count($guests)>0){
                    $noOfGuest = count($guests);
                    $totalAmount += $noOfGuest*$price->guest_price;
                }

                if($totalAmount != $chalan->amount){
                    $chalan->amount = $totalAmount;
                    $chalan->save();
                }

                $pdf = PDF::loadView('chalan',[
                    'user_id'=>$chalan->user_id,
                    'chalan_id'=>$chalan->chalan_id,
                    'name'=>$chalan->name,
                    'accountNo'=>$bank->bank_account_number,
                    'accountTitle'=>$bank->bank_account_name,
                    'cnic'=>$chalan->cnic,
                    'school'=>$chalan->school,
                    'issue_date'=>$chalan->issue_date,
                    'amount'=>$chalan->amount,
                    'due_date'=>$chalan->due_date,
                    'f'=>$f,
                ]);
                $pdf->setPaper('A4', 'landscape');
                return $pdf->download('chalan.pdf');
                
            }
            else{
                $guests = $user->guest()->get();
                $price = Price::where('default',1)->first();
                
                if($guests && count($guests)>0){
                    $noOfGuest = count($guests);
                    $totalAmount = 0;
                    $totalAmount += $noOfGuest*$price->guest_price;
                    $totalAmount += $price->alumni_price;

                    $personalI = $user->personalI()->get();
                    $personalI = $personalI[0];

                    $educationalI = $user->educationalI()->get();
                    $educationalI = $educationalI[0];
                    
                    //chalan id [1=>'registraion_type',2=>'disability',3,4=>'noOfGuest',5,6,7,8=>'user_id']
                    $regType = 1; //one for early bird
                    if($price->registration_type == 'earlybird'){
                        $regType = 1;
                    }
                    else{
                        $regType = 2;
                    }
                    $chalan_id = $regType.''.str_pad($user->disability, 1, '0', STR_PAD_LEFT).''.str_pad($noOfGuest, 2, '0', STR_PAD_LEFT).''.str_pad($user->id, 4, '0', STR_PAD_LEFT);
                    $chalan = Chalan::create(array(
                        'user_id'=>$user->id,
                        'chalan_id'=>$chalan_id,
                        'name'=>$user->name,
                        'cnic'=>$personalI->cnic,
                        'school'=>$educationalI->school,
                        'issue_date'=>time(),
                        'amount'=>$totalAmount,
                        'due_date'=>strtotime('19-12-2017'),
                        'registration_type'=>$price->registration_type,
                    ));
                    $pdf = PDF::loadView('chalan',[
                        'user_id'=>$chalan->user_id,
                        'chalan_id'=>$chalan->chalan_id,
                        'name'=>$chalan->name,
                        'accountNo'=>$bank->bank_account_number,
                        'accountTitle'=>$bank->bank_account_name,
                        'cnic'=>$chalan->cnic,
                        'school'=>$chalan->school,
                        'issue_date'=>$chalan->issue_date,
                        'amount'=>$chalan->amount,
                        'due_date'=>$chalan->due_date,
                        'f'=>$f,
                    ]);
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->download('chalan.pdf');
                }
                else{

                    $totalAmount = $price->alumni_price;
                    
                    $personalI = $user->personalI()->get();
                    $personalI = $personalI[0];

                    $educationalI = $user->educationalI()->get();
                    $educationalI = $educationalI[0];
                    //chalan id [1=>'registraion_type',2,3=>'noOfGuest',4,5,6,7=>'user_id']
                    $noOfGuest = 0;
                    //chalan id [1=>'registraion_type',2=>'disability',3,4=>'noOfGuest',5,6,7,8=>'user_id']
                    $regType = 1; //one for early bird
                    if($price->registration_type == 'earlybird'){
                        $regType = 1;
                    }
                    else{
                        $regType = 2;
                    }
                    $chalan_id = $regType.''.str_pad($user->disability, 1, '0', STR_PAD_LEFT).''.str_pad($noOfGuest, 2, '0', STR_PAD_LEFT).''.str_pad($user->id, 4, '0', STR_PAD_LEFT);
                    $chalan = Chalan::create(array(
                        'user_id'=>$user->id,
                        'chalan_id'=>$chalan_id,
                        'name'=>$user->name,
                        'cnic'=>$personalI->cnic,
                        'school'=>$educationalI->school,
                        'issue_date'=>time(),
                        'amount'=>$totalAmount,
                        'due_date'=>strtotime('19-12-2017'),
                        'registration_type'=>$price->registration_type,
                    ));

                    $pdf = PDF::loadView('chalan',['user_id'=>$chalan->user_id,
                        'chalan_id'=>$chalan->chalan_id,
                        'name'=>$chalan->name,
                        'accountNo'=>$bank->bank_account_number,
                        'accountTitle'=>$bank->bank_account_name,
                        'cnic'=>$chalan->cnic,
                        'school'=>$chalan->school,
                        'issue_date'=>$chalan->issue_date,
                        'amount'=>$chalan->amount,
                        'due_date'=>$chalan->due_date,
                        'f'=>$f,
                    ]);
                    $pdf->setPaper('A4', 'landscape');
                    return $pdf->download('chalan.pdf');
    
                }
            }

            
            
        }
        else{
            return redirect('login')->with('type','warning')->with('msg','Session expired. Login again to continue');
        }
        

    }


}
