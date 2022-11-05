@extends('layouts.base_template')
@section('content')


@php
    $user_session_details = Session::get('user_session');
@endphp

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
            {{-- <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add-vehicle-type">
                    Set Vehicle Type
                </button>
            </ol> --}}
          </div>
        </div>
      </div><!-- /.container-fluid -->

    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Add Car Washer </h3>

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
            <form action="{{route('add_washer')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_firstname">First Name</label>
                            <input type="text" class="form-control" id="txt_firstname" name="txt_firstname" value="{{old('txt_firstname')}}">
                        </div>
                        <span class="text-danger">@error('txt_firstname') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_lastname">Last Name</label>
                            <input type="text" class="form-control" id="txt_lastname" name="txt_lastname" value="{{old('txt_lastname')}}">
                        </div>
                        <span class="text-danger">@error('txt_lastname') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_nickname">Nick Name</label>
                            <input type="text" class="form-control" id="txt_nickname" name="txt_nickname" value="{{old('txt_nickname')}}">
                        </div>
                        <span class="text-danger">@error('txt_nickname') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_phone_number">Phone Number</label>
                            <input type="text" class="form-control" id="txt_phone_number" name="txt_phone_number" value="{{old('txt_phone_number')}}">
                        </div>
                        <span class="text-danger">@error('txt_phone_number') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_bio">Bio</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Bio" name="txt_bio">{{old('txt_bio')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_bio') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-secondary">Submit</button>
                    </div>
                </div>
            </form>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            Save Service Records
          </div>
        </div>
        <!-- /.card -->

      </div>
      <!-- /.container-fluid -->

    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> All Registered Car Washers</h3>
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
                <table id="washer_table" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Nick Name </th>
                        <th>Phone Number</th>
                        <th>Bio</th>
                        <th>Date Registered</th>
                        <th>Registered By</th>
                        <th>Updated By</th>
                        <th>Updated At</th>
                        <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $all_washers as $washer)
                        <tr>
                            <td>{{$washer->firstname}}</td>
                            <td>{{$washer->lastname}}</td>
                            <td>{{$washer->nickname}}</td>
                            <td>{{$washer->phone_number}}</td>
                            <td>{{$washer->bio}}</td>
                            <td>{{$washer->created_at}}</td>
                            <td>{{$washer->created_by}}</td>
                            <td>
                                @if ($washer->updated_by == "" || $washer->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$washer->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($washer->updated_at == "" || $washer->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$washer->updated_at}}</p>
                                @endif
                            </td>
                            <td class="text-center">
                                <a class="text-primary"
                                    onclick="edit_washer(this)"
                                    data-toggle="modal"
                                    data-target="#edit_washer"
                                    data-id="{{ $washer->id }}"
                                    data-firstname="{{ $washer->firstname }}"
                                    data-lastname="{{ $washer->lastname }}"
                                    data-nickname="{{ $washer->nickname }}"
                                    data-phone_number="{{ $washer->phone_number }}"
                                    data-bio="{{ $washer->bio }}"
                                >
                                <i class="fas fa-edit"></i>
                                </a>

                                <a class="text-danger"
                                    onclick="delete_washer(this)"
                                    data-toggle="modal"
                                    data-target="#delete_washer"
                                    data-washer_id="{{ $washer->id}}"
                                    data-washer_nickname="{{ $washer->nickname  }}"
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



      <div class="modal fade" id="edit_washer" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_washer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="washer_id" name="washer_id">

                                    <label for="txt_edit_firstname">First Name</label>
                                    <input type="text" class="form-control" id="txt_edit_firstname" name="txt_edit_firstname">
                                </div>
                                <span class="text-danger">@error('txt_edit_firstname') {{ $message }} @enderror</span>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_lastname">Last Name</label>
                                    <input type="text" class="form-control" id="txt_edit_lastname" name="txt_edit_lastname">
                                </div>
                                <span class="text-danger">@error('txt_edit_lastname') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_nickname">Nick Name</label>
                                    <input type="text" class="form-control" id="txt_edit_nickname" name="txt_edit_nickname">
                                </div>
                                <span class="text-danger">@error('txt_edit_nickname') {{ $message }} @enderror</span>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_phone_number">Phone Number</label>
                                    <input type="text" class="form-control" id="txt_edit_phone_number" name="txt_edit_phone_number">
                                </div>
                                <span class="text-danger">@error('txt_edit_phone_number') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_bio">Bio</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Bio" name="txt_edit_bio" id="txt_edit_bio"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_bio') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Washer Details</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      <div class="modal fade" id="delete_washer" >
        <div class="modal-dialog">
          <div class="modal-content">

            <form action="{{ route('delete_washer') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="washer_id" name="washer_id">
                        </div>
                        <h5 class="text-center mb-4">Are you sure you want to delete </h5>
                        <h4 id="washer_nickname" class="text-center text-bold mb-4"></h4>

                        <div class="text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger pl-3 pr-3" style="width: 80px" >Yes</button>
                        </div>
                    </div>
                </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>



    </section>


</div>
  <!-- /.content-wrapper -->

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

  <script>
    function edit_washer() {
        $('#edit_washer').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var washer_id = link.data('id')
        var firstname = link.data('firstname')
        var lastname = link.data('lastname')
        var nickname = link.data('nickname')
        var phone_number = link.data('phone_number')
        var bio = link.data('bio')

        modal.find('#washer_id').val(washer_id);
        modal.find('#txt_edit_firstname').val(firstname);
        modal.find('#txt_edit_lastname').val(lastname);
        modal.find('#txt_edit_nickname').val(nickname);
        modal.find('#txt_edit_phone_number').val(phone_number);
        modal.find('#txt_edit_bio').val(bio);
        document.getElementById('title').innerHTML = firstname+ ' '+lastname;
        });
    }


    function delete_washer() {
        $('#delete_washer').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var washer_id = link.data('washer_id')
        var washer_nickname = link.data('washer_nickname')

        modal.find('#washer_id').val(washer_id);
        document.getElementById('washer_nickname').innerHTML = washer_nickname.charAt(0).toUpperCase()+ washer_nickname.slice(1);
        });

    }

  </script>

        <!-- DataTables  & Plugins -->
        <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>

        <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
      {{-- <script src="dist/js/adminlte.min.js"></script> --}}

      <script>
        $(function () {
          $("#washer_table").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "searching": true,
            "ordering": true,
            "order": [[ 5, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#washer_table_wrapper .col-md-6:eq(0)');
        });
      </script>



@endsection



