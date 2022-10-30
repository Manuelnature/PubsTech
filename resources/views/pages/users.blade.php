@extends('layouts.base_template')
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            {{-- <h1>Advanced Form</h1> --}}
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-user">
                    Add New User
                </button>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->

      <div class="modal fade" id="add-user" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('add_user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_first_name">Firstname</label>
                                    <input type="text" class="form-control" id="txt_first_name" name="txt_first_name" value="{{ old('txt_first_name') }}">
                                    <span class="text-danger">@error('txt_first_name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_last_name">Last Name</label>
                                    <input type="text" class="form-control" id="txt_last_name" name="txt_last_name" value="{{ old('txt_last_name') }}">
                                </div>
                                <span class="text-danger">@error('txt_last_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_email">Email</label>
                                    <input type="email" class="form-control" id="txt_email" name="txt_email" value="{{ old('txt_email') }}">
                                </div>
                                <span class="text-danger">@error('txt_email') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_username">Username</label>
                                        <input type="text" class="form-control" id="txt_username" name="txt_username" value="{{ old('txt_username') }}"/>
                                    <span class="text-danger">@error('txt_username') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="txt_phone_number" name="txt_phone_number" value="{{ old('txt_phone_number') }}"/>
                                    <span class="text-danger">@error('txt_phone_number') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_role">Role</label>
                                    <select class="form-control" style="width: 100%;" id="txt_role"  name="txt_role" value="{{ old('txt_role') }}" >
                                        <option selected disabled>Select User Role</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Retailer">Retailer</option>
                                    </select>
                                    <span class="text-danger">@error('txt_role') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_date_employed">Date Employed</label>
                                    <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                        <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="txt_date_employed"/>
                                        <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                        </div>
                                    </div>
                                    <span class="text-danger">@error('txt_date_employed') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>

    <!-- Main content -->


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">User Info</h3>
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
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Date Employed</th>
                        <th>Date Registered</th>
                        <th>Registered By</th>
                        <th>Updated By</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_users as $user)
                        <tr>
                            <td>{{ ucwords($user->first_name ) }}</td>
                            <td> {{ ucwords($user->last_name) }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->role }}</td>
                            <td>{{ $user->date_employed }}</td>
                            <td>{{ $user->date_registered }}</td>
                            <td> {{ ucwords($user->registered_by) }}</td>
                            <td>
                                @if ($user->updated_by == "" || $user->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$user->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($user->updated_at == "" || $user->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$user->updated_at}}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="text-primary"
                                    onclick="edit_user(this)"
                                    data-toggle="modal"
                                    data-target="#edit-user"
                                    data-id="{{ $user->id }}"
                                    data-first_name="{{ $user->first_name }}"
                                    data-last_name="{{ $user->last_name }}"
                                    data-email="{{ $user->email }}"
                                    data-username="{{ $user->username }}"
                                    data-phone_number="{{ $user->phone_number }}"
                                    data-role="{{ $user->role }}"
                                >
                                <i class="fas fa-edit"></i>
                                </a>
                                <a  class="text-danger"
                                    onclick="delete_user(this)"
                                    data-toggle="modal"
                                    data-target="#delete-user"
                                    data-id="{{ $user->id }}"
                                    data-first_name="{{ $user->first_name }}"
                                    data-last_name="{{ $user->last_name }}"
                                >
                                <i class="fas fa-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->



      <div class="modal fade" id="edit-user" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="user_id" name="user_id">
                                    <label for="txt_edit_first_name">Firstname</label>
                                    <input type="text" class="form-control" id="txt_edit_first_name" name="txt_edit_first_name">

                                    {{-- <input class="form-control" name="name" type="text" id="pass_id"> --}}
                                    <span class="text-danger">@error('txt_edit_first_name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_last_name">Last Name</label>
                                    <input type="text" class="form-control" id="txt_edit_last_name" name="txt_edit_last_name">
                                </div>
                                <span class="text-danger">@error('txt_edit_last_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_email">Email</label>
                                    <input type="email" class="form-control" id="txt_edit_email" name="txt_edit_email">
                                </div>
                                <span class="text-danger">@error('txt_edit_email') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_username">Username</label>
                                        <input type="text" class="form-control" id="txt_edit_username" name="txt_edit_username"/>
                                    <span class="text-danger">@error('txt_edit_username') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_phone_number">Phone Number</label>
                                        <input type="number" class="form-control" id="txt_edit_phone_number" name="txt_edit_phone_number"/>
                                    <span class="text-danger">@error('txt_edit_phone_number') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_role">Role</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_role"  name="txt_edit_role">
                                        <option selected disabled>Select User Role</option>
                                        <option value="Super Admin">Super Admin</option>
                                        <option value="Admin">Admin</option>
                                        <option value="Retailer">Retailer</option>
                                    </select>
                                    <span class="text-danger">@error('txt_edit_role') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>

                        <!-- /.row -->
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->



      <div class="modal fade" id="delete-user" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit User</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('delete_user') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="user_id" name="user_id">
                        </div>
                        <h5 class="text-center">Are you sure you want to delete </h5> <br>
                        <h2 id="username" class="text-center"></h2>
                            {{-- <input type="text" class="form-control" id="username" name="username"> --}}
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-secondary pl-5 pr-5">Yes</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

    </section>


  </div>
  <!-- /.content-wrapper -->

  <script>
    function edit_user() {
        // function edit_user(el)
        // var link = $(el) //refer `a` tag which is clicked
        // var modal = $("#edit-user") //your modal
        $('#edit-user').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var user_id = link.data('id')
        var first_name = link.data('first_name')
        var last_name = link.data('last_name')
        var email = link.data('email')
        var username = link.data('username')
        var phone_number = link.data('phone_number')
        var role = link.data('role')

        modal.find('#user_id').val(user_id);
        modal.find('#txt_edit_first_name').val(first_name);
        modal.find('#txt_edit_last_name').val(last_name);
        modal.find('#txt_edit_email').val(email);
        modal.find('#txt_edit_username').val(username);
        modal.find('#txt_edit_phone_number').val(phone_number);
        modal.find('#txt_edit_role').val(role);
        });
    }
  </script>

<script>
    function delete_user() {
        $('#delete-user').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var user_id = link.data('id')
        var first_name = link.data('first_name')
        var last_name = link.data('last_name')

        modal.find('#user_id').val(user_id);
        // modal.find('#username').content(first_name+' '+last_name);
        document.getElementById('username').innerHTML = first_name+' '+last_name;
        });
    }
  </script>

  {{-- <script>
    $(document).ready(function () {
        $("#edit-user").on("show.bs.modal", function (e) {
            var id = $(e.relatedTarget).data('target-id');
            $('#pass_id').val(id);
        });
    });
</script> --}}

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

        <!-- DataTables  & Plugins -->
      <script src="plugins/datatables/jquery.dataTables.min.js"></script>
      <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
      <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
      <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script src="plugins/jszip/jszip.min.js"></script>
      <script src="plugins/pdfmake/pdfmake.min.js"></script>
      <script src="plugins/pdfmake/vfs_fonts.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
      <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
      {{-- <script src="dist/js/adminlte.min.js"></script> --}}

      <script>
        $(function () {
          $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 6, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>



@endsection



