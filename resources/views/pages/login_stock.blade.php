@extends('layouts.base_template')
@section('content')


@php
    $user_session_details = Session::get('user_session');
    $current_time =  \Carbon\Carbon::now();
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
              {{-- <li class="breadcrumb-item"><a href="#">Products</a></li> --}}
              {{-- <li class="breadcrumb-item active">Sales / Warehouse</li> --}}
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>


    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">

            <div class="card">
              <div class="card-header">
                <h3 class="card-title"> Stock At Login</h3>
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
                <form action="{{ route('filter_login_stock') }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="txt_stock_date">Select Date</label>
                                <input type="date" class="form-control" id="txt_stock_date" name="txt_stock_date" value="{{ old('txt_stock_date') }}">
                            </div>
                            <span class="text-danger">@error('txt_stock_date') {{ $message }} @enderror</span>
                        </div>
                        <div class="col-md-2" style="padding-top:30px !important;">
                            <button type="submit" class="btn btn-secondary btn-block">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                @if ($date)
                <h3>
                    {{ \Carbon\Carbon::parse($date)->format('F j, Y')}}
                </h3>
                @endif
                <table id="stock_left" class="table table-bordered table-striped" style="width: 100%">
                    <thead>
                      <tr>
                          <th>Product Name</th>
                          <th>Price Per Item</th>
                          <th>Stock Left</th>
                          <th>Expected Price</th>
                          <th>Date & Time</th>
                      </tr>
                    </thead>
                    <tbody>
                        @if (count($all_sales_audit_records) > 0)
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
                                    <td>{{ $audit_record->created_at}}</td>
                                </tr>
                            @endforeach

                        @else
                            <tr>
                                <td>-</td>
                                <td>0</td>
                                <td>00</td>
                                <td>0.00<td>
                            </tr>
                        @endif
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

  <script>
    function edit_product() {
        $('#edit-product').on('shown.bs.modal', function(e) {
        var link = $(e.relatedTarget) //use this https://api.jquery.com/event.relatedtarget/
            modal = $(this)
        var product_id = link.data('id')
        var product_name = link.data('name')
        var status = link.data('status')
        var price_per_item = link.data('price_per_item')
        var quantity_per_crate = link.data('quantity_per_crate')
        var stock_threshold = link.data('stock_threshold')
        var description = link.data('description')

        modal.find('#product_id').val(product_id);
        modal.find('#txt_edit_product_name').val(product_name);
        modal.find('#txt_edit_price_per_item').val(price_per_item);
        modal.find('#txt_edit_quantity_per_crate').val(quantity_per_crate);
        modal.find('#txt_edit_stock_threshold').val(stock_threshold);
        modal.find('#selected').val(status);
        modal.find('#txt_edit_description').val(description);
        document.getElementById('selected').innerHTML = status;
        document.getElementById('title').innerHTML = 'Edit '+ product_name;
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
                "order": [[ 4, "desc" ]],
                "buttons": ["csv", "excel", "pdf", "print"]
                }).buttons().container().appendTo('#stock_left_wrapper .col-md-6:eq(0)');
        });


        </script>



@endsection



