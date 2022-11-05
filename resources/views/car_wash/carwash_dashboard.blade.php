@extends('layouts.base_template')
@section('content')

@php
    $user_session_details = Session::get('user_session');
@endphp

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">

            </ol>
          </div><!-- /.col -->
          <div class="col-sm-3">
            <ol class="breadcrumb float-sm-right">

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
                                        <button type="submit" class="btn btn-secondary btn-block">Filter</button>
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




        @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
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
                                    <span class="info-box-text">Number of Vehicles Types</span>
                                    <span class="info-box-number">
                                        {{ $total_number_of_vehicle_type }}
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
                                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-car"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Number of Services</span>
                                        <span class="info-box-number">{{ $total_number_of_services }}</span>
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
                                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-car"></i><i class="fas fa-users"></i></span>

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
        @endif




    <section class="content">
            <div class="container-fluid">
              <div class="row">
                <div class="col-md-12">
                  <div class="card">
                    <div class="card-header">
                      <h5 class="card-title" style="font-weight: 800;">Overall Washing Records
                        <span style="margin-left:40px !important">
                            {{-- {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_start_date'])->format('j F, Y')}}
                            <strong> &nbsp;-&nbsp; </strong>
                            {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_end_date'])->format('j F, Y')}} --}}
                        </span>
                      </h5>

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
                            <div class="col-12 col-sm-4 col-md-4">
                              <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Total Vehicles Washed</span>
                                  <span class="info-box-number">{{ $total_vehicles_washed }}</span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>


                            <!-- fix for small devices only -->
                            <div class="clearfix hidden-md-up"></div>

                            <div class="col-12 col-sm-4 col-md-4">
                              <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

                                <div class="info-box-content">
                                  <span class="info-box-text">Expected Amount</span>
                                  <span class="info-box-number">
                                    @php
                                        echo 'Gh¢ '.number_format($total_washing_amount, 2);
                                    @endphp
                                  </span>
                                </div>
                                <!-- /.info-box-content -->
                              </div>
                              <!-- /.info-box -->
                            </div>

                            <div class="col-12 col-sm-4 col-md-4">
                                <div class="info-box mb-3">
                                  <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

                                  <div class="info-box-content">
                                    <span class="info-box-text">Expected Washer Commission</span>
                                    <span class="info-box-number">
                                      @php
                                          echo 'Gh¢ '.number_format($total_washers_commision, 2);
                                      @endphp
                                    </span>
                                  </div>
                                  <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                              </div>

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


    <!-- Overall Sales Records -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 800;">Individual Washing Records</h3>
                        <span style="margin-left:40px !important">
                            {{-- {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_start_date'])->format('j F, Y')}}
                            <strong> &nbsp;-&nbsp; </strong>
                            {{ \Carbon\Carbon::parse($all_transaction_dates[0]['sales_end_date'])->format('j F, Y')}} --}}
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
                  <table id="table1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                          <th>Nick Name</th>
                          <th>Total Cars Washed</th>
                          <th>Amount Made</th>
                          <th>Commission Received</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (json_decode($all_individual_washing_transaction, true) as $individual_transaction_record)
                          <tr>
                              <td>{{ ucwords(trans($individual_transaction_record['nickname'])) }}</td>
                              <td>{{ $individual_transaction_record['total_cars_washed'] }}</td>
                              <td>
                                    @php
                                        echo 'Gh¢ '.number_format($individual_transaction_record['amount_made'], 2);
                                    @endphp
                             </td>
                             <td>
                                @php
                                    echo 'Gh¢ '.number_format($individual_transaction_record['commission_received'], 2);
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

<script>
    var today = new Date().toISOString().split('T')[0];
    document.getElementsByName("txt_date_to")[0].setAttribute('max', today);
    document.getElementsByName("txt_date_from")[0].setAttribute('max', today);
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
        $("#table1").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "ordering": true,
        "buttons": ["csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#table1_wrapper .col-md-6:eq(0)');

        $('#').DataTable({
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
