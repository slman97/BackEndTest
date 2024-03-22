<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\Post;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\userStoreRequest;
use App\Http\Requests\post\postStoreRequest;
use App\Http\Requests\api\post\postUpdateRequest;
use App\Http\Requests\api\user\userUpdateRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class adminController extends Controller
{
    public function userspost(Request $request,$id)
    {
        $post = DB::table('posts')->where('user_id', $id)->get();

        return response()->json([
            'status' => true,
            'post' => $post
        ], 200);
    }

    public function allUserPost(Request $request)
    {
        $post = DB::table('posts')->get();

        return response()->json([
            'status' => true,
            'post' => $post
        ], 200);
        
    }

    public function addUser(userStoreRequest $request)
    {
        $data = $request->validated();
        $user = User::create([
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

    public function addPost(postStoreRequest $request)
    {
       
        $data = $request->validated();
        $imagePath = $data['image']->store('uploads', 'public');
        $post = Post::create([
            'user_id' =>$data['user_id'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagePath,
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Post Created Successfully',
            ]);
    }

    public function editUser(userUpdateRequest $request)
    {
       
        $data = $request->validated();
        $id = $data['id'];
        $user = User::find($id);
        $user->fill([
            'user_type' =>$data['user_type'],
            'firstname' => $data['firstname'],
            'lastname' => $data['lastname'],
            'phone' => $data['phone'],
            'email' => $data['email'],
        ]);

        // Save user to database
        $user->save();
        return response()->json([
            'status' => true,
            'message' => 'User edit Successfully',
            ]);
    }

    public function editPost(postUpdateRequest $request)
    {
       
        $data = $request->validated();
        $id = $data['id'];
        $post = Post::findOrfail($id);
        $imagePath = $data['image']->store('uploads', 'public');
        $post->fill([
            'user_id' =>$data['user_id'],
            'caption' => $data['caption'],
            'discription' => $data['discription'],
            'image' => $imagePath,
        ]);

        // Save post to database
        $post->save();

        return response()->json([
            'status' => true,
            'message' => 'Post edit Successfully',
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

    public function deletepost(Request $request)
    {
       $id = $request->id;
       $post = Post::findOrfail($id);
       $post->delete();
       return response()->json([
        'status' => true,
        'message' => 'Post delete Successfully',
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
