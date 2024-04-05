@extends('layouts.master')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">add user</div>

                <div class="card-body">
                    <form method="POST" action="/admin/user" id="adduser">
                        @csrf
                        <div class="row mb-3">
                            <label for="user_type" class="col-md-4 col-form-label text-md-end">user type</label>

                            <div class="col-md-6">
                                <input id="user_type" type="text" class="form-control @error('user_type') is-invalid @enderror" name="user_type" autocomplete="user_type" autofocus>

                                <small id="user_type_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="firstname" class="col-md-4 col-form-label text-md-end">{{ __('firstname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}"  autocomplete="firstname" autofocus>

                                <small id="firstname_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="lastname" class="col-md-4 col-form-label text-md-end">{{ __('LastName') }}</label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control " name="lastname" value="{{ old('lastname') }}"  autocomplete="lastname" autofocus>
                                <small id="lastname_error" class="form-text text-danger"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control " name="email" value="{{ old('email') }}"  autocomplete="email">
                                <small id="email_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <label for="phone" class="col-md-4 col-form-label text-md-end">{{ __('phone') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="number" class="form-control " name="phone" value="{{ old('phone') }}"  autocomplete="phone" autofocus>
                                <small id="phone_error" class="form-text text-danger"></small>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control " name="password"  autocomplete="new-password">
                                <small id="password_error" class="form-text text-danger"></small>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"  autocomplete="new-password">
                                <small id="password-confirm_error" class="form-text text-danger"></small>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button id="save" class="btn btn-primary">
                                    add user
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@section('script')
<script>
//When you press the button
    $(document).on('click', '#save', function (e) {
        e.preventDefault();
// Delete previous errors
        $('#user_type_error').text('');
        $('#firstname_error').text('');
        $('#lastname_error').text('');
        $('#email_error').text('');
        $('#phone_error').text('');
        $('#password_error').text('');
        $('#password-confirm_error').text('');
        
        var formData = new FormData($('#adduser')[0]);

        $.ajax({
            type: 'post',
            enctype: 'multipart/form-data',
            url: "{{route('admin.storeUser')}}",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function (data) {
                    window.location.href = "{{route('admin.showUser')}}";
                

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
