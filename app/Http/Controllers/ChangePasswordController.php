<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Auth;

class ChangePasswordController extends Controller
{
    // change password

    public function ShowChangePassword()
    {
        return view('auth.change_password');
    }

    public function change_password_insert(Request $request)
    {
        $request->validate([
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect('/')->with('success','Password update successfully');
    }
}
