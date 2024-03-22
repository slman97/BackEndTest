<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
class Admincontroller extends Controller
{
    public function dashInfo(){
        $postCount = DB::table('posts')->count();
        $userCount = DB::table('users')->count();
        $adminCount = DB::table('users')->where('user_type','admin')->count();

        return view('Admin.dashbord',compact('postCount','userCount','adminCount'));
    }
    
 
 public function userPost(Request $request,$id){
 $user = User::find($id);
 $posts = DB::table('posts')->where('user_id',$user->id)->paginate(5);

 return view('Admin.userPost',compact('user','posts'));
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
