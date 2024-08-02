<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;

class ProfileController extends Controller
{
    public function customLogin(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        $user_verify = User::where('email', $request->email)->first();


        if ($user_verify) {
            if (Hash::check($request->password, $user_verify->password)) {
                Auth::login($user_verify);
                if (Auth::user()->role == "1") {
                    return redirect()->route('admin.dashboard')->with('success', 'You are login successfully!');
                }
            } else {
                return redirect()->back()->with('error', 'Invalid password!');
            }
        } else {
            return redirect()->back()->with('error', 'User not found!');
        }
    }


    public function logout(Request $request) {
        Auth::logout();
        return redirect()->route('admin.sign');
      }
}