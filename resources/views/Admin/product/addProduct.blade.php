@extends('layouts.master')
@section('content')
<div class="card-body">
    <form method="POST" action="" enctype="multipart/form-data" id="product">
        @csrf
        <div class="row mb-3">
            <label for="user_id" class="col-md-4 col-form-label text-md-end">User id</label>

            <div class="col-md-6">
                <input id="user_id" type="text" class="form-control" name="user_id"   autocomplete="user_id" autofocus>

                <small id="user_id_error" class="form-text text-danger"></small>
            </div>
        </div>
        <div class="row mb-3">
            <label for="caption" class="col-md-4 col-form-label text-md-end">Product caption</label>

            <div class="col-md-6">
                <input id="caption" type="text" class="form-control " name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>

                <small id="caption_error" class="form-text text-danger"></small>
            </div>
        </div>

        <div class="row mb-3">
            <label for="discription" class="col-md-4 col-form-label text-md-end">{{ __('discription') }}</label>

            <div class="col-md-6">
                <input id="discription" type="text" class="form-control " name="discription"  autocomplete="current-discription">

                <small id="discription_error" class="form-text text-danger"></small>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-6 offset-md-4">
                <div class="form-check">
                    <input class="form-check-input" type="file" name="image" id="image">

                    <label class="form-check-label" for="image">
                      add Image
                    </label>
                    <small id="image_error" class="form-text text-danger"></small>
                </div>
            </div>
        </div>

        <div class="row mb-0">
            <div class="col-md-8 offset-md-4">
                <button id= "save" class="btn btn-primary">
                    add product
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@section('script')
<script>
//When you press the button
    $(document).on('click', '#save', function (e) {
        e.preventDefault();
// Delete previous errors
        $('#user_id_error').text('');
        $('#caption_error').text('');
        $('#discription_error').text('');
        $('#image_error').text('');
        
        var formData = new FormData($('#product')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('admin.storeProduct')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                    window.location.href = "{{route('admin.showProduct')}}";
                

            }, error: function (reject) {
                var response = $.parseJSON(reject.responseText);
                $.each(response.errors, function (key, val) {
                    $("#" + key + "_error").text(val[0]);
                });
            }
        });
    });


</script>
@endsection