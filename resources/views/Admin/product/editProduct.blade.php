@extends('layouts.master')
@section('content')
<div class="container">
                
    <form action="/admin/Product/{{$product->id}}/update" class="form-stl" name="frm-login" method="post">
        @csrf
        @method('PATCH')
       
            <h3 class="col-md-4 col-form-label text-md-end" >Edit Product Information</h3>
        
            <label class="col-md-4 col-form-label text-md-end" for="user_id">user id</label>
            <input class="col-md-4 col-form-label text-md-end" id="user_id"  placeholder="user id*" type="text"class=" @error('user_id') is-invalid @enderror" name="user_id" autofocus>

             @error('user_id')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
        <br>
            <label class="col-md-4 col-form-label text-md-end" for="caption">caption</label>
            <input class="col-md-4 col-form-label text-md-end" id="caption"  placeholder="caption*" type="text"class=" @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" autofocus>

             @error('caption')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
        <br>
            <label class="col-md-4 col-form-label text-md-end" for="discription">discription</label>
            <input class="col-md-4 col-form-label text-md-end" id="discription" placeholder="discription*" type="text"class=" @error('discription') is-invalid @enderror" name="discription"autofocus>

             @error('discription')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
          @enderror
          <br>
          <label class="col-md-4 col-form-label text-md-end" for="image">image</label>
            <input class="col-md-4 col-form-label text-md-end" id="image" placeholder="image*" type="file"class=" @error('image') is-invalid @enderror" name="image"autofocus>

             @error('image')
          <span class="invalid-feedback" role="alert">
           <strong style="color : red">{{ $message }}</strong>
          </span>
             @enderror
             <br>
                <div class="row pt-4">
                    
                    <button class="btn-primary col-md-2 col-form-label text-md-end"> {{__('Save Product')}} </button>
                </div>
    </form>
</div>
@endsection