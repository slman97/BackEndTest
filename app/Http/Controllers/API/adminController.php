<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Product;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\userStoreRequest;
use App\Http\Requests\product\productStoreRequest;
use App\Http\Requests\api\product\ProductUpdateRequest;
use App\Http\Requests\api\user\userUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function usersProduct(Request $request,$id)
    {
        $product = Product::all()->where('user_id', $id);

        return response()->json([
            'status' => true,
            'produc' => $product
        ], 200);
    }

    public function allUserProduct(Request $request)
    {
        $product = Product::all();

        return response()->json([
            'status' => true,
            'product' => $product
        ], 200);
        
    }

    public function addUser(userStoreRequest $request)
    {
        $data = $request->validated();
        User::create([
            'user_type' =>$data['user_type'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
        return response()->json([
            'status' => true,
            'message' => 'User Created Successfully',
            ]);
       
    }

    public function addProduct(ProductStoreRequest $request)
    {
       
        $data = $request->validated();
        $imagePath = $data['image']->store('uploads', 'public');
        Product::create([
            'user_id' =>$data['user_id'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagePath,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'product Created Successfully',
            ]);
    }

    public function editUser(userUpdateRequest $request)
    {
       
        $data = $request->validated();
        $id = $data['id'];
        $user = User::find($id);
        $user->update([
            'user_type' =>$data['user_type'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        return response()->json([
            'status' => true,
            'message' => 'User edit Successfully',
            ]);
    }

    public function editProduct(ProductUpdateRequest $request)
    {
       
        $data = $request->validated();
        $id = $data['id'];
        $product = Product::findOrfail($id);
        $imagepath = $data['image']->store('uploads', 'public');
        $product->update(
            [
            'user_id' => $data['user_id'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagepath
            ]
        
        );

        return response()->json([
            'status' => true,
            'message' => 'product edit Successfully',
            ]);
    }

    public function deleteuser(Request $request)
    {
       $id = $request->id;
       $user = User::findOrfail($id);
       $user->delete();
       return response()->json([
        'status' => true,
        'message' => 'user delete Successfully',
        ]);
    }

    public function deleteProduct(Request $request)
    {
       $id = $request->id;
       $product = Product::findOrfail($id);
       $product->delete();
       return response()->json([
        'status' => true,
        'message' => 'product delete Successfully',
        ]);
    }
    
    public function allUser(Request $request)
    {
        $user = DB::table('users')->get();

        return response()->json([
            'status' => true,
            'user' => $user
        ], 200);
        
    }
    public function addProfile(Request $request)
    {
        $id = $request->user_id;
        
        $user = User::find($id);
        if (is_null($user)){
            return response()->json([
                'status' => false,
                'message' => 'no user',
                ]);
        }
        if (is_null($user->profile)){
              Profile::create([
            'user_id' => $user->id,
            'name' => $user->firstname.$user->lastname,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Profile Created Successfully',
            ]);
        }
        return response()->json([
            'status' => false,
            'message' => 'user have already Profile',
            ]);
      
        
    }

}
