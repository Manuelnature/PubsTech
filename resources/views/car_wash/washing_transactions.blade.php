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
            <h3 class="card-title">Transactions</h3>

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
            <form action="{{route('add_transaction')}}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_vehicle_type_id">Vehicle Type Name</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_vehicle_type_id"  name="txt_vehicle_type_id" >
                                <option selected disabled>Select Vehicle Type</option>
                                @foreach ($all_vehicles_types as $vehicle_type )
                                    <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_vehicle_type_id') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_service_id">Services</label>
                            <select class="select2" multiple="multiple" data-placeholder="Select Services" name="txt_service_id[]" id="txt_service_id" style="width: 100%;">
                                @foreach ($all_services as $service )
                                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_service_id') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_washer_id">Select Car Washer</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_washer_id"  name="txt_washer_id" value="{{ old('txt_washer_id') }}" >
                                <option selected disabled>Select Washer</option>
                                @foreach ($all_washers as $washer )
                                    <option value="{{ $washer->id }}">{{ $washer->firstname }} {{ $washer->lastname }}</option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_washer_id') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_supervisor">Supervisor</label>
                            <select class="form-control select2" style="width: 100%;" id="txt_supervisor"  name="txt_supervisor" value="{{ old('txt_supervisor') }}" >
                                <option selected disabled>Select Supervisor</option>
                                @foreach ($all_users as $user )
                                    <option value="{{ $user->username }}">{{ ucwords($user->username) }} </option>
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('txt_supervisor') {{ $message }} @enderror</span>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_total_price">Total Price</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_total_price" name="txt_total_price" readonly>                        </div>
                        <span class="text-danger">@error('txt_total_price') {{ $message }} @enderror</span>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_washer_commission">Washer Commision</label>
                            <input type="number" min="0" step=".01" class="form-control" id="txt_washer_commission" name="txt_washer_commission" readonly>                        </div>
                        <span class="text-danger">@error('txt_washer_commission') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_description">Description</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Transaction Description" name="txt_description">{{old('txt_description')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_description') {{ $message }} @enderror</span>
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
            Perform Washing Bay Transactions Here
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
                <h3 class="card-title"> Transaction Details</h3>
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

                <form action="{{ route('filter_transaction') }}" method="POST">
                    @csrf
                    <div class="row mb-3">

                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="txt_date_from">Start Date</label>
                                <input type="date" class="form-control" id="txt_date_from" name="txt_date_from" value="{{ old('txt_date_from') }}">
                            </div>
                            <span class="text-danger">@error('txt_date_from') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="txt_date_to">End Date</label>
                                <input type="date" class="form-control" id="txt_date_to" name="txt_date_to" value="{{ old('txt_date_to') }}">
                            </div>
                            <span class="text-danger">@error('txt_date_to') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-md-2" style="padding-top:30px !important;">
                            <button type="submit" class="btn btn-secondary btn-block">Filter</button>
                        </div>
                    </div>
                </form>

                @if ($date_from != "" && $date_to != "")
                    <p>
                        {{ \Carbon\Carbon::parse($date_from)->format('j F, Y')}}
                        <strong> &nbsp;-&nbsp; </strong>
                        {{ \Carbon\Carbon::parse($date_to)->format('j F, Y')}}
                    </p>
                @endif

                <table id="transaction" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                        <th>Vehicle Type</th>
                        <th>Services</th>
                        <th>Washer </th>
                        <th>Amount</th>
                        <th>Washer Commission</th>
                        <th>Supervisor</th>
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
                    @foreach ( $all_washing_transactions as $washing_transaction)
                        <tr>
                            <td>{{ucwords(trans($washing_transaction->vehicle_type_name)) }}</td>
                            {{-- <td>{{$washing_transaction->service_ids}}</td> --}}
                            <td>
                                @php
                                     $service_names = "";
                                    foreach(json_decode($washing_transaction->service_ids, true) as $service_id){

                                        foreach ($all_services as $service ){
                                            if ($service_id == $service->id) {
                                                if($service_names == ""){
                                                    $service_names =  $service_names.''.$service->name;
                                                }
                                                else{
                                                    $service_names =  $service_names.', '.$service->name;
                                                }
                                                // echo $service->name;
                                                // $service_names =  $service_names.', '.$service->name;
                                            }
                                        }
                                    }
                                    echo $service_names;
                                @endphp
                            </td>

                            <td>{{ucwords(trans($washing_transaction->nickname))}}</td>
                            <td>GH¢ {{number_format($washing_transaction->amount, 2 ) }}</td>
                            <td>GH¢ {{number_format($washing_transaction->washer_commission, 2 ) }}</td>
                            <td>{{ucwords(trans($washing_transaction->supervisor))}}</td>
                            <td>{{ucfirst(trans($washing_transaction->transaction_description)) }}</td>
                            <td>{{$washing_transaction->created_by}}</td>
                            <td>{{$washing_transaction->created_at}}</td>
                            <td>
                                @if ($washing_transaction->updated_by == "" || $washing_transaction->updated_by == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$washing_transaction->updated_by}}</p>
                                @endif
                            </td>
                            <td>
                                @if ($washing_transaction->updated_at == "" || $washing_transaction->updated_at == NULL)
                                    <p>Not updated</p>
                                @else
                                    <p>{{$washing_transaction->updated_at}}</p>
                                @endif
                            </td>
                            @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')

                                <td class="text-center">

                                    <a  href="{{ url('edit_transaction', $washing_transaction->transaction_id)}}" class="text-primary"><i class="fas fa-edit"></i></a>
                                    {{-- <a class="text-primary"
                                        onclick="edit_transaction(this)"
                                        data-toggle="modal"
                                        data-target="#edit_transaction"
                                        data-transaction_id="{{ $washing_transaction->transaction_id }}"
                                        data-vehicle_type_id="{{ (int)$washing_transaction->vehicle_type_id }}"
                                        data-vehicle_type_name="{{ $washing_transaction->vehicle_type_name }}"
                                        data-service_ids="{{ $washing_transaction->service_ids }}"
                                        data-washer_id="{{ $washing_transaction->washer_id }}"
                                        data-washer_firstname="{{ $washing_transaction->firstname }}"
                                        data-washer_lastname="{{ $washing_transaction->lastname }}"
                                        data-washer_nickname="{{ $washing_transaction->nickname }}"
                                        data-price="{{ $washing_transaction->amount }}"
                                        data-washer_commission="{{ $washing_transaction->washer_commission }}"
                                        data-supervisor="{{ $washing_transaction->supervisor }}"
                                        data-description="{{ $washing_transaction->transaction_description }}"
                                    >
                                        <i class="fas fa-edit"></i>
                                    </a> --}}

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



      <div class="modal fade" id="edit_transaction" >
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title" id="title"></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="{{ route('update_transaction_modal') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <input type="hidden" name="transaction_id" id="transaction_id">

                                <div class="form-group">
                                    <label for="txt_edit_vehicle_type_id">Vehicle Name</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_vehicle_type_id"  name="txt_edit_vehicle_type_id" >
                                        <option selected id="selected_vehicle"></option>
                                        @foreach ($all_vehicles_types as $vehicle_type )
                                            <option value="{{ $vehicle_type->id }}">{{ $vehicle_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('txt_edit_vehicle_type_id') {{ $message }} @enderror</span>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_service_id">Services</label> <!-- data-placeholder="Select Services" -->
                                    <select class="select2" multiple="multiple" name="txt_edit_service_id[]" id="txt_edit_service_id" style="width: 100%;">
                                        <option selected id="selected_services"></option>

                                                        {{-- // @foreach (json_decode($transaction_to_edit->service_ids, true) as $service_id )
                                                        //     @foreach ( $all_services as $service )
                                                        //         @if ($service->id == $service_id)
                                                        //             <option selected value="{{ $service->id }}">{{ $service->name }}</option>
                                                        //         @endif
                                                        //     @endforeach
                                                        // @endforeach --}}

                                        @foreach ($all_services as $service )
                                            <option value="{{ $service->id }}">{{ $service->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('txt_edit_service_id') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_washer_id">Select Car Washer</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_washer_id"  name="txt_edit_washer_id" value="{{ old('txt_edit_washer_id') }}" >
                                        <option selected id="selected_washer"></option>
                                        @foreach ($all_washers as $washer )
                                            <option value="{{ $washer->id }}">{{ $washer->firstname }} {{ $washer->lastname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('txt_edit_washer_id') {{ $message }} @enderror</span>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_supervisor">Supervisor</label>
                                    <select class="form-control" style="width: 100%;" id="txt_edit_supervisor"  name="txt_edit_supervisor" value="{{ old('txt_edit_supervisor') }}" >
                                        <option selected id="selected_supervisor">Select Supervisor</option>
                                        @foreach ($all_users as $user )
                                            <option value="{{ $user->username }}">{{ ucwords($user->username) }} </option>
                                        @endforeach
                                    </select>
                                </div>
                                <span class="text-danger">@error('txt_edit_supervisor') {{ $message }} @enderror</span>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_total_price">Total Price</label>
                                    <input type="number" min="0" step=".01" class="form-control" id="txt_edit_total_price" name="txt_edit_total_price" readonly>                        </div>
                                <span class="text-danger">@error('txt_edit_total_price') {{ $message }} @enderror</span>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="txt_edit_washer_commission">Washer Commision</label>
                                    <input type="number" min="0" step=".01" class="form-control" id="txt_edit_washer_commission" name="txt_edit_washer_commission" readonly>                        </div>
                                <span class="text-danger">@error('txt_edit_washer_commission') {{ $message }} @enderror</span>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="txt_edit_description">Description</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter Transaction Description" name="txt_edit_description"></textarea>
                                </div>
                                <span class="text-danger">@error('txt_edit_description') {{ $message }} @enderror</span>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-secondary">Update Product</button>
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

  @section('Extra_JS')
    <script src="{{ asset('assets/js/extraJS.js') }}" ></script>
  @endsection

  <script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("txt_date_to")[0].setAttribute('max', today);
    document.getElementsByName("txt_date_from")[0].setAttribute('max', today);
 </script>

{{-- <script type="text/javascript">
    // $(document).ready(function() {
    //     $('#txt_edit_service_id').multiselect();
    // });
    $(document).ready(function() {
    $('.txt_edit_service_id').select2();
});
</script> --}}

  <script>
    function edit_transaction() {
        $('#edit_transaction').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var transaction_id = link.data('transaction_id')
        var vehicle_type_id = link.data('vehicle_type_id')
        var vehicle_type_name = link.data('vehicle_type_name')
        var service_ids = link.data('service_ids')
        var washer_id = link.data('washer_id')
        var washer_firstname = link.data('washer_firstname')
        var washer_lastname = link.data('washer_lastname')
        var washer_nickname = link.data('washer_nickname')
        var price = link.data('price')
        var washer_commission = link.data('washer_commission')
        var supervisor = link.data('supervisor')
        var description = link.data('description')


        modal.find('#transaction_id').val(transaction_id);
        modal.find('#selected_vehicle').val(vehicle_type_id);
        modal.find('#selected_services').val(service_ids);
        modal.find('#selected_washer').val(washer_id);
        modal.find('#txt_edit_total_price').val(price);
        modal.find('#selected_supervisor').val(supervisor);
        modal.find('#txt_edit_washer_commission').val(washer_commission);
        modal.find('#txt_edit_description').val(description);
        document.getElementById('selected_vehicle').innerHTML = vehicle_type_name;
        document.getElementById('selected_washer').innerHTML = washer_firstname+" "+washer_lastname;
        document.getElementById('selected_supervisor').innerHTML = supervisor;
        document.getElementById('title').innerHTML = 'Edit Transaction';

        var all_services = @json($all_services);
        // console.log(all_services);


        var service_names = "";
        all_services.forEach(function(service) {
            // console.log(service.name);
            service_ids.forEach(function(service_id) {
            // console.log(service_id);
                if (service_id == service.id) {
                    // console.log(service.name);

                    // if(service_names == ""){
                    //     service_names =  service_names+''+service.name;
                    // }
                    // else{
                    //     service_names =  service_names+', '+service.name;
                    // }

                    // var newOption = new Option(service.name, service.id, true);
                    // $('#selected_services').append(newOption).trigger('change');
                    service_names = service_names+' '+service.name;
                    // $('#selected_services').val(service.name);

                }
            });
        });

        document.getElementById('selected_services').innerHTML = service_names;


        // $('#selected_services').val(service_names);
        console.log(service_names);
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

  </script>





  {{-- ======== Perform Calculation on Services Selected ============== --}}
    @section('Service_JS')
    <script type="text/javascript" src="{{ asset('assets/js/service.js') }}"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            setServiceList( @json($all_pricing));
        });
    </script>
    @endsection

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
          $("#transaction").DataTable({
            "responsive": true,
            "lengthChange": true,
            "autoWidth": false,
            "ordering": true,
            "order": [[ 9, "desc" ]],
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
          }).buttons().container().appendTo('#transaction_wrapper .col-md-6:eq(0)');
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



