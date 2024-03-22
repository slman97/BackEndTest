@extends('layouts.master')
@section('content')
<div class="container">
                
    <form action="/user/{{$user->id}}/update" class="form-stl" name="frm-login" method="post">
        @csrf
        @method('PATCH')
       
            <h3 class="col-md-4 col-form-label text-md-end" >Edit User Information</h3>
            <h4 class="col-md-4 col-form-label text-md-end" >User Information</h4>
        
            <label class="col-md-4 col-form-label text-md-end" for="user_type">user type</label>
            <input class="col-md-4 col-form-label text-md-end" id="user_type"  placeholder="user type*" type="text"class=" @error('user_type') is-invalid @enderror" name="user_type" autofocus>

             @error('user_type')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
        <br>
            <label class="col-md-4 col-form-label text-md-end" for="firstname">first name</label>
            <input class="col-md-4 col-form-label text-md-end" id="firstname"  placeholder="first name*" type="text"class=" @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" autofocus>

             @error('firstname')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
        <br>
            <label class="col-md-4 col-form-label text-md-end" for="lastname">last name</label>
            <input class="col-md-4 col-form-label text-md-end" id="lastname" placeholder="last name*" type="text"class=" @error('lastname') is-invalid @enderror" name="lastname"autofocus>

             @error('lastname')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
          @enderror
          <br>
          <label class="col-md-4 col-form-label text-md-end" for="email">email</label>
            <input class="col-md-4 col-form-label text-md-end" id="email" placeholder="email*" type="email"class=" @error('email') is-invalid @enderror" name="email"autofocus>

             @error('email')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
             <br>
             <label class="col-md-4 col-form-label text-md-end" for="phone">phone</label>
             <input class="col-md-4 col-form-label text-md-end" id="phone" placeholder="phone*" type="text"class=" @error('phone') is-invalid @enderror" name="phone"autofocus>
 
              @error('phone')
           <span class="invalid-feedback" role="alert">
            <strong style="color : red">{{ $message }}</strong>
           </span>
              @enderror
                <div class="row pt-4">
                    
                    <button class="btn-primary col-md-2 col-form-label text-md-end"> {{__('Save profile')}} </button>
                </div>
    </form>
</div>
@endsection