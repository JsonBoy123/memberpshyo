<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\SendCode;
class VerifyController extends Controller
{
    public function getVerify(){
    	return view('auth.mobile_verify');
    }
    public function postVerfiy(Request $request){
    	if($user = User::where('code',$request->code)->first()){
    		$user->phone_verified_at = date('Y-m-d h:i:s');
    		$user->code = null;
    		$user->save();
    		return redirect()->route('login')->with('success','Your mobile number is active.'); 
    	}else{
    		return back()->with('warning','Verify code is not correct. Please try again'); 
    	}
    }
    public function verifyUser($token)
    {

      	$user = User::where('remember_token',$token)->first();
        if(!empty($user)){
            if($user->email_verified_at == null){
            	$user->email_verified_at = date('Y-m-d h:i:s');
            	$user->save();
            	return redirect()->route('login')->with('success','Your e-mail is verified. You can now login.'); 
            }else{
            	return redirect()->route('login')->with('success','Your e-mail is already verified. You can now login.'); 
            }
        }else{
            return redirect()->route('login')->with('warning','Activation link expired please check another mail.'); 
        }
    }
    public function resendVerifyCode(){    	
    	if($user = User::where('phone',request()->get('phone'))->first()){
    		$user->code = SendCode::sendCode($user->phone); 
            $user->save();
            return "success";
    	}else{
    		return "warning";
    	}
    }
}
