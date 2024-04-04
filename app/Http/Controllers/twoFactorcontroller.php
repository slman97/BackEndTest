<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Support\Facades\Hash;

class TwoFactorcontroller extends Controller
{
    public function index(){
        $user = auth()->user();
        if($user->code == null){
            return view('home');
         }
         $user->notify(new SendTwoFactorCode());
        return view('auth.verify');
    }
    public function store(Request $request){
        
        $user = auth()->user();
        if($request->input('code') == $user->code){
          $user ->code = null;
          $user->save();
          return view('home');  
        }
        return redirect()->back()->withErrors(['code' => 'the code is incorrect']);
        
    }
    public function forgotpassword(Request $request){
        $user = User::where('email',$request->email)->first();
        $user_id =$user->id;
        $user->code = rand(1000 , 9999);
        $user->save();
        $user->notify(new SendTwoFactorCode());
        return view('auth.passwords.verify',compact('user_id'));
    }
    public function resetcodecheck(Request $request,$user_id){
        $user = User::where('id',$user_id)->first();
        if($user->code == $request->code){
            return view('auth.passwords.reset');
        }
        return redirect()->back()->withErrors(['code','the code isnot correct']);
    }
    public function resetpassword(Request $request){
        $user = User::where('email',$request->email)->first();
        $data = $data = request()->validate([
            'email' => ['string', 'max:255','required'],
            'password' => ['string', 'max:255', 'min:8','required','confirmed'],
        ]);
        $user->fill([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'code' => null,
        ]);
        $user->save();
        return route('login');
       
    }
}
