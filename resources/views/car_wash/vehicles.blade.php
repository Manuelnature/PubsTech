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
            <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#add_vehicle_type">
                    Set Vehicle Type
                </button>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->


      <div class="modal fade" id="add_vehicle_type" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Vehicle Type</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('add_vehicle_type') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_vehicle_type_name">Name of Vehicle Type</label>
                                    <input type="text" class="form-control" id="txt_vehicle_type_name" name="txt_vehicle_type_name" value="{{old('txt_vehicle_type_name')}}">
                                </div>
                                <span class="text-danger">@error('txt_vehicle_type_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_vehicle_type_description">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Vehicle Description" name="txt_vehicle_type_description">{{old('txt_vehicle_type_description')}}</textarea>
                                </div>
                                <span class="text-danger">@error('txt_vehicle_type_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
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
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default">
          <div class="card-header">
            <h3 class="card-title">Vehicles </h3>

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
            <form action="{{route('add_vehicle')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_vehicle_name">Vehicle Name</label>
                            <input type="text" class="form-control" id="txt_vehicle_name" name="txt_vehicle_name" value="{{old('txt_vehicle_name')}}">
                        </div>
                        <span class="text-danger">@error('txt_vehicle_name') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_vehicle_type">Vehicle Type</label>
                            {{-- <input type="text" class="form-control" id="txt_vehicle_type" name="txt_vehicle_type" value="{{old('txt_vehicle_type')}}"> --}}
                            <select class="form-control select2" style="width: 100%;" id="txt_vehicle_type"  name="txt_vehicle_type">
                                <option selected id="txt_vehicle_type"> </option>
                                @foreach ($all_vehicle_types as $vehicle_type )
                                    <option value="{{ $vehicle_type->id}}">{{ $vehicle_type->name }}</option>
                                @endforeach
                            </select>
                            <span class="text-danger">@error('txt_vehicle_type') {{ $message }} @enderror</span>
                        </div>

                    </div>

                </div>
                <!-- /.row -->

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_vehicle_description">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Vehicle Description" name="txt_vehicle_description">{{old('txt_vehicle_description')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_vehicle_description') {{ $message }} @enderror</span>
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
            Save Vehicle Records
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
                <h3 class="card-title"> Vehicle Details</h3>
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
                <table id="vehicles" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Type</th>
                        <th>Description</th>
                        <th>Created By</th>
                        <th>Date Created</th>
                        <th>Updated By</th>
                        <th>Updated At</th>

                        @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                        <th>Action</th>
                        @endif
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ( $all_vehicles as $vehicle)
                        <tr>
                            <td>{{$vehicle->vehicle_name}}</td>
                            <td>{{$vehicle->vehicle_type_name}}</td>
                            <td>{{$vehicle->vehicle_description}}</td>
                            <td>{{$vehicle->created_by}}</td>
                            <td>{{$vehicle->created_at}}</td>
                            <td>
                                @if ($vehicle->updated_by == "" || $vehicle->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$vehicle->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($vehicle->updated_at == "" || $vehicle->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$vehicle->updated_at}}</p>
                                @endif
                            </td>
                            @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')

                                <td class="text-center">
                                    <a class="text-primary"
                                        onclick="edit_vehicle(this)"
                                        data-toggle="modal"
                                        data-target="#edit_vehicle"
                                        data-id="{{ $vehicle->vehicle_id }}"
                                        data-name="{{ $vehicle->vehicle_name }}"
                                        data-vehicle_type_name="{{ $vehicle->vehicle_type_name }}"
                                        data-vehicle_type_id="{{ $vehicle->vehicle_type_id }}"
                                        data-description="{{ $vehicle->vehicle_description }}"
                                    >
                                    <i class="fas fa-edit"></i>
                                    </a>

                                    {{-- <a class="text-danger"
                                        onclick="delete_product(this)"
                                        data-toggle="modal"
                                        data-target="#delete-product"
                                        data-product_id="{{ $product->id }}"
                                        data-product_name="{{ $product->name }}"
                                    >
                                    <i class="fas fa-trash"></i>
                                    </a> --}}
                                </td>
                            @endif
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



      <div class="modal fade" id="edit_vehicle" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_vehicle') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="vehicle_id" name="vehicle_id">

                                    <label for="txt_edit_vehicle_name"> Vehicle Name</label>
                                    <input type="text" class="form-control" id="txt_edit_vehicle_name" name="txt_edit_vehicle_name">

                                    <span class="text-danger">@error('txt_edit_vehicle_name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_vehicle_type">Vehicle Type </label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_vehicle_type"  name="txt_edit_vehicle_type">
                                        <option selected id="selected_vehicle_type"> </option>
                                        @foreach ($all_vehicle_types as $vehicle_type )
                                            <option value="{{ $vehicle_type->id}}">{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                    <span class="text-danger">@error('txt_edit_vehicle_type') {{ $message }} @enderror</span>
                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_vehicle_description">Description</label>
                                    <textarea class="form-control" rows="3" name="txt_edit_vehicle_description" id="txt_edit_vehicle_description"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_vehicle_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Vehicle Info</button>
                </div>
            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->

      {{-- <div class="modal fade" id="delete-product" >
        <div class="modal-dialog">
          <div class="modal-content">

            <form action="{{ route('delete_product') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" id="product_id" name="product_id">
                        </div>
                        <h5 class="text-center mb-4">Are you sure you want to delete </h5>
                        <h4 id="product_name" class="text-center text-bold mb-4"></h4>

                        <div class="text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-danger pl-3 pr-3">Yes</button>
                        </div>
                    </div>
                </div>

            </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> --}}



    </section>

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"> Vehicle Types</h3>
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
                  <table id="vehicle_type" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Vehicle Type Name</th>
                          <th>Description</th>
                          <th>Created By</th>
                          <th>Date Created</th>
                          <th>Updated By</th>
                          <th>Updated At</th>

                          @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
                          <th>Action</th>
                          @endif
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ( $all_vehicle_types as $vehicle_type)
                          <tr>
                              <td>{{$vehicle_type->name}}</td>
                              <td>{{$vehicle_type->description}}</td>
                              <td>{{$vehicle_type->created_by}}</td>
                              <td>{{$vehicle_type->created_at}}</td>
                              <td>
                                  @if ($vehicle_type->updated_by == "" || $vehicle_type->updated_by == NULL)
                                      <p>Not updated</p>
                                  @else
                                      <p>{{$vehicle_type->updated_by}}</p>
                                  @endif
                              </td>
                              <td>
                                  @if ($vehicle_type->updated_at == "" || $vehicle_type->updated_at == NULL)
                                      <p>Not updated</p>
                                  @else
                                      <p>{{$vehicle_type->updated_at}}</p>
                                  @endif
                              </td>
                              @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')

                                    <td class="text-center">
                                        <a class="text-primary"
                                            onclick="edit_vehicle_type(this)"
                                            data-toggle="modal"
                                            data-target="#edit_vehicle_type"
                                            data-id="{{ $vehicle_type->id }}"
                                            data-vehicle_type_name="{{ $vehicle_type->name }}"
                                            data-vehicle_type_description="{{ $vehicle_type->description }}"
                                        >
                                        <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                              @endif
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



        <div class="modal fade" id="edit_vehicle_type" >
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title" id="title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{ route('update_vehicle_type') }}" method="POST">
                  @csrf
                  <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="vehicle_type_id" id="vehicle_type_id">

                                    <label for="txt_edit_vehicle_type_name">Name of Vehicle Type</label>
                                    <input type="text" class="form-control" id="txt_edit_vehicle_type_name" name="txt_edit_vehicle_type_name" value="{{old('txt_edit_vehicle_type_name')}}">
                                </div>
                                <span class="text-danger">@error('txt_edit_vehicle_type_name') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_vehicle_type_description">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Vehicle Type Description" name="txt_edit_vehicle_type_description" id="txt_edit_vehicle_type_description"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_vehicle_type_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="modal-footer justify-content-between">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <button type="submit" class="btn btn-secondary">Update Vehicle Info</button>
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

  @section('Extra_JS')
  <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

  <script>
    function edit_vehicle() {
        $('#edit_vehicle').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var vehicle_id = link.data('id')
        var vehicle_name = link.data('name')
        // var vehicle_type = link.data('type')
        var vehicle_type_id = link.data('vehicle_type_id')
        var vehicle_type_name = link.data('vehicle_type_name')
        var description = link.data('description')


        modal.find('#vehicle_id').val(vehicle_id);
        modal.find('#txt_edit_vehicle_name').val(vehicle_name);
        // modal.find('#txt_edit_vehicle_type').val(vehicle_type);

        modal.find('#selected_vehicle_type').val(vehicle_type_id);

        modal.find('#txt_edit_vehicle_description').val(description);

        document.getElementById('selected_vehicle_type').innerHTML = vehicle_type_name;

        document.getElementById('title').innerHTML = 'Edit '+ vehicle_name;
        });
    }


    function edit_vehicle_type() {
        $('#edit_vehicle_type').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var vehicle_type__id = link.data('id')
        var vehicle_type_name = link.data('vehicle_type_name')
        var description = link.data('vehicle_type_description')


        modal.find('#vehicle_type_id').val(vehicle_type__id);
        modal.find('#txt_edit_vehicle_type_name').val(vehicle_type_name);
        modal.find('#txt_edit_vehicle_type_description').val(description);

        document.getElementById('title').innerHTML = 'Edit '+ vehicle_type_name;
        });
    }


    function delete_product() {
        $('#delete-product').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget)
            modal = $(this)
        var product_id = link.data('product_id')
        var product_name = link.data('product_name')

        modal.find('#product_id').val(product_id);
        document.getElementById('product_name').innerHTML = product_name;
        });

    }

        $("#txt_price_per_item").attr("value", 0);
        $("#txt_quantity_per_crate").attr("value", 0);
        $("#txt_stock_threshold").attr("value", 0);

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
          $("#vehicles").DataTable({
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 3, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#vehicles_wrapper .col-md-6:eq(0)');
          $('#vehicle_type').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            // "info": true,
            "autoWidth": false,
            "responsive": true,
            "order": [[ 3, "desc" ]],
          }).buttons().container().appendTo('#vehicle_type_wrapper .col-md-6:eq(0)');
        });
      </script>



@endsection



