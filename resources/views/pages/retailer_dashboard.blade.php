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
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#view_stocks_left">
                    Views All Stocks Left
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


      <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">My Sales Records For Today </h5>

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
                  <h3 class="card-title" style="font-weight: 800;">Summary of Transactions</h3>
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
                  <table id="example2" class="table table-bordered table-striped">
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


</div>


@section('Dashboard_JS')
  <script src="{{ asset('assets/js/dashboard.js') }}" ></script>
@endsection

@endsection
