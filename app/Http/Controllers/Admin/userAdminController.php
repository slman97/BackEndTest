<?php

namespace App\Http\Controllers\Admin;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\userStoreRequest;
use App\Http\Requests\user\userUpdateRequest;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class userAdminController extends Controller
{
    public function index(){
    
        $users = DB::table('users')->paginate(5);
       
        return view('Admin.user.showUser',compact('users'));
    }
    public function create(){
        return view('Admin.user.addUser');
   }
   public function store(userStoreRequest $request){
       $data = $request->validated();

       User::create([
           'user_type' => $data['user_type'],
           'firstname' => $data['firstname'],
           'lastname' => $data['lastname'],
           'phone' => $data['phone'],
           'email' => $data['email'],
           'password' => Hash::make($data['password']),
       ]);

       return redirect('/dashbord');
   }
   public function delete($id)
   {
       $user = user::find($id);
       $user->delete();
       return redirect('/dashbord');
   }
   public function edit(User $user, Request $request, $id){
    $user = User::find($id);
   return view ('Admin.user.editUser',compact('user'));
}
public function update(userUpdateRequest $request,$id){
    // Get current user
    $user = User::findOrFail($id);

    // Validate the data submitted by user
    $data = $request->validated();

    // Fill user model
    $user->fill([
        'user_type' => $data['user_type'],
        'firstname' => $data['firstname'],
        'lastname' => $data['lastname'],
        'phone' => $data['phone'],
        'email' => $data['email']
    ]);

    // Save user to database
    $user->save();

    // Redirect to route
    return redirect("/dashbord");
}
}
