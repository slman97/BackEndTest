@extends('layouts.app')
@section('content')

<div class="card-body">
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">First Name :</a>
            <a  class="col-md-4 col-form-label text-md-end">{{Auth::user()->firstname}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">Last Name :</a>
            <a class="col-md-4 col-form-label text-md-end">{{Auth::user()->lastname}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">phone :</a>
            <a class="col-md-4 col-form-label text-md-end">{{Auth::user()->phone}}</a>
        </div>
        <div class="row mb-3">
            <a  class="col-md-4 col-form-label text-md-end">email :</a>
            <a class="col-md-4 col-form-label text-md-end">{{Auth::user()->email}}</a>
        </div>
        <div class="row mb-3">
            <a  class="btn-primary col-md-2 col-form-label text-md-end" href="/p/show/{{Auth::user()->id}}">View {{Auth::user()->profile->name}} all products</a>
            <div class="col-md-2"></div>
            <a  class=" btn-primary col-md-2 col-form-label text-md-end" href="{{route('changePassword')}}">update password</a>
        </div>
        
       
      
</div>
@endsection
