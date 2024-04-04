<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\Auth\RigisterByPhoneRequest;

class RigisterByPhoneController extends Controller
{
    public function registerByPhone(){
        return view('Auth/RegisterByPhone');
    }

    public function create(RigisterByPhoneRequest $request)
    {
        $data = $request->validated();
         User::create([
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return redirect('/login');
    }
}
