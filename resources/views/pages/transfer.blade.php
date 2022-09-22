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
              <li class="breadcrumb-item"><a href="#">Transfer Products</a></li>
              {{-- <li class="breadcrumb-item active">Sales / Warehouse</li> --}}
            </ol>
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
            <h3 class="card-title">Transfer From Warehouse to Retail </h3>

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
            <form action="{{ route('transfer_stock') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-4">
                        <div class="form-group">
                          <label for="txt_product_id">Products Name</label>
                          <select class="form-control select2" data-placeholder="Select Product" style="width: 100%;" name="txt_product_id" value="{{ old('txt_product_id') }}" >
                                <option selected disabled>Select Product</option>
                                @foreach ($all_products as $product)
                                    <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                          </select>
                          <span class="text-danger">@error('txt_product_id') {{ $message }} @enderror</span>
                        </div>
                      </div>

                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_quantity_to_transfer_in_crate">Quantity To Transfer (In Crate)</label>
                            <input type="number" class="form-control" id="txt_quantity_to_transfer_in_crate" name="txt_quantity_to_transfer_in_crate" value="{{ old('txt_quantity_to_transfer_in_crate') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_to_transfer_in_crate') {{ $message }} @enderror</span>
                      </div>
                      <div class="col-md-4">
                        <div class="form-group">
                            <label for="txt_quantity_to_transfer_in_pieces">Quantity To Transfer (In Pieces)</label>
                            <input type="number" class="form-control" id="txt_quantity_to_transfer_in_pieces" name="txt_quantity_to_transfer_in_pieces" value="{{ old('txt_quantity_to_transfer_in_pieces') }}">
                        </div>
                        <span class="text-danger">@error('txt_quantity_to_transfer_in_pieces') {{ $message }} @enderror</span>
                      </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_collected_by">Collected By</label>
                            <select class="form-control select2" data-placeholder="Select User" style="width: 100%;" name="txt_collected_by" value="{{ old('txt_collected_by') }}" >
                                <option selected disabled>Select User</option>
                                @foreach ($all_users as $user)
                                    <option value="{{$user->first_name}} {{$user->last_name}}">{{$user->first_name}} {{$user->last_name}}</option>
                                @endforeach
                          </select>
                        </div>
                        <span class="text-danger">@error('txt_collected_by') {{ $message }} @enderror</span>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="txt_collected_at">Date Collected</label>
                            <input type="date" class="form-control" id="txt_collected_at" name="txt_collected_at" value="{{ old('txt_collected_at') }}">
                            {{-- <div class="input-group date" id="reservationdate" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdate" name="txt_collected_at" id="txt_collected_at" value=""/>
                                <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                </div>
                            </div> --}}
                        </div>
                        <span class="text-danger">@error('txt_collected_at') {{ $message }} @enderror</span>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="txt_remarks">Remarks</label>
                            <textarea class="form-control" rows="3" placeholder="Enter Remarks Here" name="txt_remarks">{{old('txt_remarks')}}</textarea>
                        </div>
                        <span class="text-danger">@error('txt_remarks') {{ $message }} @enderror</span>
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
            Select the product and enter the quantity to transfer
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
                <h3 class="card-title">Transaction Info</h3>
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
                        <th>Product Name</th>
                        <th>Original Stock</th>
                        <th>Stock Before</th>
                        <th>Quantity Transfered</th>
                        <th>Stock Left</th>
                        <th>Price per Piece</th>
                        <th>Expected Amount</th>
                        <th>Collected By</th>
                        <th>Collected At</th>
                        <th>Remarks</th>
                        <th>Created By</th>
                        <th>Created At</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($all_transfer_records as $transfer_record)
                        <tr>
                            <td>{{ $transfer_record->name }}</td>
                            <td> {{ $transfer_record->original_stock }} </td>
                            <td>{{ $transfer_record->stock_before }}</td>
                            <td>{{ $transfer_record->quantity_transfered_in_pieces }}</td>
                            <td>{{ $transfer_record->stock_after }}</td>
                            <td>{{ $transfer_record->price_per_piece }}</td>
                            <td>
                                @php
                                    echo 'Gh¢ '.number_format($transfer_record->expected_price, 2);
                                @endphp
                            </td>
                            <td>{{ $transfer_record->collected_by }}</td>
                            <td>{{ $transfer_record->collected_at }}</td>
                            <td>{{ $transfer_record->remarks }}</td>
                            <td>{{ $transfer_record->created_by }}</td>
                            <td>{{ $transfer_record->created_at }}</td>

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
    </section>


  </div>
  <!-- /.content-wrapper -->

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
            "order": [[ 10, "desc" ]],
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


    <script>
        $("#txt_quantity_to_transfer_in_crate").attr("value", 0);
        $("#txt_quantity_to_transfer_in_pieces").attr("value", 0);

        var today = new Date();
        var dd = ("0" + (today.getDate())).slice(-2);
        var mm = ("0" + (today.getMonth() +　1)).slice(-2);
        var yyyy = today.getFullYear();
        today =  yyyy + '-' + mm + '-' + dd ;
        // today =  mm + '/' + dd + '/' + yyyy ;
        $("#txt_collected_at").attr("value", today);
    </script>



@endsection



