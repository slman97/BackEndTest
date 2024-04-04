<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\SendTwoFactorCode;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    /**
     * Create User
     * @param Request $request
     * @return User 
     */
    public function registerUser(Request $request)
    {
        try {
            //Validated
            $validateUser = Validator::make($request->all(), 
            [
                'firstname' => ['required', 'string', 'max:255'],
                'lastname' => ['required', 'string', 'max:255'],
                'phone' => ['string', 'max:10'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8','confirmed'],
            ]);

            if($validateUser->fails()){
                return response()->json([
                    'status' => false,
                    'message' => 'validation error',
                    'errors' => $validateUser->errors()
                ], 401);
            }

            $user = User::create([
                'user_type' =>'',
                'firstname' => $request['firstname'],
                'lastname' => $request['lastname'],
                'phone' => $request['phone'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'code' => rand(1000 , 9999)
            ]);
            $user->notify(new SendTwoFactorCode());
            return response()->json([
                'status' => true,
                'message' => 'User Created Successfully check youer email for verify code',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }
    }
     public function userVerifyCodeCheck (Request $request){
        $user =  auth('sanctum')->user();
        if($request->input('code') == $user->code){
          $user ->code = null;
          $user->save();
          return response()->json([
            'status' => true,
             'message' => 'the code is correct',
          ]);  
        }
        return response()->json([
            'status' => true,
             'message' => 'the code is incorrect',
          ]);
     }
     public function forgotPassword(Request $request){
        $user = User::where('email',$request->email)->first();
        $user->code = rand(1000 , 9999);
        $user->save();
        $user->notify(new SendTwoFactorCode());
        return response()->json([
            'status' => true,
            'message' => 'the code is send',
            'token' => $user->createToken("API TOKEN")->plainTextToken
          ]); 
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
        return response()->json([
            'status' => true,
            'message' => 'the password is change correct',
            'token' => $user->createToken("API TOKEN")->plainTextToken
          ]); 
       
    }

    /**
     * Login The User
     * @param Request $request
     * @return User
     */
    public function loginUser(Request $request)
    {
        
            $validateUser = Validator::make($request->all(), 
            [
                'emailOrPhone' => 'required',
                'password' => 'required'
            ]);

            $login =request()->input('emailOrPhone');
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
            $user = User::where($field, $login)->first();

            return response()->json([
                'status' => true,
                'message' => 'User Logged In Successfully',
                'token' => $user->createToken("API TOKEN")->plainTextToken
            ], 200);

        
    }
    public function logoutUser(Request $request)
    {
        $user = $request->user();
        $user->tokens()->delete();
        return response()->noContent();
    }

    public function userProduct(Request $request)
    {
        $user = $request->user();
        $product = Product::all()->where('user_id', $user->id);
        $psotCount = $product->count();

        return response()->json([
            'status' => true,
            'message' => 'User product '.$psotCount,
            'post' => $product
        ], 200);
    }


    public function editPassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ]);

        $user = $request->user();
 
        // The passwords matches
        if (!Hash::check($request->get('current_password'), $user->password)) 
        {
            return response()->json([
                'status' => false,
                'message' => 'Current Password is Invalid',
            ], 200);
        }
 
        // Current password and new password same
        if (strcmp($request->get('current_password'), $request->new_password) == 0) 
        {
            return response()->json([
                'status' => false,
                'message' => 'New Password cannot be same as your current password.'
            ], 200);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'status' => true,
            'message' => 'User password change Successfully',
            'user' => $user
        ], 200);
    }
}