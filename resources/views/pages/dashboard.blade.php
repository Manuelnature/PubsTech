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
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Bar Manager</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->

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

    <!-- Overall Info -->
    <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title"></h5>

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
                        <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Number of Products</span>
                              <span class="info-box-number">
                                {{ $total_number_of_products }}
                                <small></small>
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-users"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Number of Users</span>
                              <span class="info-box-number">{{ $total_number_of_users }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-4">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-car"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Number of Car Washers</span>
                              <span class="info-box-number">{{ $total_number_of_car_washers }}</span>
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
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title" style="font-weight: 700; color:blue">Summary Of My Sales Records For Today </h5>

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
                              <span class="info-box-number">{{ $individual_total_quantity_sold }}</span>
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
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-dollar-sign"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Expected Amount</span>
                              <span class="info-box-number">
                                @php
                                    echo 'Gh¢ '.number_format($individual_total_expected_price, 2);
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
                  <h3 class="card-title" style="font-weight: 700; color:blue">Breakdown of My Sales For Today</h3>
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
                      @foreach (json_decode($individual_all_sales_data, true) as $sales_record)
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

     <!-- Filtered Sales Records -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 800; color:blue">Summary of Overall Sales
                    <span style="margin-left:40px !important">
                        {{ \Carbon\Carbon::parse($all_filter_records[0]['date_from'])->format('F j, Y')}}
                        <strong> to </strong>
                        {{ \Carbon\Carbon::parse($all_filter_records[0]['date_to'])->format('F j, Y')}}
                    </span>
                  </h3>
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
                      @foreach (json_decode($filter_sales_data, true) as $sales_record)
                          <tr>
                              <td>{{ ucwords(trans($sales_record['product_name'] ))}}</td>
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


    <!-- Filtered Transfer Records -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 700; color:blue">Summary of Overall Transfer Transactions
                    <span style="margin-left:40px !important">
                        {{ \Carbon\Carbon::parse($all_filter_records[0]['date_from'])->format('F j, Y')}}
                        <strong> to </strong>
                        {{ \Carbon\Carbon::parse($all_filter_records[0]['date_to'])->format('F j, Y')}}
                    </span>
                  </h3>
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
                  <table id="transfers" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Original Stock</th>
                          <th>Total Quantity Transfered</th>
                          <th>Total Expected Amount</th>
                          <th>Total Stock Left</th>
                          {{-- <th>Remaining Expected Price</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (json_decode($filter_transfer_data, true) as $transfer_record)
                          <tr>
                              <td>{{  ucwords(trans($transfer_record['product_name'] ))}}</td>
                              <td> {{ $transfer_record['original_stock'] }} </td>
                              <td>{{ $transfer_record['total_quantity_transfered'] }}</td>
                              <td>
                                    @php
                                        echo 'Gh¢ '.number_format($transfer_record['total_expected_price'], 2);
                                    @endphp
                             </td>
                              <td>
                                    @php
                                        $total_stock_left = (double)($transfer_record['original_stock']) - (double)($transfer_record['total_quantity_transfered']);
                                        echo $total_stock_left;
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
        $("#transfers").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "ordering": true,
        "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#transfers_wrapper .col-md-6:eq(0)');

        $('#sales').DataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#sales_wrapper .col-md-6:eq(0)');

        $('#my_sales').DataTable({
        "responsive": true,
        "paging": true,
        "lengthChange": false,
        "ordering": true,
        "info": true,
        "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        });

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
