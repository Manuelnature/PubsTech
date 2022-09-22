@extends('layouts.auth_base')
@section('content')

<div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="" class="h1"><b>Bar</b>Manager</a>
      </div>
      <div class="card-body mb-5">
        <p class="login-box-msg">Sign in to get access</p>

        <form action="{{route('login_user')}}" method="post">
            @csrf
          {{-- <div class="input-group mb-2">
            <input type="email" class="form-control" placeholder="Email" name="txt_email" value="{{old('txt_email')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div> --}}
          <div class="input-group mb-2">
            <input type="name" class="form-control" placeholder="Username" name="txt_username" value="{{old('txt_username')}}">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <span class="text-danger mb-2">@error('txt_username') {{ $message }} @enderror</span>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password" name="txt_password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <span class="text-danger mb-2">@error('txt_password') {{ $message }} @enderror</span>
          <div class="row">
            <div class="col-6">
              {{-- <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div> --}}
            </div>
            <!-- /.col -->
            <div class="col-6">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mb-0">
          <a href="{{url('register')}}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  </div>

@endsection
