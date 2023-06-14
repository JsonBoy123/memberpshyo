<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\SendCode;
use Mail;
use App\Mail\VerifyMail;
use App\Models\GlobalTag;
use App\Models\Address;
use Modules\Member\Entities\Member;

use Illuminate\Support\Facades\Notification;
use App\Notifications\NotifyMessage;
use App\Role;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/verify';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm()
    {
    	$roles = Role::whereNotIn('id',['1','3','4','5'])->get();
        return view('auth.register',compact('roles'));
    }


    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:100'],
            'middle_name' => ['nullable', 'string', 'max:100'],
            'last_name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required','string','max:11','min:10', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function register(Request $request)
    {
        //return $request->status;
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        // $this->guard()->login($user);
        //return $this->create($request->all());

        return $this->registered($request, $user)
                        ?: redirect('/login')->with('success','We sent activation link, Check your email and click on the link to verify your email');
    }
    
    protected function create(array $data)
    {
        $user =  User::create([
            'name' => $data['first_name']." ".$data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password'])
        ]);


        if($user){
            $user->attachRole($data['member_type']);
           // $user->code = SendCode::sendCode($user->phone);                
            // $user->code = "1234";                
            $user->remember_token = Str::random(40);
            $user->save();
            Mail::to($user->email)->send(new VerifyMail($user));
            if($data['member_type'] =='2'){
                $data['old_or_new'] = $data['status'];

                if($data['status'] !=0){
                    $data['iap_no'] = 'L-'.$data['iap_no'];
                    $data['services'] = json_encode(['show' => ['2','5','14'],'apply' => []]);

                    // $message = [
                    //     'id'     => $member->id,
                    //     'title'  => 'IAP old member registered. IAP no is '. $member->iap_no,
                    //     'message'=> member_name($member).' member registered',
                    //     'link'   => '/members_list',
                    // ];
                    // $users = User::whereRoleIs('member_admin')->get();
                    // Notification::send($users, new NotifyMessage($message));
                }else{
                    $data['services'] = json_encode(['show' => ['2','5','10','11','12','13'],'apply' => []]);
                }
                $member = member_create($user,$data);
            }
            // else{
            //     $message = [
            //         'id'     => $user->id,
            //         'title'  => 'New Member Registered ',
            //         'message'=> $user->first_name.($user->middle_name !=null ? ' '.$user->middle_name : '' )." ". $user->last_name .' member registered.',
            //         'link'   => '/members_list',
            //     ];
            // }
           
        }
        return $user;
    }


    // public function verifyUser($token)
    // {
        
    //   $verifyUser = VerifyUser::where('token', $token)->first();

    //     if(isset($verifyUser) ){
    //         $user = $verifyUser->user;
    //         if($user->status == 'P') {
    //             $verifyUser->user->status = 'A';
    //             $verifyUser->user->save();
    //             $success = 'Your e-mail is verified. You can now login.';
    //         }else{
    //             $success = "Your e-mail is already verified. You can now login.";
    //         }
    //     }else{
    //         return redirect('/login')->with('warning', "Sorry your email cannot be identified.");
    //     }

    //     return redirect('/login')->with('success', $success);
    // }

}
