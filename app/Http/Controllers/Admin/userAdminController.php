<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\user\UserStoreRequest;
use App\Http\Requests\user\UserUpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\DataTables\userDataTable;

class UserAdminController extends Controller
{
    public function index(userDataTable $dataTable){
    
        return $dataTable->render("Admin.user.showUser");
    }
 
    public function create(){
        return view('Admin.user.addUser');
   }
   public function store(UserStoreRequest $request){
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
public function update(UserUpdateRequest $request,$id){
    $user = User::find($id);
        $data = $request->validated();
        $user->update(array_merge(
            $data,
        ));
        return redirect("/dashbord");
    
}
}
