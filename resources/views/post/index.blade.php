@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">User Post</h3>
            <div class="mb-3">
                    <table class="table-striped table-bordered text-center ">
                    <tr>
                    <th>Caption :</th>
                    <th>Discription</th>
                    <th>Image</th>
                    <th>update post</th>
                    <th>delete post</th> 
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                       <td>{{$post->caption}}</td>
                    <td>{{$post->discription}}</td>
                    <td><a><img src="/storage/{{$post->image}}" style="max-width: 200px;"></a></td>
                    @if ($post->user_id == Auth::user()->id)
                       
                    <td> <form action ="{{ route('post.destroy', $post->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input  onclick="return confirm('Are you sure you want to delete?')" type="submit" name="submit" value="delate post" >
                    </form></td>
                    <td><a href="{{ route('post.edit', $post->id)}}" class="btn-primary col-md-2 col-form-label text-md-end">edit post</a></td>  
                    
                    @endif
                    
                    </tr>
                    @endforeach
                </table>   
                {{$posts -> links()}}
                
            </div>
    </div>
</div>
    
    
        
@endsection