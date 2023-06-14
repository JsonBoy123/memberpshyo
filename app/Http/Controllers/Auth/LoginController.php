<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\SendCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    public function login(Request $request)
    {
        $this->validateLogin($request);

        if(method_exists($this, 'hasTooManyLoginAttempts') &&
            $this->hasTooManyLoginAttempts($request)){
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }
        if($this->guard()->validate($this->credentials($request))){

            $user = $this->guard()->getLastAttempted();

            // if(is_numeric($request->get('email'))){
            //     if($user->phone_verified_at !=null && $this->attemptLogin($request)) {

            //         return $this->sendLoginResponse($request);
                
            //     }else{
            //        $user->code = SendCode::sendCode($user->phone); 
                
            //        if($user->save()){
            //             return redirect('/verify?phone='.$request->phone)->with('success','We sent activation code, Check your mobile number');
            //        }
            //     }
            // }else
            if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
                if($user->email_verified_at !=null && $this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);                
                }else{

                    $this->incrementLoginAttempts($request);
                    //$user->code = SendCode::sendCode($user->phone);
                    if($user->save()){
                       return redirect()->route('login')->with('warning','We already sent activation link, Check your email and click on the link to verify your email');
                    }
                }
            }
        }

      
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
    }

    protected function credentials(Request $request)
    {
      // if(is_numeric($request->get('email'))){
      //   return ['phone'=>$request->get('email'),'password'=>$request->get('password')];
      // }
      // else
      if (filter_var($request->get('email'), FILTER_VALIDATE_EMAIL)) {
        return ['email' => $request->get('email'), 'password'=>$request->get('password')];
      }
      return ['email' => $request->get('email'), 'password'=>$request->get('password')];
    }
}
