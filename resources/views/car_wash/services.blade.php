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
            <h3 class="card-title">Car Wash Services </h3>

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
            <form action="{{route('add_service')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_service_name">Service Name</label>
                            <input type="text" class="form-control" id="txt_service_name" name="txt_service_name" value="{{old('txt_service_name')}}">
                        </div>
                        <span class="text-danger">@error('txt_service_name') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_washer_percentage">Washer Percentage (%)</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_washer_percentage" name="txt_washer_percentage" >                        </div>
                        <span class="text-danger">@error('txt_washer_percentage') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_service_description">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Service Description" name="txt_service_description">{{old('txt_service_description')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_service_description') {{ $message }} @enderror</span>
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
                <h3 class="card-title"> Services Details</h3>
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
                <table id="services" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Vehicle Name</th>
                        <th>Washer %</th>
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
                    @foreach ( $all_services as $service)
                        <tr>
                            <td>{{ucwords(trans($service->name)) }}</td>
                            <td>{{$service->washer_percentage}} %</td>
                            <td>{{ucfirst(trans($service->description)) }}</td>
                            <td>{{$service->created_by}}</td>
                            <td>{{$service->created_at}}</td>
                            <td>
                                @if ($service->updated_by == "" || $service->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$service->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($service->updated_at == "" || $service->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$service->updated_at}}</p>
                                @endif
                            </td>
                            @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')

                                <td class="text-center">
                                    <a class="text-primary"
                                        onclick="edit_service(this)"
                                        data-toggle="modal"
                                        data-target="#edit_service"
                                        data-id="{{ $service->id }}"
                                        data-name="{{ $service->name }}"
                                        {{-- data-vehicle_id="{{ $service->vehicle_id }}"
                                        data-vehicle_type="{{ $service->type }}"
                                        data-price="{{ $service->price }}" --}}
                                        data-washer_percentage="{{ $service->washer_percentage }}"
                                        data-description="{{ $service->description }}"
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



      <div class="modal fade" id="edit_service" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_service') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="hidden" class="form-control" id="service_id" name="service_id">
                                    {{-- <input type="hidden" class="form-control" id="vehicle_id" name="vehicle_id"> --}}

                                    <label for="txt_edit_service_name"> Service Name</label>
                                    <input type="text" class="form-control" id="txt_edit_service_name" name="txt_edit_service_name">

                                    <span class="text-danger">@error('txt_edit_service_name') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <label for="txt_edit_vehicle_type">Vehicle Type</label>
                                <select class="form-control" style="width: 100%;" id="txt_edit_vehicle_type"  name="txt_edit_vehicle_type">
                                    <option selected id="txt_vehicle_id"> </option>
                                    @foreach ($all_vehicles as $vehicle )
                                        <option value="{{ $vehicle->id}}">{{ $vehicle->type }}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger">@error('txt_edit_vehicle_type') {{ $message }} @enderror</span>
                            </div> --}}

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_washer_percentage">Washer Percentage</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_washer_percentage" name="txt_edit_washer_percentage">
                                </div>
                                <span class="text-danger">@error('txt_edit_washer_percentage') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        {{-- <div class="row ">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_sevice_price"> Price</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_sevice_price" name="txt_edit_sevice_price">

                                    <span class="text-danger">@error('txt_edit_sevice_price') {{ $message }} @enderror</span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_washer_percentage">Washer Percentage</label>
                                    <input type="number" min="0" oninput="this.value =
                                    !!this.value && Math.abs(this.value) >= 0 ? Math.abs(this.value) : null" class="form-control" id="txt_edit_washer_percentage" name="txt_edit_washer_percentage">
                                </div>
                                <span class="text-danger">@error('txt_edit_washer_percentage') {{ $message }} @enderror</span>
                            </div>
                        </div> --}}

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_service_description">Description</label>
                                    <textarea class="form-control" rows="3" name="txt_edit_service_description" id="txt_edit_service_description"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_service_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Service Info</button>
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


</div>
  <!-- /.content-wrapper -->

  {{-- @section('Extra_JS')
    <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection --}}

  <script>
    function edit_service() {
        $('#edit_service').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var service_id = link.data('id')
        var service_name = link.data('name')
        // var vehicle_id = link.data('vehicle_id')
        // var vehicle_type = link.data('vehicle_type')
        // var price = link.data('price')
        var washer_percentage = link.data('washer_percentage')
        var description = link.data('description')

        modal.find('#service_id').val(service_id);
        // modal.find('#vehicle_id').val(vehicle_id);
        modal.find('#txt_edit_service_name').val(service_name);
        // modal.find('#txt_edit_vehicle_type').val(vehicle_type);
        // modal.find('#txt_edit_sevice_price').val(price);
        modal.find('#txt_edit_washer_percentage').val(washer_percentage);
        // modal.find('#txt_vehicle_id').val(vehicle_id);
        modal.find('#txt_edit_service_description').val(description);
        // document.getElementById('txt_vehicle_id').innerHTML = vehicle_type;
        document.getElementById('title').innerHTML = 'Edit '+ service_name;
        });
    }


    // function delete_product() {
    //     $('#delete-product').on('shown.bs.modal', function(e) {
    //     var link = $(e.relatedTarget)
    //         modal = $(this)
    //     var product_id = link.data('product_id')
    //     var product_name = link.data('product_name')

    //     modal.find('#product_id').val(product_id);
    //     document.getElementById('product_name').innerHTML = product_name;
    //     });

    // }

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
          $("#services").DataTable({
            "responsive": true,
            "lengthChange": true,
            "searching": true,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 8, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#services_wrapper .col-md-6:eq(0)');
          $('#example2').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
          });
        });
      </script>



@endsection



