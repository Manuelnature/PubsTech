@extends('layouts.base_template')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view_current_stock">
                    View Current Stock
                </button>
            </ol>
          </div><!-- /.col -->
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">
                {{-- <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view_stocks_left">
                    Views All Stocks Left
                </button> --}}
                <a class="btn btn-info" href="{{ url('login_stock') }}"> Stock At Login </a>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="modal fade" id="view_current_stock" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Current Stock</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <table id="current_stock" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                              <tr>
                                  <th>Product Name</th>
                                  <th>Price Per Item</th>
                                  <th>Stock Left</th>
                                  <th>Expected Price</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($get_retail_records as $audit_record)
                                <tr>
                                    <td>{{ ucwords(trans($audit_record->name)) }}</td>
                                    <td>{{ $audit_record->price_per_item }}</td>
                                    <td>{{ $audit_record->total_quantity}}</td>
                                    <td>
                                        @php
                                            echo 'Gh¢ '.number_format($audit_record->total_amount, 2);
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                          </table>
                    </div>

                    <div class="card-footer">
                        These are the Sales Records before you took over
                    </div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <div class="modal fade" id="view_stocks_left" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Sales Records Before You Took Over</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <div class="card-body">
                        <table id="stock_left" class="table table-bordered table-striped" style="width: 100%">
                            <thead>
                            <tr>
                                <th>Product Name</th>
                                <th>Price Per Item</th>
                                <th>Stock Left</th>
                                <th>Expected Price</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach ($all_sales_audit_records as $audit_record)
                                <tr>
                                    <td>{{ ucwords(trans($audit_record->name)) }}</td>
                                    <td>{{ $audit_record->price_per_item }}</td>
                                    <td>{{ $audit_record->starting_stock}}</td>
                                    <td>
                                        @php
                                            $expected_amount = (double)$audit_record->starting_stock * (double)$audit_record->price_per_item;
                                            echo 'Gh¢ '.number_format($expected_amount, 2);
                                        @endphp
                                    </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>

                    <div class="card-footer">
                        These are the Sales Records before you took over
                    </div>
                </div>

                <div class="modal-footer">

                </div>
            </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                    <h5 class="card-title">Filter Sales</h5>

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
                        <form action="{{ route('filter_sales') }}" method="POST">
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
                                    <button type="submit" class="btn btn-secondary btn-block">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- ./card-body -->
                    <div class="card-footer">


                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

        </div><!--/. container-fluid -->
    </section>



      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Summary of My Sales Records For Today</h5>

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
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Total Stocks Sold</span>
                              <span class="info-box-number">{{ $total_quantity_sold }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-6">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Expected Amount</span>
                              <span class="info-box-number">
                                @php
                                    echo 'Gh¢ '.number_format($total_expected_price, 2);
                                @endphp
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                      </div>
                  <!-- /.row -->
                </div>
                <!-- ./card-body -->
                <div class="card-footer">


                </div>
                <!-- /.card-footer -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

        </div><!--/. container-fluid -->
    </section>


    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 800;">Breakdown of My Sales For Today</h3>
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
                  <table id="my_sales" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Total Quantity Sold</th>
                          <th>Total Expected Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (json_decode($all_sales_data, true) as $sales_record)
                          <tr>
                              <td>{{ $sales_record['product_name'] }}</td>
                              <td>{{ $sales_record['total_quantity_sold_per_product'] }}</td>
                              <td>
                                    @php
                                        echo 'Gh¢ '.number_format($sales_record['total_expected_price_per_product'], 2);
                                    @endphp
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
    </section>

    <!-- Overall Sales Records -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 800;">Summary of Overall Sales</h3>
                        <span style="margin-left:40px !important">
                            {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_start_date'])->format('F j, Y')}}
                            <strong> to </strong>
                            {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_end_date'])->format('F j, Y')}}
                        </span>
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
                  <table id="sales" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Total Quantity Sold</th>
                          <th>Total Expected Amount</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (json_decode($overall_sales_record, true) as $sales_record)
                          <tr>
                              <td>{{ ucwords(trans($sales_record['product_name'])) }}</td>
                              <td>{{ $sales_record['total_quantity_sold_per_product'] }}</td>
                              <td>
                                    @php
                                        echo 'Gh¢ '.number_format($sales_record['total_expected_price_per_product'], 2);
                                    @endphp
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
    </section>


</div>


@section('Dashboard_JS')
  <script src="{{ asset('assets/js/dashboard.js') }}" ></script>
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
            $('#my_sales').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "buttons": ["csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#my_sales_wrapper .col-md-6:eq(0)');

            $('#current_stock').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#current_stock_wrapper .col-md-6:eq(0)');

            $('#stock_left').DataTable({
            "responsive": true,
            "paging": true,
            "lengthChange": true,
            "ordering": true,
            "info": true,
            "buttons": ["csv", "excel", "pdf", "print"]
            }).buttons().container().appendTo('#stock_left_wrapper .col-md-6:eq(0)');
        });
    </script>


@endsection
