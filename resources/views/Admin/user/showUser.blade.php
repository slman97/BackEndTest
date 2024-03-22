@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">User</h3>
            <div class="mb-3">
                    <table class="table-striped table-bordered text-center ">
                    <tr>
                    <th>User id :</th>
                    <th>User type :</th>
                    <th>First name</th>
                    <th>Larst name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>delet user</th>
                    <th>update user</th>
                    <th>user post</th>
                    <th>add user profile</th>
                    </tr>
                    
                    @foreach ($users as $user)
                    <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->user_type}}</td>
                    <td>{{$user->firstname}}</td>
                    <td>{{$user->lastname}}</td>
                    <td>{{$user->phone}}</td>
                    <td>{{$user->email}}</td>
                    
                    <td> 
                        @if ($user->user_type != 'admin')
                        <form action ="/admin/destroyUser/{{$user->id}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input  onclick="return confirm('Are you sure you want to delete?')" type="submit" name="submit" value="delate user" >
                    </form>
                     @endif
                </td>
                   
                    <td><a href="/user/{{$user->id}}/edit" class="btn-primary col-md-2 col-form-label text-md-end">edit user</a></td>  
                    <td><a href="/user/{{$user->id}}/post" class="btn-primary col-md-2 col-form-label text-md-end">user post</a></td>    
                    <td> 
                        
                        @if (is_null(App\Models\User::find($user->id)->profile)) 
                        <form action ="/admin/adduserprofile/{{$user->id}}" method="POST">
                           @csrf
                           <input  type="submit" name="submit" value="add user profile" >
                        </form>
                        @else
                       <a>user have profile</a>
                     @endif
                </td>
                </tr>
                    @endforeach
                </table>   
                {{$users -> links()}}
                
            </div>
    </div>
</div>
    
    
        
@endsection