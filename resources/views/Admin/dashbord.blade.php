@extends('layouts.master')
@section('content')
<div class="row">
<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> 
                <a>Product count</a>
            </h4>
        </div>

        <div class="card-body">
            <a >{{$productCount}}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> 
                <a>User count</a>
            </h4>
        </div>

        <div class="card-body">
            <a >{{$userCount}}</a>
        </div>
    </div>
    <div class="card">
        <div class="card-header">
            <h4 class="card-title"> 
                <a>Admin count</a>
            </h4>
        </div>

        <div class="card-body">
            <a >{{$adminCount}}</a>
        </div>
    </div>
</div>
</div>
@endsection



