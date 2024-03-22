@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">All Post</h3>
            <div class="mb-3">
                    <table class="table-striped table-bordered text-center ">
                    <tr>
                    <th>Caption :</th>
                    <th>Discription</th>
                    <th>Image</th>
                    </tr>
                    
                    @foreach ($posts as $post)
                    <tr>
                    <td>{{$post->caption}}</td>
                    <td>{{$post->discription}}</td>
                    <td><a><img src="/storage/{{$post->image}}" style="max-width: 200px;"></a></td>
                    </tr>
                    @endforeach
                </table>   
                {{$posts -> links()}}
                
            </div>
    </div>
</div>
    
    
        
@endsection