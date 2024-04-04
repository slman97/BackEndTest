@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="col-md-6 offset-3 pt-4">
        <h3 class="text-center">User Product</h3>
            <div class="mb-3">
                    <table class="table-striped table-bordered text-center ">
                    <tr>
                    <th>Product id :</th>
                    <th>Caption :</th>
                    <th>Discription</th>
                    <th>Image</th>
                    <th>update Product</th>
                    <th>delete Product</th> 
                    </tr>
                    
                    @foreach ($Products as $Product)
                    <tr>
                    <td>{{$Product->id}}</td>
                    <td>{{$Product->caption}}</td>
                    <td>{{$Product->discription}}</td>
                    <td><a><img src="/storage/{{$Product->image}}" style="max-width: 200px;"></a></td>
                    <td> <form action ="{{ route('admin.ProductDestroy', $Product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input  onclick="return confirm('Are you sure you want to delete?')" type="submit" name="submit" value="delate Product" >
                    </form></td>
                    <td><a href="{{ route('admin.ProductEdit', $Product->id)}}" class="btn-primary col-md-2 col-form-label text-md-end">edit Product</a></td>  
                    </tr>
                    @endforeach
                </table>   
             
            </div>
    </div>
</div>
    
    
        
@endsection