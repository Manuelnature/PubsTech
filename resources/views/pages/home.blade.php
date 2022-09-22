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
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view_stocks_left">
                    Stock At Login
                </button>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

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
                        <table id="example1" class="table table-bordered table-striped">
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
                                    <td>{{ $audit_record->name }}</td>
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


    @if ($user_session_details->role == 'Super Admin' || $user_session_details->role == 'Admin')
        <!-- Main content -->
        <section class="content">
        <div class="container-fluid">

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

        <!--=========== INITIAL DASHBOARD PRESENTATION========================-->
            <!-- Small boxes (Stat box) -->
            {{-- <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $total_products }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="inner">
                    <h3>{{ $total_products }}</h3>
                    <p>Total Products</p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $total_no_of_items }}<sup style="font-size: 20px"></sup></h3>
                    <p>Total Items (Pieces)</p>
                </div>
                <div class="inner">
                    <h3>
                        @php
                            echo 'Gh¢ '.number_format($total_price_of_items,2);
                        @endphp
                    <sup style="font-size: 20px"></sup></h3>
                    <p>Total Price</p>
                </div>
                <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-warning">
                <div class="inner">
                    <h3>{{ $total_quantity_sold }}</h3>
                    <p>Total Quantity Sold</p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <div class="inner">
                    <h3>
                        @php
                            echo 'Gh¢ '.number_format($total_expected_sold_price,2);
                        @endphp
                    </h3>
                    <p>Expected Price</p>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        @php
                            $total_remaining_items = (double)$total_no_of_items - (double)$total_quantity_sold;
                            echo $total_remaining_items;
                        @endphp
                    </h3>
                    <p>Total Quantity Remaining</p>
                </div>
                <div class="inner">
                    <h3>
                        @php
                            $total_expected_remaining_price = (double)$total_price_of_items - (double)$total_expected_sold_price;
                            echo 'Gh¢ '.number_format($total_expected_remaining_price,2);
                        @endphp
                    </h3>
                    <p>Expected Price</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <!-- ./col -->
            </div> --}}
            <!-- /.row -->

        </div><!-- /.container-fluid -->
        </section>
    @endif

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Overall Sales Records</h5>

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
                        <div class="col-12 col-sm-6 col-md-3">
                          <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-box"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Total Stocks</span>
                              <span class="info-box-number">
                                {{ $total_no_of_items }}
                                <small></small>
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Total Stock Sold</span>
                              <span class="info-box-number">{{ $total_quantity_sold }}</span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <!-- fix for small devices only -->
                        <div class="clearfix hidden-md-up"></div>

                        <div class="col-12 col-sm-6 col-md-3">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Total Stock Left</span>
                              <span class="info-box-number">
                                @php
                                    $total_remaining_items = (double)$total_no_of_items - (double)$total_quantity_sold;
                                    echo $total_remaining_items;
                                @endphp
                              </span>
                            </div>
                            <!-- /.info-box-content -->
                          </div>
                          <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        <div class="col-12 col-sm-6 col-md-3">
                          <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

                            <div class="info-box-content">
                              <span class="info-box-text">Expected Amount</span>
                              <span class="info-box-number">
                                @php
                                    echo 'Gh¢ '.number_format($total_expected_sold_price,2);
                                @endphp</span>
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
                  <h5 class="card-title">Summary Of My Sales Records For Today </h5>

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
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-coins"></i></span>

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
                  <table id="example1" class="table table-bordered table-striped">
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

    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <div class="card">
                <div class="card-header">
                  <h3 class="card-title" style="font-weight: 800;">Summary of Overall Transfer Transactions</h3>
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
                          <th>Total Quantity Transfered</th>
                          <th>Total Expected Amount</th>
                          <th>Total Stock Left</th>
                          {{-- <th>Remaining Expected Price</th> --}}
                      </tr>
                    </thead>
                    <tbody>
                      @foreach (json_decode($all_data, true) as $transfer_record)
                          <tr>
                              <td>{{ $transfer_record['product_name'] }}</td>
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

@endsection
