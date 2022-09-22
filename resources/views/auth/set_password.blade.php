@extends('layouts.auth_base')
@section('content')

<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Bar</b>Manager</a>
      </div>
      <div class="card-body mb-5">
        <p class="login-box-msg">{{ $set_password_user_details[0]->first_name }} {{ $set_password_user_details[0]->last_name }}</p>
        <p class="login-box-msg">Set Up Your Password Here</p>

        <form action="{{route('set_user_password')}}" method="post">
            @csrf
            <input type="hidden" name="txt_set_password_id" value="{{ $set_password_user_details[0]->id }}">
            <input type="hidden" name="txt_set_password_email" value="{{ $set_password_user_details[0]->email }}">
            <input type="hidden" name="txt_set_password_username" value="{{ $set_password_user_details[0]->username }}">

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Password" name="txt_set_password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <span class="text-danger mb-2">@error('txt_set_password') {{ $message }} @enderror</span>

            <div class="input-group mb-3">
                <input type="password" class="form-control" placeholder="Confirm Password" name="txt_confirm_set_password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
          <span class="text-danger mb-2">@error('txt_confirm_set_password') {{ $message }} @enderror</span>
          <div class="row">
            <div class="col-6">

            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Set Password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
