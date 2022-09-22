@extends('layouts.auth_base')
@section('content')

<div class="register-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Bar</b>Manager</a>
      </div>
      <div class="card-body mb-3" >
        <p class="login-box-msg">Register a new membership</p>

        <form action="{{route('register_user')}}" method="post">
            @csrf
          <div class="row">
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="First Name" name="txt_first_name" value="{{old('txt_first_name')}}">
                    <span class="text-danger">@error('txt_first_name') {{ $message }} @enderror</span>
                </div>
            </div>
            <div class="col-6">
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Last Name" name="txt_last_name" value="{{old('txt_last_name')}}">
                    <span class="text-danger">@error('txt_last_name') {{ $message }} @enderror</span>
                </div>
            </div>
          </div>

          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email" name="txt_email" value="{{old('txt_email')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="txt_password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <span class="text-danger">@error('txt_password') {{ $message }} @enderror</span>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Retype password" name="txt_confirm_password" >
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            <span class="text-danger">@error('txt_confirm_password') {{ $message }} @enderror</span>
          </div>
          <div class="row">
            <div class="col-6">
              {{-- <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                 I agree to the <a href="#">terms</a>
                </label>
              </div> --}}
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="{{url('/')}}" class="text-center ">I already have a membership</a>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>

@endsection
