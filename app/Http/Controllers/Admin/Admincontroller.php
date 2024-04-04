<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;

class Admincontroller extends Controller
{
    public function dashInfo(){
        $productCount = Product::all()->count();
        $userCount = User::all()->count();
        $adminCount = User::where('user_type','admin')->count();

        return view('Admin.dashbord',compact('productCount','userCount','adminCount'));
    }
    
 
 public function userProduct(Request $request,$id){
 $user = User::find($id);

 $Products = Product::all()->where('user_id', $user->id);

 return view('Admin.userProduct',compact('user','Products'));
 }
 public function addUserProfile($user_id)
    {
        $user = User::find($user_id);

        Profile::create([
            'user_id' => $user->id,
            'name' => $user->firstname.$user->lastname,
        ]);
        return redirect('/dashbord');
    }
}
