@extends('layouts.app')
@section('content')
<div class="card-body">
    <form method="POST" action="/p" enctype="multipart/form-data">
        @csrf

        <div class="row mb-3">
            <label for="caption" class="col-md-4 col-form-label text-md-end">Post caption</label>

            <div class="col-md-6">
                <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}" required autocomplete="caption" autofocus>

                @error('caption')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <label for="discription" class="col-md-4 col-form-label text-md-end">{{ __('discription') }}</label>

            <div class="col-md-6">
                <input id="discription" type="text" class="form-control @error('discription') is-invalid @enderror" name="discription" required autocomplete="current-discription">

                @error('discription')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="file" name="image" id="image">

                    <label class="form-check-label" for="image">
                      add Image
                    </label>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">
                    add product
                </button>
            </div>
        </div>
    </form>
</div>
@endsection