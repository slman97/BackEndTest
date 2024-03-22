@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">User Post</h3>
            <div class="mb-3">
                    <table class="table-striped table-bordered text-center ">
                    <tr>
                    <th>user id :</th>
                    <th>post id :</th>
                    <th>Caption :</th>
                    <th>Discription</th>
                    <th>Image</th>
                    <th>update post</th>
                    <th>delete post</th> 
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                    <td>{{$post->user_id}}</td>
                    <td>{{$post->id}}</td>
                    <td>{{$post->caption}}</td>
                    <td>{{$post->discription}}</td>
                    <td><a><img src="/storage/{{$post->image}}" style="max-width: 200px;"></a></td>
                    <td> <form action ="{{ route('admin.PostDestroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input  onclick="return confirm('Are you sure you want to delete?')" type="submit" name="submit" value="delate post" >
                    </form></td>
                    <td><a href="{{ route('admin.postEdit', $post->id)}}" class="btn-primary col-md-2 col-form-label text-md-end">edit post</a></td>  
                    </tr>
                    @endforeach
                </table>   
                {{$posts -> links()}}
                
            </div>
    </div>
</div>
    
    
        
@endsection