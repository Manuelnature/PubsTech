@extends('layouts.base_template')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profile</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Profile</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @php
        $user_session_details = Session::get('user_session');
    @endphp

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-secondary card-outline">
                <div class="card-body box-profile">
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="dist/img/user2.jpg"
                        alt="User profile picture">
                    </div>

                    <h3 class="profile-username text-center">{{ $user_session_details->first_name }} {{ $user_session_details->last_name }}</h3>

                    <p class=" text-center">( {{ $user_session_details->role}} )</p>
                </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>

          <!-- /.col -->
          <div class="col-md-9">
            <div class="container-fluid">
                <div class="card card-secondary">
                  <div class="card-header">
                    <h3 class="card-title">Edit My Details </h3>

                    <div class="card-tools">
                      <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <form action="{{ route('update_user_profile') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <input type="hidden" class="form-control" id="user_id" name="user_id" value="{{$user_session_details->id}}">
                                <div class="form-group">
                                  <label for="txt_edit_first_name">First Name</label>
                                  <input type="text" class="form-control" id="txt_edit_first_name" name="txt_edit_first_name" value="{{ $user_session_details->first_name }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="txt_edit_last_name">Last Name</label>
                                  <input type="text" class="form-control" id="txt_edit_last_name" name="txt_edit_last_name" value="{{ $user_session_details->last_name }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="txt_edit_email">Email</label>
                                  <input type="text" class="form-control" id="txt_edit_email" name="txt_edit_email" value="{{ $user_session_details->email }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="txt_edit_phone_number">Phone Number</label>
                                  <input type="text" class="form-control" id="txt_edit_phone_number" name="txt_edit_phone_number" value="{{ $user_session_details->phone_number }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="txt_edit_date_employed">Date Employed</label>
                                  <input type="text" class="form-control" id="txt_edit_date_employed" name="txt_edit_date_employed" value="{{ $user_session_details->date_employed }}" disabled>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                  <label for="txt_edit_role">Role</label>
                                  <input type="text" class="form-control" id="txt_edit_role" name="txt_edit_role" value="{{ $user_session_details->role }}" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn btn-secondary">Update</button>
                            </div>
                        </div>
                    </form>
                  </div>
                  <!-- /.card-body -->
                  <div class="card-footer">
                    Edit Info About Me
                  </div>
                </div>
                <!-- /.card -->

              </div>
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

@endsection
