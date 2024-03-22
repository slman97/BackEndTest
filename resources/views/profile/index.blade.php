@extends('layouts.app')
@section('content')

<div class="card-body">
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">First Name :</a>
            <a  class="col-md-4 col-form-label text-md-end">{{$user->firstname}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">Last Name :</a>
            <a class="col-md-4 col-form-label text-md-end">{{$user->lastname}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">phone :</a>
            <a class="col-md-4 col-form-label text-md-end">{{$user->phone}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">email :</a>
            <a class="col-md-4 col-form-label text-md-end">{{$user->email}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">post Count :</a>
            <a class="col-md-4 col-form-label text-md-end">{{$postCount}}</a>
        </div>
        @if(auth::user()->id == $user->id)
        <div class="row mb-3">
            <a  class="btn-primary col-md-2 col-form-label text-md-end" href="/p/show/{{$user->id}}">View {{$user->profile->name}} all posts</a>
            <div class="col-md-2"></div>
            <a  class=" btn-primary col-md-2 col-form-label text-md-end" href="{{route('changePassword')}}">update password</a>
        </div>
        @endif
       
      
</div>
@endsection
